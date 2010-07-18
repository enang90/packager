<div id="user-info">
	<?php //$user = $this->requestAction('users/index'); ?>
	<?php $guest = "test"; ?>
	<p><?php echo sprintf(__('Howdy %s', TRUE), $guest); ?></p>
	<?php $signup = $html->link('sign up', '/users/register', array('class'=>'button','target'=>'')); ?>
  <p><?php echo sprintf(__('Did you %s already?', TRUE), $signup); ?></p>
</div>