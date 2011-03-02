<nav class="account">
  <menu>
	<?php if (!$session->read('Auth.User')) : ?>
    <li><?php echo $html->link(__('Sign Up', TRUE), '/users/register', array('class' => 'button signup')); ?></li>
    <li><?php echo $html->link(__('Log In', TRUE), '/users/login', array('class' => 'button login')); ?></li>
  <?php else : ?>
    <li><?php echo $html->link(__('Manage your IM Client', TRUE), '/brands', array('class' => 'button manage')); ?></li>
    <li><?php echo $html->link(__('Log Out', TRUE), '/users/logout', array('class' => 'button logout')); ?></li>
	<?php endif;?>
  </menu>
</nav>