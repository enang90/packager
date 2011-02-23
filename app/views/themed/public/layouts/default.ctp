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

  <header>
    <hgroup>
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
      <li><?php __('Home'); ?></li>
      <li><?php __('Pricing and Sign Up'); ?></li>
      <li><?php __('Dashboard'); ?></li>
    </ul>
  </section>

  <section class="outro">
    <article>
      <h1><?php __('Open Source à la Carte'); ?></h1>
      <p><?php __('While anyone can download the <a href="https://github.com/pandion/pandion">Pandion IM source code</a> to create custom builds, this requires considerable time-investment and programming skills. The Pandion Packager service was created for network administrators to save time and deliver better results while maintaining full control over their deployment. And the service fees help grow the open source Pandion IM project: win-win.'); ?></p>
    </article>
  </section>

  <footer>
    <p class="closing"><?php __('Copyright &copy; Pandion Pte. Ltd. All rights reserved.'); ?></p>
  </footer>

</body>
</html>
