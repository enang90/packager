<?php

class BrandsController extends AppController {
  var $name = 'Brands';
  var $components = array('Upload', 'Session');

  function index() { 
    // Prepare for the brand.ctp element
    if (isset($this->params['requested'])) {
		  $brand = $this->Session->read('Brand');

		  if (!$brand) {
			  $brand['icon'] = 'placeholder.gif';
			  $brand['name'] = 'Goliath Messenger';
		  } else {
			  $brand['icon'] = 'icons/' . $brand['icon'];
		  }
		
		  return $brand;	
    }
    // If someone goes to /brands, redirect to the controller
	  $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	}
		
	/**
	 * Add a brand new brand
	 */
	function add() {
		if (!empty($this->data)) {
			
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
						if(is_array($errors)){ $errors = implode("<br />",$errors); }

						$this->Session->setFlash($errors);
						$this->redirect('/brands/add');
						exit();
   		}

      // Save the Brand and return to the dashboard
      if ($this->Brand->save($this->data)) {
	      $brand = $this->Brand->find("id = '" . $this->Brand->id . "'"); // urgh, extra query...
	      $this->Session->write('Brand', $brand['Brand']);
        $this->Session->setFlash('Your brand has been saved');
      }

			$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
    }
	}
}