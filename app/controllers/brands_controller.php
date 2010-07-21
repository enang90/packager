<?php

class BrandsController extends AppController {
  var $name = 'Brands';
  var $components = array('Upload', 'Session');

  var $uses = array('User', 'Brand');

  function beforeFilter() {
	  parent::beforeFilter();
	  $this->Auth->allow('information', 'add');
  }

  /**
   * Preprocesses information for the brand.ctp element
   */
  function information() { 
    if (isset($this->params['requested'])) {
	    $brands = array();
      $brand = $this->Session->read('Brand');
	
	    if ($_user = $this->Auth->user()) {
        // @todo: generate a list of brands and show them in a form element
        // @todo: user story if 1 brand v multiple brands v a user
        $this->User->id = $_user['User']['id'];
        $data = $this->User->read();
 		    $brands = $data['Brand']; // multiple brands

        if ($brand) {
	        foreach ($brands as $key => $_brand) {
        		$brands[$key]['active'] = FALSE;
		        if ($brands[$key]['id'] == $brand['id']) {
		          $brands[$key]['active'] = TRUE;
		        }
	        }
        }
	    } else if ($brand) {
		    $brand['active'] = TRUE;
    		$brands[] = $brand;
	    }

		  $variables = compact('brands');
	
		  return $variables;
    }
    // If someone goes to /brands/information, redirect to the controller
	  $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	}
		
	/**
	 * Add a brand new brand
	 */
	function add() {
		if ((!empty($this->data)) && ($this->Brand->validates())) {
			$auto_login = FALSE; // @todo:  change this with _loggedIn property from Auth component
			
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
						$this->redirect('/brands/add');
						exit();
   		}

      $user = $this->Session->read('Auth.User');
    
      if (!$user) {
        // create a new stub user and save the user.
        // @todo are the username/password random enough?
        // @todo add an extra flag to indicate they are a stub?
        $data = array(
	        'User' => array(
		        //'username' => 'Guest' . Security::hash(Configure::read('Security.salt') . time() . rand(1, 100)),
		        'username' => 'Guest',
		        'password' => Security::hash(Configure::read('Security.salt') . (time() + 10) . rand(1, 100)),
  		      'email' => '', 
	  	      'blocked' => 1,
		      ),
		    );

        // @todo: use $this->User instead		
        $user = ClassRegistry::init('User');
        $user->create();
        $user->save($data, FALSE);
        $auto_login = TRUE;

	      $this->data['User']['id'] = $user->id;
      } else {
        $this->data['User']['id'] = $user['id'];
      }

      // Save the Brand and return to the dashboard
      if ($this->Brand->save($this->data)) {
	      $brand = $this->Brand->find("id = '" . $this->Brand->id . "'"); // urgh, extra query...
	      $this->Session->write('Brand', $brand['Brand']);
        $this->Session->setFlash('Your brand has been saved');
      }

      // let's autologin with the stub user
      /* if ($auto_login) {
        $login = $this->Auth->login($data);
        if ($login) {
	        $this->redirect($this->Auth->redirect());
        }
      } */

      // @todo redirect to the actual page they are on instead of defaulting to the dashboard
			$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
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
	    if ($this->Brand->save($this->data)) {
	      $this->Session->setFlash('Your Brand has been updated');
	      $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	    }
    }
	}
}
