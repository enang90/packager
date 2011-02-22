<?php

class VersionsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Versions';
  var $components = array('Session', 'Appcast', 'Hudson', 'RequestHandler');
  var $uses = array('User', 'Brand', 'Version', 'Track');

  function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('hudson');
  } 

  function index() {
  }

  function archive() {
    $brand = $this->Session->read('Brand');
	  $conditions = array('Version.brand_id' => $brand['id']);
    $versions = $this->Version->find('all', array('conditions' => $conditions));
 
    foreach ($versions as $key => $version) {
	    switch ($version['Version']['status']) {
				case PACKAGER_VERSION_INIT:
          $versions[$key]['Version']['css_status'] = 'initiated';
				  $versions[$key]['Version']['human_status'] = __('Initiated', TRUE);
				  $versions[$key]['Version']['human_status_alt'] = __('Version creation has been initiated.', TRUE);
				  break;
				case PACKAGER_VERSION_NOTIFIED:
          $versions[$key]['Version']['css_status'] = 'created';
  			  $versions[$key]['Version']['human_status'] = __('Created', TRUE);
	  		  $versions[$key]['Version']['human_status_alt'] = __('The build server succesfully created your version.', TRUE);
				  break;
				case PACKAGER_VERSION_PENDING:
          $versions[$key]['Version']['css_status'] = 'pending';
  			  $versions[$key]['Version']['human_status'] = __('Pending', TRUE);
    		  $versions[$key]['Version']['human_status_alt'] = __('The build is still pending on the build server.', TRUE);
				  break;
				case PACKAGER_VERSION_SUCCESS:
          $versions[$key]['Version']['css_status'] = 'success';
  			  $versions[$key]['Version']['human_status'] = __('Success', TRUE);
    		  $versions[$key]['Version']['human_status_alt'] = __('The build server succesfully created your version.', TRUE);
          $versions[$key]['Version']['download'] = WWW_ROOT . '/artifacts/' . $versions[$key]['Brand']['name'] . '/' . $versions[$key]['Version']['hudson_artifact'];
				  break;
				case PACKAGER_VERSION_FAILURE:
          $versions[$key]['Version']['css_status'] = 'failed';
	  		  $versions[$key]['Version']['human_status'] = __('Failed', TRUE);
    		  $versions[$key]['Version']['human_status_alt'] = __('The build server failed to build your version.', TRUE);
				  break;
				case PACKAGER_VERSION_TIMEOUT:
          $versions[$key]['Version']['css_status'] = 'timeout';
    		  $versions[$key]['Version']['human_status'] = __('Time out', TRUE);
    		  $versions[$key]['Version']['human_status_alt'] = __('A time out occurred. Building probably failed.', TRUE);
				  break;
				case PACKAGER_VERSION_MISSINGARTIFACT:
          $versions[$key]['Version']['css_status'] = 'missing-artifact';
    		  $versions[$key]['Version']['human_status'] = __('Missing artifact', TRUE);
    		  $versions[$key]['Version']['human_status_alt'] = __('Building completed but there is no download available', TRUE);
				  break;
	    }
    }

	  $this->set('versions', $versions);
    $this->set('brandName', $brand['name']);
  }

  /**
   * Adds a version to the brand and triggers a build
   * 
   * This function checks if a corresponding Hudson job exists. If not, a job is
   * created. If the job exists/is created, it will be triggered to build a version.
   * The build/version is also logged in the Db as a version. The status of the job
   * is tracked in the model.
   */
  function add() {
    $versions = $this->Appcast->get_appcast_feed();
    $this->set('versions', $versions);

    $brand = $this->Session->read('Brand');
    $this->set('brand_id', $brand['id']);

	  if (!empty($this->data)) {
		  $messages = array();
		  $this->data['Version']['inittime'] = date('U'); // now
		  $this->data['Version']['status'] = PACKAGER_VERSION_INIT;
		  $this->data['Version']['packager_token'] = md5(mt_rand());

      if ($this->Version->saveAll($this->data)) {
        $this->_flash(sprintf(__('Your version has been recorded.', TRUE)), 'hudson');
        $version = $this->Version->read();

        // Create a Hudson job if it's the first time we get here.
        if (!$version['Brand']['job_created']) {
          if ($this->Hudson->createJob($version['Brand']['name'])) {
	          $this->Version->Brand->set(array('job_created' => 1));
            $this->Version->Brand->save(NULL, FALSE);
            $this->_flash(sprintf(__('A new job named %s was created', TRUE), $version['Brand']['name']), 'hudson');
          }
        } 

        // let's start a new build
        $this->Hudson->buildJob($version['Brand']['name'], $version['Version']);
      } 
	  }
  }

  /**
   * Hudson API call. Allows Hudson to check in with an update about the build.
   * Hudson should make a POST call to the path '/versions/hudson.xml'.
   * The POST object should be in this form:
   *
   *   data[packager_token]=value
   *   data[build_number]=value
   *
   * The Packager will process this through $this->data and make the necessary changes to the job.
   * A version which has received a notification from Hudson will be pollable by the Packager henceforworth
   */
  function hudson() {
	  if (!empty($this->data)) {
		  $packager_token = $this->data['packager_token'];
		  $hudson_build_id = $this->data['build_number'];
		  if ($version = $this->Version->findByPackagerToken($packager_token)) {
			  if ($version['Version']['hudson_id'] > 0) {
				  $status = 0;
	 		 	  $message = "Version was already registered.";
	  			$this->set(compact('status', 'message'));
			  } else {
		      $this->Version->read(NULL, $version['Version']['id']);
		      $this->Version->set(
			      array(
				      'hudson_id' => $hudson_build_id,
				      'status' => PACKAGER_VERSION_NOTIFIED,
				    )
			    );
		      if ($this->Version->save(NULL, FALSE)) {
			      $version = $this->Version->read();
			      $status = 1;
			      $message = "Succesfully notified the packager";
	       		$this->set(compact('version', 'message', 'status'));
		      } else {
					  $status = 0;
		 		 	  $message = "Could not save the field.";
		  			$this->set(compact('status', 'message'));
		      }				
			  }
		  } else {
			  $status = 0;
 		 	  $message = "Version does not exist with packager";
  			$this->set(compact('status', 'message'));
  		}
      $this->log("Version #" . $version['Version']['hudson_id'] . " :: $message", 'packager');
	  } else {
		  $status = 0;
		  $message = "POST data not present";
			$this->set(compact('status', 'message'));  
	  }
  }

  /**
   * Download action for the package.
   * When surfing to 'versions/download/<token>' You'll get the package that matches the token.
   * This is used in the Version archive and the Appcasting Feed
   * @param string $packager_token The unique token which was used to register with Hudson
   * @return void A binary stream which represents the package or triggers a 404 of nothing was found
   */
  function download($packager_token = NULL) {
    $this->view = 'Media';

    if (!is_null($packager_token)) {
      $version = $this->Version->findByPackagerToken($packager_token);

			$params = array(
	  		'id' => $version['Version']['hudson_artifact'],
		  	'name' => substr($version['Version']['hudson_artifact'], 0, -4),
			  'download' => TRUE,
	  		'extension' => 'msi',
	      'mimeType' => array('msi' => 'application/x-msi'),
		  	'path' => WWW_ROOT . 'artifacts/' . $version['Brand']['name'] . '/',
			); 

			$this->set($params);
    }
  }

  function appcast() {
    $versions = array();
    $brand = $this->Session->read('Brand');
    $allVersions = $this->Version->findAllByBrandId($brand['id']);
    foreach ($allVersions as $version) {
      if ($version['Version']['status'] == PACKAGER_VERSION_SUCCESS) {
        $versions[] = $version;
      }
    }

    $this->set('versions', $versions);
  }
  
  /**
   * Callback for 'appcasting/track'
   * This is represents the publishing updates menu item
   */
  function track() {
    if ($this->data) { 
      $this->Version->Track->set(array('version_id' => $this->data['Version']['version_id'], 'track' => $this->data['Version']['version_track']));
      $this->Version->Track->save(NULL, FALSE);
    }
    
    $versions = array();
    $brand = $this->Session->read('Brand');
    $allVersions = $this->Version->findAllByBrandId($brand['id']);
    foreach ($allVersions as $version) {
      if ($version['Version']['status'] == PACKAGER_VERSION_SUCCESS) {
        $version['Version']['track_link_add'] = '/appcasting/' . $version['Version']['id'] .'/track/add';
        foreach ($version['Track'] as $key => $track) {
          $version['Track'][$key]['track_link_del'] = '/appcasting/' . $version['Version']['id'] .'/track/delete/' . $track['track'];
        }
        $versions[] = $version;
      }
    }

    $this->set('versions', $versions);
    $this->set('brandName', $brand['name']);
  }
  
  /**
   * Callback for 'appcasting/:id/track/edit
   * Sets the edit track for publishing updates for a version
   */
  function edit_track($id = NULL) {
    $options = array('beta' => 'beta', 'stable' => 'stable', 'development' => 'development');
    $this->Version->read(NULL, $id);
    foreach ($this->Version->data['Track'] as $_track) {
      $key = array_search($_track['track'], $options);
      if ($key !== FALSE) {
        unset($options[$key]);
      }
    }
    
    $this->set('options', $options);
    $this->set('version_id', $id);
  }
  
  /**
   * Callback for 'appcasting/:id/track/delete
   * Sets the delete track for publishing updates for a version
   */
  function delete_track($id = NULL, $track = NULL) {
    if (isset($id) && isset($track)) {
      $this->id = $id;
      $this->Version->read(NULL, $id);
      foreach ($this->Version->data['Track'] as $_track) {
        if ($_track['track'] == $track) {
          $this->Version->Track->delete($_track['id'], FALSE);
        }
      }
    }
    
    $this->redirect(array('controller' => 'versions', 'action' => 'track'));
  }
}