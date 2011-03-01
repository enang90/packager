<?php
class TracksController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Tracks';
  var $components = array('Upload', 'Session');
  var $uses = array('User', 'Brand', 'Version', 'Track');

  var $permissions = array(
    'index' => '*',
    'edit' => array('authenticated'),
  );

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
    
    // limit access to feature until activated
    if (!($brand = $this->_getBrand())) {
      $this->redirect(array('controller' => 'brands', 'action' => 'index'));
    }

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

  /**
   * Retrieve the brand data from the session
   * @return $brand mixed FALSE if not found/inactive, otherwise: an array with brand data
   */
  function _getBrand() {
    $brand = $this->Session->read('Brand');

    // brand not found
    if (!$brand) {
      $this->_flash(__('We could not find a brand associated with your session. Please switch to a brand through the brand selector.', TRUE), 'pandion');
      $brand = FALSE;
    }

    // brand not active
    if (!$brand['active']) {
      $this->_flash(sprintf(__('The current brand \'%s\' is not activated. You need a subscription plan before you can proceed using our features.', TRUE), $brand['name']), 'pandion');
      $brand = FALSE;
    }

    return $brand;
  }
}
