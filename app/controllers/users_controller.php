<?php

class UsersController extends AppController {
	var $view = 'Theme';
	var $theme = 'public';
	var $name = 'Users';
  var $components = array('Upload');
	var $uses = array('User', 'Brand');

  function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('register', 'information');
  }

	function index() { }
	
	/**
	 * Registers a new user account and their first brand
	 */
	function register() {
		// A logged in user shouldn't be hitting the register page
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'brands', 'action' => 'index'));
		}
		
		if (!empty($this->data)) {			
			// let's register the User
			$this->User->set($this->data);
			if ($this->User->validates()) {
				if ($this->User->save($this->data)) {
				  $login = $this->Auth->login($this->data);
	        if ($login) {
	 	        $this->redirect($this->Auth->redirect());
		      }
				}
			}
		}
	}	
	
	function login() { }
	
	function logout() {
		$this->Session->destroy();  // @todo not in Auth->logout ? Weird!
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}	
}