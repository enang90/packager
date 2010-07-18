<?php

class UsersController extends AppController {
	var $name = 'Users';
	var $components = array('Auth');


	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->authorize = 'controller';
		$this->Auth->allow(array('register'));
		
		//$this->Auth->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	}

	
	function index() { }
	
	/**
	 * Registers a new user account
	 */
	function register() {
    if (!empty($this->data)) {		
      $this->User->set($this->data);
      if ($this->User->validates()) {
         $this->data['User']['password'] = $this->Auth->password($this->data['User']['password_confirm']);
      }
    }
	}
	
	function login() { }
	
	function logout() {
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}	
}