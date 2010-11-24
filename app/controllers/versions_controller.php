<?php

define('HUDSON_PENDING', 0);

class VersionsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
	var $layout = 'versions';
  var $name = 'Versions';
  var $components = array('Session', 'Appcast', 'Hudson', 'RequestHandler');
  var $uses = array('User', 'Brand', 'Version');

  function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('hudson');
  } 

  function index() {
  }

  function archive() {
    $brand = $this->Session->read('Brand');
	  $conditions = array('Version.brand_id' => $brand['id']);
	  $this->set('versions', $this->Version->find('all', array('conditions' => $conditions)));
    $this->set('brand', $brand);
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
		  $this->data['Version']['status'] = HUDSON_PENDING;
		  $this->data['Version']['packager_token'] = md5(mt_rand());

      if ($this->Version->saveAll($this->data)) {
        $this->_flash(sprintf(__('Your version has been recorded.', TRUE)), 'hudson');
        $version = $this->Version->read();

        // Create a Hudson job if it's the first time we get here.
        if (!$version['Brand']['job_created']) {
          if ($this->Hudson->createJob($version['Brand']['name'])) {
	          $this->Version->Brand->set(array('job_created' => 1));
            $this->Version->Brand->save();
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
		      if ($this->Version->saveField('hudson_id', $hudson_build_id)) {
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
	  } else {
		  $error = "POST data not present";
			$this->set(compact('error'));  
	  }
  }
}