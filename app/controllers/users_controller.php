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
	         $this->User->save($this->data);
	         pr($this->User);
	         // save the user
	         // check for a brand in Session
	         // save HABTM relationship
	         // go to thank you page ... whatever!
      }
    }
	}	
	
	// @todo Improper redirect at /users/login : why?
	function login() { 
	}
	
	function logout() {
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}	
}