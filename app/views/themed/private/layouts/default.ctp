<!DOCTYPE html>

<head>
  <title><?php echo $title_for_layout?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- Include external files and scripts here (See HTML helper for more info.) -->
  <?php echo $this->Html->css('main.css'); ?>
	<?php echo $this->Html->script(array('jquery.min.js', 'jquery.tools.min.js'));?>
	
	<script type="text/javascript">
	$(document).ready(function() { 
		
		var triggers = $('.modalInput').overlay({
			left: 0,
			top: 103,
		  mask: {
			  color: '#abcde',
			  loadSpeed: 200,
			  opacity: 0.9,
		  }	
		});
		
	});
	</script>

  <?php echo $scripts_for_layout ?>
</head>

<body>
	
	<div id="container">

		<header class="clearfix">
			<img src="/img/pandion_thumb.png" alt="Pandion logo" />
      <h1><?php __('Pandion Packager'); ?></h1>
	
	    <div class="clearfix" id="primary">
		    <?php if (isset($user)) : ?>
	  	  	<?php echo $this->element('brand'); ?>
		    <?php endif; ?>

	      <nav id="primary-menu">
	        <li><?php print $this->Html->link('Dashboard', '/brands'); ?></li>
		      <li><?php print $this->Html->link('Help', '/brands/help'); ?></li>
	      </nav>

      </div>
	  	
	    <?php echo $this->element('login'); ?>
	
      <nav id="secondary-menu">
			   <li><?php print $this->Html->link('Publishing updates', '/appcasting'); ?></li>
			   <li><?php print $this->Html->link('Version archive', '/appcasting/archive'); ?></li>
			   <li><?php print $this->Html->link('Add a version', '/appcasting/add'); ?></li>
	       <li><?php print $this->Html->link('Change subscription', '/brands/subscriptions'); ?></li>
	    </nav>

    </header>

    <div class="content">
			<div id="messages">
			<?php
	     if ($session->check('Message.flash')) $session->flash(); // the standard messages
	
       // multiple messages
			 if ($messages = $session->read('Message.multiFlash')) {
			   foreach($messages as $k => $v) print $session->flash('multiFlash.' . $k);
			 }
			?>
			</div>
	
	    <?php echo $session->flash('auth'); ?>
      <?php echo $content_for_layout ?>
    </div>

    <footer>
	    Lorem ipsum
	  </footer>
  </div>

</body>