<!DOCTYPE html>

<head>
  <title><?php echo $title_for_layout?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- Include external files and scripts here (See HTML helper for more info.) -->
  <?php echo $this->Html->css('main.css'); ?>
	<?php echo $this->Html->script(array('https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', 'http://cdn.jquerytools.org/1.1.2/jquery.tools.min.js')); ?>
	
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
	
	    <?php if (isset($user)) : ?>
  	  	<?php echo $this->element('brand'); ?>
	    <?php endif; ?>
	
  	  <?php echo $this->element('login'); ?>

      <nav>
	       <li><?php print $this->Html->link('Dashboard', '/brands'); ?></li>
	       <li><?php print $this->Html->link('Appcasting', '/appcasting'); ?></li>
	       <li><?php print $this->Html->link('Subscriptions', '/brands/subscriptions'); ?></li>
	    </nav>

			<nav class="secondary-menu">
			   <li><?php print $this->Html->link('Publishing updates', '/appcasting'); ?></li>
			   <li><?php print $this->Html->link('Version archive', '/appcasting/archive'); ?></li>
			   <li><?php print $this->Html->link('Add a version', '/appcasting/add'); ?></li>
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