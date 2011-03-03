<section class="panel">

  <section class="dialog">

    <h1 class="auth"><?php echo __('Log In'); ?></h1>
    <p><?php echo __('Enter your email address and password to access your IM client dashboard.'); ?></p>

<?php
  echo $this->Form->create('User', array('action' => 'login'));
  echo $this->Form->input('email');
  echo $this->Form->input('password');
  echo $this->Form->end(array('label' => 'Log In', 'class' => 'bonbon blue'));
?>

  </section>

</section>
