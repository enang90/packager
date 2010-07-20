<?php

class UsersController extends AppController {
	var $name = 'Users';

  function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('register', 'information');
  }

	function index() { }

  /**
   * Preprocesses information for the brand.ctp element
   */
  function information() { 
    if (isset($this->params['requested'])) {
		  $user = $this->Session->read('Auth.User');
		  $logged_in = TRUE;
		
		  if (!$user) {
			  $logged_in = FALSE;
			  $user['username'] = 'Guest';
		  }
		
		  $variables = compact('user', 'logged_in');
			
		  return $variables;	
    }
    // If someone goes to /brands/information, redirect to the controller
	  $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	}
	
	/**
	 * Registers a new user account
	 */
	function register() {
    if (!empty($this->data)) {		
      $this->User->set($this->data);
      if ($this->User->validates()) {
	      $brand = $this->Session->read('Brand');
	      if ($brand) {
          $this->data['Brand']['id'] = $brand['id'];
      	}
	      $this->User->save($this->data);

        // auto login: associate a User session with the active brand
	      $login = $this->Auth->login($this->data);
        if ($login) {
	        $this->redirect($this->Auth->redirect());
        }        
      }
    }
	}	
	
	function login() { 
	}
	
	function logout() {
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}	
}