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
  var $components = array('Session', 'Auth',);
  var $helpers = array('PaypalIpn.Paypal', 'Session', 'Html', 'Time', 'Ajax');
	var $publicControllers = array('pages');

	function beforeFilter(){
    $this->Auth->loginRedirect = array('controller' => 'brands', 'action' => 'index');
    $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display', 'home');

		$this->Auth->userScope = array('User.blocked' => 0);
    $this->Auth->fields = array('username' => 'email', 'password' => 'password');

		if (in_array(strtolower($this->params['controller']), $this->publicControllers)) {
			$this->Auth->allow();			 
    }

    if ($user = $this->Auth->user()) {
	    // load the User if logged in.
      $this->User =	ClassRegistry::init('User');
	    $this->User->set($user['User']);
	    $this->User->read();
	
	    // set the user in the brand views
	    $this->set('user', $this->User);

      // Check if a brand is active. If not. Set the last added brand as active.	    
	    $active_brand = $this->Session->read('Brand');
	    if (!$active_brand) {
		    $active_brand = array_pop($this->User->data['Brand']);
		    if ($active_brand) {
  		    $this->Session->write('Brand', $active_brand);
        }
	    }
    }
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
    $this->log($transaction['InstantPaymentNotification']['id'], 'paypal');
  
    //Tip: be sure to check the payment_status is complete because failure 
    //     are also saved to your database for review.
  
    if($transaction['InstantPaymentNotification']['payment_status'] == 'Completed'){

       // @todo: if completed, then get Brand id
       $brand_id = $transaction['InstantPaymentNotification']['item_number'];

       // @todo: fetch Brand based on brand id
       $brand = ClassRegistry::init('PaypalIpn.InstantPaymentNotification')->findById($brand_id);

       // @todo: set status Blocked to FALSE (?) or set status active to TRUE
       $brand->set('subscription_id', $transaction['InstantPaymentNotification']['item_name']);
       $brand->save();

       // @todo: redirect to brands controller subscription completed page
       // @todo: check if this is a subscription change or a new subscription
    }
    else {
      //Oh no, better look at this transaction to determine what to do; like email a decline letter.
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