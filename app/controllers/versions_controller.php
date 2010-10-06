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
       // $brand = $this->Version->Brand->read();

        // Create a Hudson job if it's the first time we get here.
//        if (!$brand['Brand']['job_created']) {
//         if ($this->Hudson->createJob($brand['Brand']['name'])) {
	          $this->Version->Brand->set(array('job_created' => 1));
           	$this->Version->Brand->save();
            $this->_flash(sprintf(__('A new job named %s was created', TRUE), $brand['Brand']['name']), 'hudson');
  //        }
  //      } else {
	  //      pr($this->Version->read());
      //  }
      }
	  }
  }
}