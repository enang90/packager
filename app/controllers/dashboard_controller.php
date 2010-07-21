<?php
/**
 * This file is controls the dashboard of the Pandion Packager application.
 */
class DashboardController extends AppController {
	var $components = array('Session');
	var $name = 'Dashboard';

	var $uses = array('Brands', 'Users');
	
	function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('index');
  }
	
	function index() {
  //   $user = ClassRegistry::init('User');
   //  $user->find(array('id' => '1'));
     $user = $this->Session->read('Auth.User');
	 }
}
