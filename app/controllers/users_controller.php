<?php
class UsersController extends AppController {
  var $view = 'Theme';
  var $theme = 'public';
  var $name = 'Users';
  var $components = array('Upload');
  var $uses = array('User', 'Brand');

  var $permissions = array(
    'register' => '*',
    'logout' => '*',
    'setgroup' => '*',
    'index' => array('authenticated'),
  );

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('register', 'information');
  }

  function index() { }

  /**
  * Registers a new user account and their first brand
  */
  function register() {
    // A logged in user shouldn't be hitting the register page
    if ($this->Auth->user()) {
      $this->redirect(array('controller' => 'brands', 'action' => 'index'));
    }

    if (!empty($this->data)) {
      // let's register the User
      $this->User->set($this->data);
      if ($this->User->validates()) {
        $this->data['User']['group_id'] = '2';
        if ($this->User->save($this->data)) {
          $login = $this->Auth->login($this->data);
          if ($login) {
            $this->redirect($this->Auth->redirect());
          }
        }
      }
    }
  }

  /**
  * Login functionality
  * This is a callback function executed after authentication. It will set the users' group
  * in the session. This will then be used in the isAuthorized() function to check the permissions
  */
  function login() { 
    // look at brands/index for relevant code
  }

  /**
  * Simple logout. Destroys the session.
  */
  function logout() {
    $this->Session->destroy();  // @todo not in Auth->logout ? Weird!
    $this->Session->setFlash('Logout');
    $this->redirect($this->Auth->logout());
  }
}