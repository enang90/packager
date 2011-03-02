<!DOCTYPE html>

<head>
  <title><?php echo $title_for_layout?></title>
  <!-- Include external files and scripts here (See HTML helper for more info.) -->
  <?php echo $this->Html->css('main.css'); ?>
	<?php echo $this->Html->script(array('jquery.min.js', 'jquery.tools.min.js'));?>

  <?php echo $scripts_for_layout ?>
</head>

<body>

	<div id="container">

		<header class="clearfix">
			<img src="/img/pandion_thumb.png" alt="Pandion logo" />
      <h1><?php __('Mission control'); ?></h1>

      <div id="sections">
	      <nav id="sections-menu">
	        <li><?php print $this->Html->link('Public', '/'); ?></li>
	        <li><?php print $this->Html->link('Private', '/brands'); ?></li>
	      </nav>
      </div>

      <div class="clearfix" id="primary">
        <nav id="primary-menu">
          <li><?php print $this->Html->link('Settings', array('controller' => 'settings', 'action' => 'index')); ?></li>
          <li><?php print $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>
          <li><?php print $this->Html->link('Brands', array('controller' => 'brands', 'action' => 'index')); ?></li>
        </nav>
      </div>

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