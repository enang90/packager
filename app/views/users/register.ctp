<h2>Sign up</h2>

<p><?php echo __('Register an account with Pandion Packager.'); ?></p>

<?php
  echo $form->create('User', array('action' => 'register'));
  echo $form->input('username');
  echo $form->input('email');
  echo $form->input('password');
  echo $form->input('password_confirm', array('label' => 'Confirm password'));
  echo $form->end('Sign up!');
?>