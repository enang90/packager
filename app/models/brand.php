<?php
// @todo create doc for this class
class Brand extends AppModel {
	var $name = 'Brand';

	/* @todo do I really need a brand safe name for Hudson? */
	var $validate = array(
		'name' => array(
			'alphaNumeric' => array(
				'allowEmpty' => FALSE,
		  	'required' => TRUE,
				'rule' => array('alphaNumeric'),
		    'message' => 'Letters and numbers only',
    	),
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
	 * Defines a releationship between Brands and versions
	 * A brand can spawn multiple versions (or Hudson builds)
	 */
	var $hasMany = array(
		'Version' => array(
			'className' => 'Version',
			'foreignKey' => 'brand_id',
			'dependent' => TRUE, // delete versions if brand is deleted
		),
	);
	
	var $hasOne = array(
	  'Track' => array(
			'className' => 'Track',
			'foreignKey' => 'brand_id',
			'dependent' => TRUE, // delete Tracks if brand is deleted
		),
	);
	
	/**
	 * @todo: define a hasmany relationship with subscriptions
	 */
		
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