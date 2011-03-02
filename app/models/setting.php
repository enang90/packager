<?php
class Setting extends AppModel {
  var $name = 'Setting';
  var $validate = array(
	  'key' => array(
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
			'length' => array(
	      'rule' => array('maxLength', 60),
	      'message'=>'That Value is a bit too long, keep it under 60 characters'
	    ),
    ),
		'value' => array( 
			'allowEmpty' => array(
				'allowEmpty' => FALSE,
				'required' => TRUE,
				'rule' => array('notEmpty'),
			),
			'length' => array(
	      'rule' => array('maxLength', 60),
	      'message'=>'That Value is a bit too long, keep it under 60 characters'
	    ),
    ),
	);
	
	/**
	 * Gets the value of a Setting
	 * @param string $key the key of the setting. This should be unique
	 * @param string $default a default if $key returns no result (value not set or not found)
	 * @return mixed The value of the setting or FALSE if not found and no default has been set
	 */
	function getValue($key, $default = NULL) { 
		if (!empty($key)) {
		  if ($setting = $this->findByKey($key)) {
  		  return $setting['Setting']['value'];			
		  }
		
	  	if (!is_null($default)) {
			  return $default;
		  }
	  }
    return FALSE;
	}
}
?>