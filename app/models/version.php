<?php

define('PACKAGER_VERSION_INIT', 0);
define('PACKAGER_VERSION_NOTIFIED', 1);
define('PACKAGER_VERSION_PENDING', 2);
define('PACKAGER_VERSION_SUCCESS', 3);
define('PACKAGER_VERSION_FAILURE', 4);
define('PACKAGER_VERSION_TIMEOUT', 5);
define('PACKAGER_VERSION_MISSINGARTIFACT', 6);

// @todo create doc for this class
class Version extends AppModel {
	var $name = 'Version';
	var $actsAs = array('Uuid' => array('field' => 'uuid'));

	var $belongsTo = array(
		'Brand' => array(
			'className' => 'Brand',
      'foreignKey' => 'brand_id',
		),
	);
	
	/**
	 * Defines a releationship between Brands and versions
	 * A brand can spawn multiple versions (or Hudson builds)
	 */
	var $hasMany = array(
		'Track' => array(
			'className' => 'Track',
			'foreignKey' => 'version_id',
			'dependent' => TRUE, // delete versions if version is deleted
		),
	);

	var $validate = array(
		'source_type' => array(
			'alphaNumeric' => array(
				'allowEmpty' => FALSE,
    		'required' => TRUE,
				'rule' => array('alphaNumeric'),
			),
		),
		'source_official_tag' => array(
			'alphaNumeric' => array(
				'allowEmpty' => TRUE,
				'required' => TRUE,
				'rule' => array('alphaNumeric'),
			),
		),
		'name' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
		),
		'name_safe' => array(
			'alphaNumeric' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('alphaNumeric'),
			),
		),
		'company' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
		),
	  'homepage_url' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
			'website'  => array(
				'rule' => 'url',
			),
	  ),
	  'support_url' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
	  	),
  		'website'  => array(
	  		'rule' => 'url',
		  ),
		),
	  'info_url' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
  		'website'  => array(
    		'rule' => 'url',
	    ),
	  ),
		'version_major' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'This field can only contain numbers',
			),
			'uniqueVersion' => array(
				'rule' => array('uniqueVersion', 'major'),
			),
			'notZero' => array(
				'rule' => array('comparison', '>', 0),
			),
		),
	  'version_minor' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'This field can only contain numbers',
			),
			'uniqueVersion' => array(
	  		'rule' => array('uniqueVersion', 'minor'),
		  ),
		),
	  'version_build' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'This field can only contain numbers',
			),
			'uniqueVersion' => array(
	  		'rule' => array('uniqueVersion', 'build'),
	    ),
		),
  );

	/**
	 * Validation rule: compare versions. A version number should always be larger then the previous largest
	 */
	function uniqueVersion($data, $version = 'major') {
		static $maxversion;
		static $skip;
	
	  if (is_null($skip)) {		
		  if (!$maxversion) {
	  	  $maxversion = $this->findAllByBrandId($this->data['Version']['brand_id'], array('version_major, version_minor, version_build'), array('version_major DESC'), '0, 1');
	      if (empty($maxversion)) {
		      return TRUE; // no version yet added
	      }

	      $maxversion = implode('.', $maxversion[0]['Version']);
	    }
	
		  $form_version = implode('.', array($this->data['Version']['version_major'], $this->data['Version']['version_minor'], $this->data['Version']['version_build']));
	
		  if (version_compare($form_version, $maxversion, '<=')) {
	      $skip = FALSE;
	      return $skip;
		  }
	
		  $skip = TRUE;
		}
		
		return $skip;
	}
}