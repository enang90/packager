<?php

class Brand extends AppModel {
	var $name = 'Brand';
	
	/* @todo problem with aphaNumeric validation failing consistently */
	var $validate = array(
		'name' => array(
		/*	'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'required' => TRUE,
				'message' => 'Letters and numbers only',
			), */
			'uniqueBrandname' => array(
				'rule' => array('unqiueBrandname', 'name'),
				'message' => 'Your brand name already exists. PLease choose another name.',
			),
		),
	);
		
	/**
	 * defines a relationship between Brands and Users.
	 * A user can maintain multiple brands, a brand can be maintained by multiple users
	 */
	var $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'brands_users',
			'foreignKey' => 'brand_id',
			'associatedForeignKey' => 'user_id',
			'unique' => TRUE,
		),
	);
	
  /**
   * Validation rule: brandnames must be unique
   */
	function unqiueBrandname($data) {
		$brand = $this->find(array('name' => $data['name']), array('id', 'name'));
    if ($brand) {
	    return FALSE;
    }

    return TRUE;
	}		
}