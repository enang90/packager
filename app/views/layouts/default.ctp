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
			top: 53,
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

		<header>
      <span class="title"><?php __('Pandion Packager'); ?></span>
	
	  	<?php echo $this->element('brand'); ?>
	
  	  <?php echo $this->element('login'); ?>

      <nav>
         <li>Dashboard</li>
         <li>Appcasting</li>
         <li>Extras</li>
         <li>Statistics</li>
         <li>Subscription</li>
	    </nav>

    </header>

    <div class="content">
	    <?php echo $session->flash(); ?>
	    <?php echo $session->flash('auth'); ?>
      <?php echo $content_for_layout ?>
    </div>

    <footer>
	    Lorem ipsum
	  </footer>
  </div>

</body>