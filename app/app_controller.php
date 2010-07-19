<?php

class AppController extends Controller {
  var $components = array('Session', 'Auth');

	function beforeFilter(){
    $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');
  }
}