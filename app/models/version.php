<?php
// @todo create doc for this class
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
			/* 'uniqueVersion' => array(
				'rule' => array('uniqueVersion', 'major'),
			), */
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
  		/* 'uniqueVersion' => array(
	  		'rule' => array('uniqueVersion', 'major'),
		  ), */
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
		/* 'uniqueVersion' => array(
			'rule' => array('uniqueVersion', 'major'),
		), */
	  ),
	);

	/**
	 * Validation rule: usernames must be unique
	 */
	function uniqueVersion($data, $version = 'major') {
    switch ($version) {
	    default:
	    case 'major':
	      $field = 'version_major';
	      break;
	    case 'minor':
	      $field = 'version_minor';
	      break;
	    case 'build':
	      $field = 'version_build';
	      break;
    }
		$maxversion = $this->findAllByBrandId($this->data['Version']['brand_id'], array('MAX(' . $field . ') AS version_max'));
		if ($maxversion[0][0]['version_max'] >= $data[$field]) {
			return FALSE;
		}

	  return TRUE;
	}
}