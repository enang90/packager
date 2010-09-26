<nav class="secondary-menu">
   <li><?php print $this->Html->link('Publishing updates', '/appcasting'); ?></li>
   <li><?php print $this->Html->link('Version archive', '/appcasting/archive'); ?></li>
   <li><?php print $this->Html->link('Add a version', '/appcasting/add'); ?></li>
</nav>

<section id="add-version">

	<h2><?php __('Create a new version'); ?></h2>
	
	<?php echo $this->Form->create('Version', array('type' => 'file')); ?>
	
	<?php echo $this->Form->input('Brand.id', array('type' => 'hidden', 'value' => $brand_id))?>

    <fieldset>	
    	<h3><?php __('Step 1: source code'); ?></h3>

      <p><?php __('Choose from which source you want to build a version.')?></p>
      <?php echo $this->Form->radio('source_type', array('Official', 'Upload', 'Git')); ?>
    
      <p><?php __('Choose a source code to use as a basis for this brand version.'); ?></p>
      <?php //echo $this->Form->select('source_official_tag', $versions); ?>

      <p><?php __('Choose the development track from which you want to build.'); ?></p>
      <?php echo $this->Form->select('source_official_tag', array('Stable', 'Beta', 'Development')); ?>

      <p><?php __('Select a custom source from a Git repository.'); ?>
	    <?php echo $this->Form->input('source_git_url'); ?>
    </fieldset>

    <fieldset>
	
		<h3><?php __('Step 3: version number'); ?></h3>

	  	<p><?php __('A version is identified by a unique three digit number. An update must always have a higher
		     number then the previous version.')?></p>
		  <?php echo $this->Form->input('version_major'); ?> . 
		  <?php echo $this->Form->input('version_minor'); ?> .
		  <?php echo $this->Form->input('version_build'); ?>
	
      <p><?php __('Choose a brand name which will be displayed.'); ?>
	    <?php echo $this->Form->input('name'); ?>
  
      <p><?php __('Choose a safe brand name.'); ?>
	    <?php echo $this->Form->input('name_safe'); ?>
 
      <p><?php __('Enter your company name.'); ?>
	    <?php echo $this->Form->input('company'); ?>
 
     <p><?php __('Enter your homepage URL'); ?>
	    <?php echo $this->Form->input('homepage_url'); ?>

     <p><?php __('Enter your support URL'); ?>
	   <?php echo $this->Form->input('support_url'); ?>

     <p><?php __('Enter your info URL'); ?>
     <?php echo $this->Form->input('info_url'); ?>

  </fieldset>	

  <?php	echo $this->Form->end('Build version'); ?>
</section>