<?php

class SubscriptionsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Subscriptions';
  var $components = array('Session');
  var $uses = array('User', 'Brand');
  
	/**
	 * review/change the subscription plan
	 */
	function index() {
		$brand = $this->Session->read('Brand');
		
		if (!$brand) {
      $this->_flash(__('We could not find a brand associated with your session. Please switch to a brand through the brand selector.'), 'pandion');
      $this->redirect(array('controller'=> 'brands', 'action' => 'index'));
		}
	
		
		/* if (!is_null($brand['id'])) {
			$subscriptions = ClassRegistry::init('Subscription')->find('all');
			
			// @todo: fix handling of subscriptons to match data model
			foreach ($subscriptions as $key => $subscription) {
				$subscriptions[$key]['Subscription']['active'] = FALSE;
				if ($subscription['Subscription']['id'] == $brand['subscription_id']) {
				  $subscriptions[$key]['Subscription']['active'] = TRUE;				  
				}
			}
			
      $this->set('subscriptions', $subscriptions); */
      $this->set('brand_name', $brand['name']);	
	}
}