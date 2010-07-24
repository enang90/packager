<?php

class AppController extends Controller {
  var $components = array('Session', 'Auth');
	var $publicControllers = array('pages');

	function beforeFilter(){
    $this->Auth->loginRedirect = array('controller' => 'brands', 'action' => 'index');
    $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display', 'home');

		$this->Auth->userScope = array('User.blocked' => 0);
    $this->Auth->fields = array('username' => 'email', 'password' => 'password');

		if (in_array(strtolower($this->params['controller']), $this->publicControllers)) {
			$this->Auth->allow();			 
    }
  }
}