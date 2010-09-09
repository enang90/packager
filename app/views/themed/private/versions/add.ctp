<nav class="secondary-menu">
   <li><?php print $this->Html->link('Publishing updates', '/appcasting'); ?></li>
   <li><?php print $this->Html->link('Version archive', '/appcasting/archive'); ?></li>
   <li><?php print $this->Html->link('Add a version', '/appcasting/add'); ?></li>
</nav>

<section id="add-version">

	<h2><?php __('Create a new version'); ?></h2>
	
	<?php echo $this->Form->create('Version', array('type' => 'file')); ?>
	
	<?php echo $this->Form->input('Brand.id', array('type' => 'hidden', ))?>
	
	
  	<h3><?php __('Step 1: source code'); ?></h3>

    <fieldset>
      <p><?php __('Choose from which source you want to build a version.')?></p>
      <?php echo $this->Form->radio('pandion_source_type', array('Official', 'Upload', 'Git')); ?>
    </fieldset>
    
    <fieldset>
      <p><?php __('Choose a source code to use as a basis for this brand version.'); ?></p>
      <?php echo $this->Form->select('pandion_source', $versions); ?>
    </fieldset>

    <fieldset>
      <p><?php __('Choose the development track from which you want to build.'); ?></p>
      <?php echo $this->Form->select('pandion_track', array('Stable', 'Beta', 'Development')); ?>
    </fieldset>

    <fieldset>
      <p><?php __('Select a custom source from a Git repository.'); ?>
	    <?php echo $this->Form->input('pandion_source_git'); ?>
    </fieldset>


		<h3><?php __('Step 3: version number'); ?></h3>
    <fieldset>
	  	<p><?php __('A version is identified by a unique three digit number. An update must always have a higher
		     number then the previous version.')?></p>
		  <?php echo $this->Form->input('pandion_version_major'); ?> . 
		  <?php echo $this->Form->input('pandion_version_minor'); ?> .
		  <?php echo $this->Form->input('pandion_version_build'); ?>
	  </fieldset>

	<?php	
	/*echo $this->Form->input('name');
	echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $user_id));
	echo $this->Form->input('owner', array('type' => 'hidden', 'value' => $user_id));
	echo $this->Form->file('image'); */
	echo $this->Form->end('Build version');
?>
</section>