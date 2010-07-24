<div id="user-widget">
	<?php 
	  // @todo move logic to controller (?)
	  if ($user = $session->read('Auth.User')) :
	    $login = '';
	    $username = $user['first_name'] . ' ' . $user['last_name'];
    else :
      $login = sprintf(__(', please %s', TRUE), $html->link('log in', '/users/login', array('class'=>'button','target'=>'')));
      $username = 'Guest';
    endif;
  ?>
	
	<p><?php echo sprintf(__('Howdy <strong>%s</strong>%s', TRUE), $username, $login); ?></p>
	
	<?php if (!$user) : ?>
  	<?php $signup = $html->link('sign up', '/users/register', array('class'=>'button','target'=>'')); ?>
    <p><?php echo sprintf(__('Did you %s already?', TRUE), $signup); ?></p>
  <?php else : ?>
		<p><?php print $html->link('Log out', '/users/logout', array('class'=>'button','target'=>'')); ?></p>
	<?php endif;?>
</div>