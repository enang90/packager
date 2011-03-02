<?php
 
class SettingsController extends AppController {
	var $name = 'Settings'; 
	var $helpers = array('Html', 'Form');
 	var $view = 'Theme';
	var $theme = 'private';
	
	function beforeFilter() {
	  parent::beforeFilter();
    $this->theme = 'admin';
	}

  /**
   * Implements the cake index() method
   */
	function admin_index() {
		$this->Setting->recursive = 0;
		$this->set('settings', $this->paginate());
	}
 
  /**
   * Implements the cake view() method
   */
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Setting.', true));
			$this->redirect(array('action'=>'index'));
		}
 
		$this->set('setting', $this->Setting->read(null, $id));
	}
 
  /**
   * Implements the cake add() method.
   */
	function admin_add() {
		if (!empty($this->data)) {
			$this->Setting->create();
			if ($this->Setting->save($this->data)) {
				$this->Session->setFlash(__('The Setting has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Setting could not be saved. Please, try again.', true));
			}
		}
	}
 
  /**
   * Implements the cake edit() method.
   */
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Setting', true));
			$this->redirect(array('action'=>'index'));
		}
 
		if (!empty($this->data)) {
			if ($this->Setting->save($this->data)) {
				$this->Session->setFlash(__('The Setting has been saved', true));
				$this->redirect(array('action'=>'index'));
 
			} else {
				$this->Session->setFlash(__('The Setting could not be saved. Please, try again.', true));
			}
		}
 
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, $id);
		}
	}
 
  /**
   * Implements the cake delete() method.
   */
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Setting', true));
			$this->redirect(array('action'=>'index'));
		}
 
		if ($this->Setting->del($id)) {
			$this->Session->setFlash(__('Setting deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
 
}?>