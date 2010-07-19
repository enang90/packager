<?php

class UsersController extends AppController {
	var $name = 'Users';
	var $components = array('Auth');


	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->authorize = 'controller';
		$this->Auth->allow(array('register'));

		$this->Auth->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	}

	function index() { }
	
	/**
	 * Registers a new user account
	 */
	function register() {
    if (!empty($this->data)) {		
      $this->User->set($this->data);
      if ($this->User->validates()) {
        if($this->data['User']['password'] != $this->Auth->password($this->data['User']['password_confirm'])) {
	        $this->Session->setFlash('test');
      		$this->redirect(array('controller' => 'Users', 'action' => 'register'));
        } else {
	         // save the user
	         // check for a brand in Session
	         // save HABTM relationship
	         // go to thank you page ... whatever!
        }
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