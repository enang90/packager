<?php
/**
 * Pandion Packager
 * Copyright (C) 2010, Matthias Vandermaesen
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class AppController extends Controller {
  var $components = array('Session', 'Auth');
  var $helpers = array('Session', 'Html', 'Time', 'Ajax', 'PaypalIpn.Paypal');
	var $publicControllers = array('pages');
	var $permissions = array();

	function beforeFilter(){
	  // load settings into core Configure component
	  $this->_fetchSettings();

	  // Set the Auth component settings
	  $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    $this->Auth->loginRedirect = array('controller' => 'brands', 'action' => 'index');
    $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display', 'home');
    $this->Auth->authorize = 'controller';
    $this->Auth->userScope = array('User.blocked' => 0);
    $this->Auth->fields = array('username' => 'email', 'password' => 'password');

    if (in_array(strtolower($this->params['controller']), $this->publicControllers)) {
      $this->Auth->allow();
    }

    // Set some packager specific parameters and activate default Brand
    if ($user = $this->Auth->user()) {
      // load the User if logged in.
      $this->User =	ClassRegistry::init('User');
      $this->User->set($user['User']);
      $this->User->read();

      // set the user in the brand views
      $this->set('user', $this->User);

      // Check if a brand is active. If not. Set the last added brand as active.	    
      // @todo: fix updates to brand from subscriptions!
      $active_brand = $this->Session->read('Brand');
      if (!$active_brand) {
        if ($this->User->data['Brand']) {
          $active_brand = array_pop($this->User->data['Brand']);
          if ($active_brand) {
            $this->Session->write('Brand', $active_brand);
          }
        }
      }
    }
  }

  /**
   * Checks the permissions for a given controller/action defined in the $permissions array
   * of said controller class
   * @return boolean TRUE or FALSE
   */
  function isAuthorized() {
    if ($this->Auth->user('group') == 'admin') {
      return TRUE; //Remove this line if you don't want admins to have access to everything by default
    }

    if (!empty($this->permissions[$this->action])) {
      if ($this->permissions[$this->action] == '*') {
        return TRUE;
      }

      if (in_array($this->Auth->user('group'), $this->permissions[$this->action])) {
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * This function is a callback which executes when Paypal IPN hits paypal/process
   * Logs the transaction and unblocks the brand for appcasting, versioning,...
   */
  function afterPaypalNotification($txnId){
    //Here is where you can implement code to apply the transaction to your app.
    //for example, you could now mark an order as paid, a subscription, or give the user premium access.
    //retrieve the transaction using the txnId passed and apply whatever logic your site needs.
      
    $transaction = ClassRegistry::init('PaypalIpn.InstantPaymentNotification')->findById($txnId);
    $this->log(__(sprintf('Processed %s, fireing callback functionality.', $transaction['InstantPaymentNotification']['id']), TRUE), 'paypal');
  
    //Tip: be sure to check the payment_status is complete because failure 
    //  are also saved to your database for review.
  
    if($transaction['InstantPaymentNotification']['payment_status'] == 'Completed'){

      // @todo: if completed, then get Brand id
      $brand_id = $transaction['InstantPaymentNotification']['item_number'];

      // @todo: fetch Brand based on brand id
      $brand = ClassRegistry::init('Brand')->findById($brand_id);

      // @todo: set status Blocked to FALSE (?) or set status active to TRUE
      $data = array(
        'id' => $brand_id,
        'subscription_id' => $transaction['InstantPaymentNotification']['id'],
        'active' => TRUE,
      );

      if (ClassRegistry::init('Brand')->save($data, FALSE)) {
        $this->log(__(sprintf('Activated brand %s successfully.', $brand['name']), TRUE), 'paypal');
      }

      // @todo: redirect to brands controller subscription completed page
      // @todo: check if this is a subscription change or a new subscription
    }
    else {
      $this->log(__(sprintf('The transaction %s could not be processed.', $txnId), TRUE), 'paypal');
      $this->log(__(sprintf('Status of transaction %s : %s', $txnId, $transaction['InstantPaymentNotification']['payment_status']), TRUE), 'paypal');
      //Oh no, better look at this transaction to determine what to do; like email a decline letter.
    }
  }

  /**
   * Sets application wide settings per request and loads them into the Configure component
   */
  function _fetchSettings() {
    App::import('Model', 'Setting');
    $settings = new Setting();
    $all_settings = $settings->find('all');
    foreach ($all_settings as $key => $value) {
      Configure::write('Pandion.' . $value['Setting']['key'], $value['Setting']);
    }
  }

  /**
   * Support for stacked messages
   */
	function _flash($message, $type = 'message') {
		$messages = (array)$this->Session->read('Message.multiFlash');
		$messages[] = array(
			'message' => $message, 
			'layout' => 'default', 
			'element' => 'default',
			'params' => array('class' => $type),
		);
		$this->Session->write('Message.multiFlash', $messages);
	}
}