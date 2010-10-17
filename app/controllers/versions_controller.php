<?php

define('HUDSON_PENDING', 0);

class VersionsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
	var $layout = 'versions';
  var $name = 'Versions';
  var $components = array('Session', 'Appcast', 'Hudson');
  var $uses = array('User', 'Brand', 'Version');

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

      if ($this->Version->saveAll($this->data)) {
        $this->_flash(sprintf(__('Your version has been recorded.', TRUE)), 'hudson');
        $version = $this->Version->read();

        // Create a Hudson job if it's the first time we get here.
        if (!$version['Brand']['job_created']) {
          if ($this->Hudson->createJob($version['Brand']['name'])) {
	          $this->Version->Brand->set(array('job_created' => 1));
            $this->Version->Brand->save();
            $this->_flash(sprintf(__('A new job named %s was created', TRUE), $brand['Brand']['name']), 'hudson');
          }
        }

        // let's start a new build
        $this->Hudson->buildJob($version['Brand']['name'], $version['Version']);
      } 
	  }
  }
}