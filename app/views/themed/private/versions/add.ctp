<nav>
   <li><?php print $this->Html->link('Publishing updates', '/appcasting'); ?></li>
   <li><?php print $this->Html->link('Version archive', '/appcasting/archive'); ?></li>
   <li><?php print $this->Html->link('Add a version', '/appcasting/add'); ?></li>
</nav>

<section id="add-version">

	<h2><?php __('Create a new version'); ?></h2>
	
	<?php echo $this->Form->create('Version', array('type' => 'file')); ?>
	
	<?php echo $this->Form->input('Brand.id', array('type' => 'hidden', ))?>
	
	<h3><?php __('Step 1: source code'); ?></h3>

  <?php __('Choose a source code to use as a basis for this brand version'); ?>
   <?php echo $this->Form->input('pandion_source'); ?>

	<?php	
	/*echo $this->Form->input('name');
	echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $user_id));
	echo $this->Form->input('owner', array('type' => 'hidden', 'value' => $user_id));
	echo $this->Form->file('image'); */
	echo $this->Form->end('Build version');
?>
</section>