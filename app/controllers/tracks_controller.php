<?php
class TracksController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Tracks';
  var $components = array('Upload', 'Session');
  var $uses = array('User', 'Brand', 'Version', 'Track');

  function beforeFilter() {
	  parent::beforeFilter();
  }
  
  function index() { }

  function edit() {
    if ($this->data) {
      $this->Track->create();
      $d = $this->Track->save($this->data, FALSE);
    }

    $brand = $this->Session->read('Brand');
    $this->Brand->read(NULL, $brand['id']);
    
    if (!$this->Track->id) {
      $this->Track->id = $this->Brand->data['Track']['id'];
    }
    
    $this->data = $this->Track->read();
    
    // retrieve data to generate the publishing updates form
    $versions = array();
    foreach ($this->Brand->data['Version'] as $version) {
      if ($version['status'] == PACKAGER_VERSION_SUCCESS) {
        $_version = $version['name'] . ' (' . $version['version_major'] . "." . $version['version_minor'] . "." . $version['version_build'] . ')';
        $versions[$version['id']] = $_version;
      }
    }


    $this->set('versions', $versions);
    $this->set('brand', $this->Brand->data['Brand']);
  }
}
