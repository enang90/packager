<?php
// @todo create doc for this class
class User extends AppModel {
	var $name = 'User';
	
	var $belongsTo = array(
    'Group' => array(
      'className' => 'Group',
      'foreignKey' => 'group_id'
    )
  );
  
  /**
   * defines a relationship between Brands and Users.
   * A user can maintain multiple brands, a brand can be maintained by multiple users
   */
  var $hasAndBelongsToMany = array(
  	'Brand' => array(
  		'className' => 'Brand',
  		'joinTable' => 'brands_users',
  		'foreignKey' => 'user_id',
  		'associatedForeignKey' => 'brand_id',
  		'unique' => TRUE,
  	),
  );
	
	var $validate = array(
		'first_name' => array(
			'alphaNumeric' => array(
				'allowEmpty' => FALSE,
    		'required' => TRUE,
				'rule' => array('alphaNumeric'),
				'message' => 'Letters and numbers only',
			),
		),
		'last_name' => array(
	  	'alphaNumeric' => array(
				'allowEmpty' => FALSE,
    		'required' => TRUE,
				'rule' => array('alphaNumeric'),
				'message' => 'Letters and numbers only',
		  ),
	  ),
		'email' => array(
			'email' => array(
				'allowEmpty' => FALSE,
    		'required' => TRUE,
  			'rule' => array('email', FALSE),
	      'message' => 'Please provide a valid email',
	    ),
  	  'usernameUnique' => array(
	  	  'rule' => array('uniqueUsername', 'username'),
		    'message' => 'A user with that username already exists',
		  ),
		),
   	'password' => array(
			'passwordCharacters' => array(
				'allowEmpty' => FALSE,
    		'required' => TRUE,
				'rule' => array('alphaNumeric'),
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
      'required' => true
    ),
	);
	
	/**
	 * Validation rule: Checks if passwords match
	 */
  function confirmPassword($data) {
	  $valid = FALSE;
	
    if ($data['password'] == Security::hash(Configure::read('Security.salt') . $this->data['User']['password_confirm'])) {
      $valid = TRUE;
    }

    return $valid;
  }

  /**
   * Validation rule: usernames must be unique
   */
  function uniqueUsername($data) {
    $user = $this->find(array('email' => $data['email']), array('id', 'email'));
    if ($user) {
	    return FALSE;
    }

    return TRUE;
  }

  /**
   * Save the Brand before the User. We won't allow Users without at least 1 Brand.
   */
  function beforeSave() {
	  if (!empty($this->data['Brand']['name'])) {
      $this->Brand->set($this->data['Brand']);
      if ($this->Brand->validates()) {
	      $this->Brand->save($this->data['Brand']);
	      $this->data['Brand']['id'] = $this->Brand->id;
      }
    }

    return TRUE;
  }
}