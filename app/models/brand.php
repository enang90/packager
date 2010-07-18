<?php

class Brand extends AppModel {
	var $name = 'Brand';
	
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
		
}