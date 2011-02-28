<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $title_for_layout?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <?php echo $this->Html->css('reset.css'); ?>
  <?php echo $this->Html->css('public.css'); ?>
  <?php echo $scripts_for_layout; ?>
</head>
<body>

  <div id="container">

    <header class="navigation">
      <hgroup class="logo">
        <h1><?php __('Pandion Packager'); ?></h1>
        <h2><?php __('IM client management made easy.'); ?></h2>
      </hgroup>
      <?php echo $this->element('login'); ?>
    </header>

    <section class="content">
      <?php echo $session->flash(); ?>
      <?php echo $session->flash('auth'); ?>
      <?php echo $content_for_layout; ?>
    </section>

    <section class="sitemap">
      <h1><?php __('Sitemap'); ?></h1>
      <ul>
        <li><?php echo $html->link(__('Home', TRUE), '/', array()); ?></li>
        <li><?php echo $html->link(__('Pricing and Sign Up', TRUE), '/users/login', array()); ?></li>
        <li><?php echo $html->link(__('Manage your IM Client', TRUE), '/brands', array()); ?></li>
        <li><?php echo $html->link(__('About', TRUE), '/about', array()); ?></li>
      </ul>
    </section>

    <section class="outro">
      <article class="info">
        <h1><?php __('Open Source à la Carte'); ?></h1>
        <p><?php __('While anyone can download the <a href="https://github.com/pandion/pandion">Pandion IM source code</a> to create custom builds, this requires considerable time-investment and programming skills. The Pandion Packager service was created for network administrators to save time and deliver better results while maintaining full control over their deployment. And the service fees help grow the open source Pandion IM project: win-win.'); ?></p>
      </article>
    </section>

    <footer class="closing">
      <p><?php __('Copyright &copy; Pandion Pte. Ltd. All rights reserved.'); ?></p>
    </footer>

  </div>

</body>
</html>
