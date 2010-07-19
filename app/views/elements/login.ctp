<?php 
  $variables = $this->requestAction('users/information'); 
  extract($variables);
?>
<div id="user-info">
	<?php 
	  // @todo move logic to controller (?)
	  if (!$logged_in) :
	    $login_link = $html->link('log in', '/users/login', array('class'=>'button','target'=>''));
	    $login = sprintf(__(', please %s', TRUE), $login_link);
    else :
      $login = '';
    endif;
  ?>
	
	<p><?php echo sprintf(__('Howdy <strong>%s</strong>%s', TRUE), $user['username'], $login); ?></p>
	
	<?php if (!$logged_in) : ?>
  	<?php $signup = $html->link('sign up', '/users/register', array('class'=>'button','target'=>'')); ?>
    <p><?php echo sprintf(__('Did you %s already?', TRUE), $signup); ?></p>
  <?php else : ?>
		<p><?php print $html->link('Log out', '/users/logout', array('class'=>'button','target'=>'')); ?></p>
	<?php endif;?>
</div>