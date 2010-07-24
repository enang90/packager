<h2>Sign up</h2>

<p><?php echo __('Register an account with Pandion Packager.'); ?></p>

<?php
  echo $this->Form->create('User', array('action' => 'register', 'type' => 'file'));
?>

<div class="user-registration">
<?php
  echo $this->Form->input('first_name', array('label' => 'First name'));
  echo $this->Form->input('last_name', array('label' => 'Last name'));
  echo $this->Form->input('email');
  echo $this->Form->input('password');
  echo $this->Form->input('password_confirm', array('label' => 'Confirm password', 'type' => 'password'));
?>
</div>

<div class="brand-registration">
<?php
  echo $this->Form->input('Brand.name', array('label' => 'Brand name'));
?>
</div>

<?php
  echo $this->Form->end('Sign up!');
?>