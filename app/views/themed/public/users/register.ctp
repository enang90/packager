<section class="panel">

  <section class="dialog">

    <h1><?php echo __('Sign Up'); ?></h1>
    <p><?php echo __('Create an account to get started.'); ?></p>

    <?php
      echo $this->Form->create('User', array('action' => 'register'));
    ?>

    <div class="user-registration">
    <?php
      echo $this->Form->input('name', array('autofocus' => 'autofocus'));
      echo $this->Form->input('email');
      echo $this->Form->input('password');
      echo $this->Form->input('password_confirm', array('label' => 'Confirm Password', 'type' => 'password'));
    ?>
    </div>

    <?php
      echo $this->Form->end(array('label' => 'Sign Up!', 'class' => 'bonbon blue'));
    ?>

  </section>

</section>
