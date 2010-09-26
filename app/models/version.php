<?php
class Version extends AppModel {
	var $name = 'Version';

	var $belongsTo = array(
		'Brand' => array(
			'className' => 'Brand',
      'foreignKey' => 'brand_id',
		),
	);

	var $validate = array(
		'source_type' => array(
			'rule' => 'notEmpty',
      'required' => TRUE,			
		),
		'source_official_tag' => array(
			'rule' => 'notEmpty',
      'required' => TRUE,
		),
		'name' => array(
			'rule' => 'notEmpty',
      'required' => TRUE,
		),
  	'name_safe' => array(
	  	'rule' => 'notEmpty',
	    'required' => TRUE,
	  ),
    'company' => array(
    	'rule' => 'notEmpty',
      'required' => TRUE,
	  ),
    'homepage_url' => array(
     	'rule' => 'notEmpty',
      'required' => TRUE,
	  ),
    'support_url' => array(
    	'rule' => 'notEmpty',
      'required' => TRUE,
	  ),
    'info_url' => array(
    	'rule' => 'notEmpty',
      'required' => TRUE,
	  ),
	  'version_major' => array(
			'rule' => 'notEmpty',
      'required' => TRUE,
		),
    'version_minor' => array(
		  'rule' => 'notEmpty',
      'required' => TRUE,
		),
    'version_build' => array(
  		'rule' => 'notEmpty',
      'required' => TRUE,
	  ),
	);	
}