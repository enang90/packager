<nav class="account">
  <menu>
	<?php if (!$session->read('Auth.User')) : ?>
    <li><?php echo $html->link(__('Pricing and Sign Up', TRUE), '/users/register', array('class' => 'button')); ?></li>
    <li><?php echo $html->link(__('Log In', TRUE), '/users/login', array('class' => 'button')); ?></li>
  <?php else : ?>
    <li><?php echo $html->link(__('Manage your IM Client', TRUE), '/brands', array('class' => 'button')); ?></li>
    <li><?php echo $html->link(__('Log Out', TRUE), '/users/logout', array('class' => 'button')); ?></li>
	<?php endif;?>
  </menu>
</nav>