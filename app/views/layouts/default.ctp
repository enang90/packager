<!DOCTYPE html>

<head>
  <title><?php echo $title_for_layout?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- Include external files and scripts here (See HTML helper for more info.) -->
  <?php echo $this->Html->css('main.css'); ?>

  <?php echo $scripts_for_layout ?>
</head>

<body>
	
	<div id="container">

		<header>
      <h1><?php __('Pandion Packager'); ?></h1>
	
	  	<?php echo $this->element('brand'); ?>
	
  	  <?php echo $this->element('login'); ?>

      <nav>
         <li>Dashboard</li>
         <li>Versions</li>
         <li>Statistics</li>
         <li>Subscription</li>
	    </nav>

    </header>

    <div class="content">
	    <?php echo $this->Session->flash(); ?>
      <?php echo $content_for_layout ?>
    </div>

    <footer>
	    Lorem ipsum
	  </footer>
  </div>

</body>