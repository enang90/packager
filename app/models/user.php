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
			'rule' => array('email', true),
	    'message' => 'Please provide a valid email',
		),
		'password' => array(
			'passwordCharacters' => array(
				'rule' => 'alphaNumeric',
				'required' => TRUE,
			),
			'passwordLength' => array(
				'rule' => array('minLength', '8'),
				'message' => 'Minium 8 characters long',
			),
			'passwordConfirmation' => array(
				'rule' => array('confirmPassword', 'password'),
        'message' => 'Passwords do not match',
			),	
		),
    'password_confirm' => array(
	    'rule' => 'alphanumeric',
      'required' => true),
		);
	
  function confirmPassword($data) {
	  $valid = FALSE;
	
    if ($data['password'] == Security::hash(Configure::read('Security.salt') . $this->data['User']['password_confirm'])) {
      $valid = TRUE;
    }
    return $valid;
  }
	
	
/* 	function validateLogin($data) {
		$user = $this->find(array('username' => $data['username'], 'password' => md5($data['password'])), array('id', 'username'));

    if (empty($user) == FALSE)
      return $user['User'];

    return FALSE;
	} */
	
}