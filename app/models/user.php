<?php

class User extends AppModel {
	var $name = 'User';
	
	var $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => TRUE,
				'message' => 'Letters and numbers only',
			),
		),
		'email' => array(
		  'email' => array(
			  'message' => 'Please provide a valid email',
			),
		),
		'password' => array(
			'rule' => array('minLength', '8'),
			'message' => 'Minium 8 characters long',
		),
	);
	
	function validateLogin($data) {
		$user = $this->find(array('username' => $data['username'], 'password' => md5($data['password'])), array('id', 'username'));

    if (empty($user) == FALSE)
      return $user['User'];

    return FALSE;
	}
	
}