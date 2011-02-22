<?php

// @todo create doc for this class
class Track extends AppModel {
	var $name = 'Track';

	var $belongsTo = array(
		'Version' => array(
			'className' => 'Version',
      'foreignKey' => 'version_id',
		),
	);	
}