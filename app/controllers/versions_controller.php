<?php
class VersionsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Versions';
  var $components = array('Session', 'Appcast', 'Hudson');
  var $uses = array('User', 'Brand');

  function index() {
	
  }

  function add() {
    $versions = $this->Appcast->get_appcast_feed();
    $this->set('versions', $versions);

    $this->Hudson->buildJob();
  }

}