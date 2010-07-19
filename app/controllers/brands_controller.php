<?php

class BrandsController extends AppController {
  var $name = 'Brands';
  var $components = array('Upload', 'Session');

  function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('information', 'add');
  }

  /**
   * Preprocesses information for the brand.ctp element
   */
  function information() { 
    if (isset($this->params['requested'])) {
		  $brand = $this->Session->read('Brand');
		  if (!$brand) {
			  $brand = array(
				  'icon' => 'placeholder.gif',
				  'name' => 'Goliath Messenger',
				);
		  } else {
			  $brand['icon'] = 'icons/' . $brand['icon'];
		  }
		  
		  $variables = compact('brand');
	
		  return $variables;	
    }
    // If someone goes to /brands/information, redirect to the controller
	  $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	}
		
	/**
	 * Add a brand new brand
	 */
	function add() {
		if (!empty($this->data)) {
			
			// VALIDATION!!!
			
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

      // create a new stub user and save the user.
      // @todo Only create a new user if there is no active user session.
      $data = array(
	      'User' => array(
		      'username' => 'Guest' . Security::hash(Configure::read('Security.salt') . time() . rand(1, 100)),
		      'password' => Security::hash(Configure::read('Security.salt') . (time() + 10) . rand(1, 100)),
		      'email' => '', 
		      'blocked' => 1,
		    ),
		  );
		
      $user = ClassRegistry::init('User');
      $user->create();
      $user->save($data, FALSE);

      // we need the user id to ensure a HABTM relationship
      $this->data['User']['id'] = $user->id;

      // Save the Brand and return to the dashboard
      if ($this->Brand->save($this->data)) {
	      $brand = $this->Brand->find("id = '" . $this->Brand->id . "'"); // urgh, extra query...
	      $this->Session->write('Brand', $brand['Brand']);
        $this->Session->setFlash('Your brand has been saved');
      }

      // let's autologin with the stub user
      $login = $this->Auth->login($data);
      if ($login) {
	      $this->redirect($this->Auth->redirect());
      }

			$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
    }
	}
}