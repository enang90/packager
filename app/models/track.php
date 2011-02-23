<?php

// @todo create doc for this class
class Track extends AppModel {
	var $name = 'Track';

	var $belongsTo = array(
		'Brand' => array(
			'className' => 'Brand',
      'foreignKey' => 'brand_id',
		),
	);
	
  function beforeSave() {
    // Set the updated time of a track item.
    
    $this->old = $this->find(array('Track.id' => $this->id));

    if ($this->old){
      $changed_fields = array();
      foreach ($this->data[$this->alias] as $key => $value) {
        $fields = array('track_stable_id', 'track_beta_id', 'track_dev_id');
        if (in_array($key, $fields)) {
          if ($this->old[$this->alias][$key] != (int)$value) {
            switch ($key) {
              case 'track_stable_id' :
                $this->data[$this->alias]['track_stable_time'] = date('U'); // now
                break;
              case 'track_beta_id' :
                $this->data[$this->alias]['track_beta_time'] = date('U'); // now
                break;
              case 'track_dev_id' :
                $this->data[$this->alias]['track_dev_time'] = date('U'); // now
                break;
            }
          }
        } 
      }
    }
    
    return TRUE;
  }
}