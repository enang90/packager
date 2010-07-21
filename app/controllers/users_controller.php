<?php

class UsersController extends AppController {
	var $name = 'Users';
	
	var $uses = array('User', 'Brand');

  function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('register', 'information');
  }

	function index() { }
	
	/**
	 * Registers a new user account
	 */
	function register() {
		//$brand = $this->Session->read('Brand');
		//$this->Brand->id = $brand['id'];
		//$this->Brand->read();



    if (!empty($this->data)) {		
      $this->User->set($this->data);
      if ($this->User->validates()) {
	      $brand = $this->Session->read('Brand');
	
	      // @todo: check session for guest account: reuse of record!!
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
	
	function login() { }
	
	function logout() {
		$this->Session->destroy();  // @todo not in Auth->logout ? Weird!
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}	
}