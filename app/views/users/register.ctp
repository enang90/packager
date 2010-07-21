<h2>Sign up</h2>

<p><?php echo __('Register an account with Pandion Packager.'); ?></p>

<?php
  echo $this->Form->create('User', array('action' => 'register'));
  echo $this->Form->input('username');
  echo $this->Form->input('email');
  echo $this->Form->input('password');
  echo $this->Form->input('password_confirm', array('label' => 'Confirm password', 'type' => 'password'));
  echo $this->Form->end('Sign up!');
?>