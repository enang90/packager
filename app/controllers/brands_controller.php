<?php

class BrandsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Brands';
  var $components = array('Upload', 'Session');
  var $uses = array('User', 'Brand');

  function index() {  }

  function beforeFilter() {
	  parent::beforeFilter();

    if ($user = $this->Auth->user()) {
	    // load the User if logged in.
	    $this->User->set($user['User']);
	    $this->User->read();

      // Check if a brand is active. If not. Set the last added brand as active.	    
	    $active_brand = $this->Session->read('Brand');
	    if (!$active_brand) {
		    $active_brand = array_pop($this->User->data['Brand']);
		    if ($active_brand) {
  		    $this->Session->write('Brand', $active_brand);
        }
	    }
    }

  }

  /**
   * Preprocesses information for the brand.ctp element
   */
  function information() { 
    if (isset($this->params['requested'])) {
	    $brands = array();
      $brand = $this->Session->read('Brand');

      if (!$brand) {
	      $brand = FALSE;
      }
	
	    if ($_user = $this->Auth->user()) {
        // @todo: generate a list of brands and show them in a form element
        // @todo: user story if 1 brand v multiple brands v a user
        $this->User->id = $_user['User']['id'];
        $data = $this->User->read();
 		    $brands = $data['Brand']; // multiple brands
	    }

		  $variables = compact('brands', 'brand');
	
		  return $variables;
    }
    // If someone goes to /brands/information, redirect to the controller
	  $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	}
		
	/**
	 * Add a brand new brand
	 */
	function add() {
		$this->set('user_id', $this->User->id);
		
		if ((!empty($this->data)) && ($this->Brand->validates())) {
			
			$this->__uploadBrandIcon();

      // Save the Brand and return to the dashboard
      if ($this->Brand->save($this->data)) {
	      $brand = $this->Brand->find("id = '" . $this->Brand->id . "'"); // urgh, extra query...
	      $this->Session->write('Brand', $brand['Brand']);
        $this->Session->setFlash('Your brand has been saved');
      }

      // @todo redirect to the actual page they are on instead of defaulting to the dashboard
			$this->redirect(array('controller' => 'brands', 'action' => 'index'));
    }
	}
	
	/**
	 * Edit a brand
	 */
	function edit($id = NULL) {
		$this->Brand->id = $id;
    if (empty($this->data)) {
	    $this->data = $this->Brand->read();
    } else {

    	$this->__uploadBrandIcon();

	    if ($this->Brand->save($this->data, FALSE)) {
		    $this->Session->write('Brand', $this->Brand->data['Brand']);
	      $this->Session->setFlash('Your Brand has been updated');
	      $this->redirect(array('controller' => 'brands', 'action' => 'index'));
	    }
    }
	}
	
	/**
	 * Switch to a different active Brand
	 */
	function switchBrand($id = NULL) {
		if ($id) {			
		  $this->Brand->id = $id;
		  $data = $this->Brand->read();
      if ($this->Session->read('Brand')) {
	      $this->Session->delete('Brand');
      }
      $this->Session->write('Brand', $data['Brand']);
	  }
		
    $this->redirect(array('controller' => 'brands', 'action' => 'index'));
	}
	
	function __uploadBrandIcon() {
		// Image handling
		$destination = realpath('../../app/webroot/img/icons/') . '/';
		$file = $this->data['Brand']['image'];

		$ext = $this->Upload->ext($file['name']);
		$uniquename = md5($this->data['Brand']['image']['name'] . time()) . '.' . $ext; // ensure uniqueness

		$result = $this->Upload->upload($file, $destination, $uniquename, array('type' => 'resizecrop', 'size' => array('50', '50'), 'output' => 'jpg'));

		if (!$result){
			$this->data['Brand']['icon'] =  $this->Upload->result;
		} else {
			// display error
			$errors = $this->Upload->errors;

			// piece together errors
			if (is_array($errors)) {
	      $errors = implode("<br />",$errors); 
	    }

			$this->Session->setFlash($errors);
			$this->redirect(array('controller' => 'brands', 'action' => 'index'));
			exit();
 		}		
	}
}
