<?php
class BrandsController extends AppController {
	var $view = 'Theme';
	var $theme = 'private';
  var $name = 'Brands';
  var $components = array('Upload', 'Session', 'PandionAsset');
  var $uses = array('Brand', 'User', 'Setting');
  
  var $permissions = array(
    'index' => '*',
    'help' => '*',
    'add' => array('authenticated'),
    'edit' => array('authenticated'),
    'switchBrand' => array('authenticated'),
  );

  // @todo: figure out why this piece of code has to be here if loginRedirect is set (?)
  //   should be in the users/login action after validation success
  function index() {
    if ($this->Auth->user()) {
      $this->Session->write('Auth.User.group', $this->User->Group->field('name', array('id' => $this->Auth->user('group_id'))));
    }
	}
	
	function help() { }

  function beforeFilter() {
	  parent::beforeFilter();

	  if (isset($this->params['admin'])) {
	    $this->theme = 'admin';
	  }
  }
		
	/**
	 * Add a brand new brand
	 */
	function add() {
	  $this->set('user_id', $this->User->id);

	  if ($this->data) {
	    // create an md5 hashed foldername
	    $this->data['Brand']['folder'] = md5($this->data['Brand']['name']);

	    if ($id = $this->Brand->save($this->data)) {
	      $this->Brand->read(NULL, $this->Brand->id);
	      $brand = $this->Brand->data['Brand'];

	      $this->PandionAsset->setBrandFolder($brand['folder']);
        $brandFolder = $this->PandionAsset->createBrandFolder();

        if ($errors = $this->PandionAsset->errors()) {
          $this->_flash(sprintf(__('Oops. Something went wrong. We could not save your brand.', TRUE)), 'pandion');
          foreach ($errors as $error) {
            $this->log("Brand # " . $brand['name'] . " :: $error", 'pandion');
          }
          // @todo: why does this redirect to the folder instead of 'index'
          $this->redirect(array('controller' => 'brands', 'action' => 'add'));
	      }

	      // @todo: move the upload functionality of an icon to the model :: getter/setter function
        /* if ($this->PandionFolder->createBrandFolder($brandName)) {
          if (!$this->data['Brand']['image']['error']) {
        	  $this->_uploadBrandIcon();
        	}
        } */

	      // Set the brand as active for the users' session
	      $this->Session->write('Brand', $brand);

	      // Flash message + redirect to the subscriptions page
        $this->_flash(sprintf(__('Your brand %s has been saved.', TRUE), $brand['name']), 'pandion');
        $this->redirect(array('controller' => 'subscriptions', 'action' => 'index'));
      }

      $this->_flash(sprintf(__('Oops. Something went wrong. We could not save your brand.', TRUE)), 'pandion');
      $this->redirect(array('controller' => 'brands', 'action' => 'index'));
	  }
	}

	/**
	 * Edit a brand
	 */
	function edit($id = NULL) {
		$this->Brand->id = $id;
    if (empty($this->data)) {
	    $this->data = $this->Brand->read();
    } else {

    	$this->_uploadBrandIcon();

	    if ($this->Brand->save($this->data, FALSE)) {
		    $this->Session->write('Brand', $this->Brand->data['Brand']);
	      $this->Session->setFlash('Your Brand has been updated');
	      $this->redirect(array('controller' => 'brands', 'action' => 'index'));
	    }
    }
	}
	
	/**
	 * Switch to a different active Brand
	 */
	function switchBrand($id = NULL) {
		if ($id) {			
		  $this->Brand->id = $id;
		  $data = $this->Brand->read();
      if ($this->Session->read('Brand')) {
	      $this->Session->delete('Brand');
      }
      $this->Session->write('Brand', $data['Brand']);
	  }
		
    $this->redirect(array('controller' => 'brands', 'action' => 'index'));
	}

	function _uploadBrandIcon() {

		// Image handling
		$destination = realpath('../../app/webroot/img/icons/') . '/';
		$file = $this->data['Brand']['image'];

		$ext = $this->Upload->ext($file['name']);
		$uniquename = md5($this->data['Brand']['image']['name'] . time()) . '.' . $ext; // ensure uniqueness

		$result = $this->Upload->upload($file, $destination, $uniquename, array('type' => 'resizecrop', 'size' => array('50', '50'), 'output' => 'jpg'));

		if (!$result){
			$this->data['Brand']['icon'] =  $this->Upload->result;
		} else {
			// display error
			$errors = $this->Upload->errors;

			// piece together errors
			if (is_array($errors)) {
	      $errors = implode("<br />",$errors); 
	    }

			$this->Session->setFlash($errors);
			$this->redirect(array('controller' => 'brands', 'action' => 'index'));
			exit();
 		}
	}

	function admin_index() {
		$this->Brand->recursive = 0;
		$this->set('brands', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid brand', true), array('action' => 'index'));
		}
		$this->set('brand', $this->Brand->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Brand->create();
			if ($this->Brand->save($this->data)) {
				$this->flash(__('Brand saved.', true), array('action' => 'index'));
			} else {
			}
		}
		$users = $this->Brand->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid brand', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Brand->save($this->data)) {
				$this->flash(__('The brand has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Brand->read(null, $id);
		}
		$users = $this->Brand->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid brand', true)), array('action' => 'index'));
		}
		if ($this->Brand->delete($id)) {
			$this->flash(__('Brand deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Brand was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
