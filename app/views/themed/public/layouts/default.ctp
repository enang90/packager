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

		<header class="clearfix">
			<img src="/img/pandion_thumb.png" alt="Pandion logo" id="logo" />
      <h1><?php __('Pandion Packager'); ?></h1>
	
  	  <?php echo $this->element('login'); ?>
    </header>

    <nav>
       <li>Home</li>
       <li>Features</li>
       <li>Pricing</li>
       <li>Get started</li>
    </nav>

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