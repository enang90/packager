<div class="brands form">
<?php echo $this->Form->create('Brand');?>
	<fieldset>
 		<legend><?php __('Admin Add Brand'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('icon');
		echo $this->Form->input('subscription_id');
		echo $this->Form->input('owner');
		echo $this->Form->input('job_created');
		echo $this->Form->input('active');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Brands', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tracks', true), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track', true), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versions', true), array('controller' => 'versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version', true), array('controller' => 'versions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>