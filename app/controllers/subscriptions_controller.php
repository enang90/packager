<?php

class SubscriptionsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Subscriptions';
  var $components = array('Session');
  var $uses = array('User', 'Brand', 'Subscription');
  
	/**
	 * review/change the subscription plan
	 */
	function index() {
		$brand = $this->Session->read('Brand');
		
		if (!$brand) {
      $this->_flash(__('We could not find a brand associated with your session. Please switch to a brand through the brand selector.'), 'pandion');
      $this->redirect(array('controller'=> 'brands', 'action' => 'index'));
		}
		
	  $subscription = $this->Subscription->find('first');

	  $button = array(
		  'test' => TRUE,
		  'type' => $subscription['Subscription']['type'], 
	    'amount' => $subscription['Subscription']['amount'],
	    'term' => $subscription['Subscription']['term'],
	    'period' => $subscription['Subscription']['period'],
	    'item_name' => __(sprintf('Subscription plan for \'%s\'', $brand['name']), TRUE),
			'item_number' => $brand['id']);
			
		$this->set('brand_name', $brand['name']);	
		$this->set('button', $button);	
	}
}