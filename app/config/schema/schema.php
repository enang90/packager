<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2011-03-02 05:03:11 : 1299040691*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $brands = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 155),
		'icon' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'subscription_id' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'owner' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'job_created' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 6),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	var $brands_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'brand_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	var $groups = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $settings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'value' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 60),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $subscriptions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 155),
		'amount' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'term' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 155),
		'period' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'active' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	var $tracks = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'track_stable_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'track_beta_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'track_dev_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'track_stable_active' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'track_beta_active' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'track_dev_active' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'track_stable_time' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'track_beta_time' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'track_dev_time' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'brand_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'blocked' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	var $versions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'brand_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'inittime' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'version_major' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'version_minor' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'version_build' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'source_official_tag' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'source_type' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'source_git_url' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'name_safe' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'company' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'homepage_url' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'support_url' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'info_url' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'packager_token' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
		'hudson_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'hudson_artifact' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'hudson_artifact_size' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'uuid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
		'publishtime' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);
}
?>