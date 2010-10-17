	<h2><?php __('Create a new version'); ?></h2>
	
	  <?php echo $this->Form->create('Version', array('type' => 'file')); ?>
	
  	<?php echo $this->Form->input('brand_id', array('type' => 'hidden', 'value' => $brand_id))?>

    <fieldset>
    	<h3><?php __('Step 1: source code'); ?></h3>

      <div class="form-hudson-sourcetype form-item">
        <?php echo $this->Form->radio('source_type', array('Official', 'Upload', 'Git'), array('label' => 'Source type')); ?>
        <small><?php __('Choose from which source you want to build a version.')?></small>
      </div>
   
      <div class="form-hudson-sourceofficialtag form-item">
	      <?php echo $this->Form->label(NULL, 'Official source tag'); ?>
        <?php echo $this->Form->select('source_official_tag', array('Stable', 'Beta', 'Development')); ?>
        <small><?php __('Choose the development track from which you want to build.'); ?></small>
      </div>

      <div class="form-hudson-sourcegitrepo form-item">
	      <?php echo $this->Form->input('source_git_url', array('label' => 'Source Git URL')); ?>
        <small><?php __('Select a custom source from a Git repository.'); ?></small>
	    </div>
    </fieldset>

    <fieldset>
  		<h3><?php __('Step 2: Choose a version number'); ?></h3>

      <div class="form-hudson-versionnumber form-item">
        <?php echo $this->Form->input('version_major'); ?>
		    <?php echo $this->Form->input('version_minor'); ?>
		    <?php echo $this->Form->input('version_build'); ?>
  	  	<small><?php __('A version is identified by a unique three digit number. An update must always have a higher
 	  	     number then the previous version.')?></small>
		  </div>
		</fieldset>

    <fieldset>

		<h3><?php __('Step 3: Enter specific information'); ?></h3>

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