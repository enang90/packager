<?php

class AppController extends Controller {
  var $components = array('Session', 'Auth');

	function beforeFilter(){
    $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index');

    // Set the last added brand for a user as it's active brand
    if ($_user = $this->Auth->user()) {
	    if (!$this->Session->read('Brand')) {
   	    $user = ClassRegistry::init('User');
        $user->id = $_user['User']['id'];
        $data = $user->read();
 	      $brands = $data['Brand']; // multiple brands
        $this->Session->write('Brand', array_pop($brands));
      }
	  }
  }
}