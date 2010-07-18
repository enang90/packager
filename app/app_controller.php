<?php
class AppController extends Controller {
	var $components = array('Session');
	
/*  var $components = array('Auth', 'Session');

	function beforeFilter(){
    $this->Auth->action = array('controller' => 'users', 'action' => 'login');
    $this->Auth->redirect = array('controller' => 'pages', 'action' => 'display', 'home');
    $this->Auth->allow('display');
    $this->Auth->authorize = 'controller';
  }

	function isAuthorized() {
    return true;
	} */
}