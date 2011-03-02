<section class="panel">
  <div class="slideshow">
    <div class="items">
      <div><img src="img/slide1.png" /></div>
      <div><img src="img/slide2.png" /></div>
      <div><img src="img/slide3.png" /></div>
      <div><img src="img/slide4.png" /></div>
    </div>
  </div>
  <a class="prev slidenav">prev</a>
  <a class="next slidenav">next</a>
  <script>
  $(function() {
    $(".slideshow")
      .scrollable({circular: true, keyboard: false})
      .autoscroll({interval: 3000});
  });
  </script>
  <article class="intro">
    <h1><?php __('Customize, Automate, Deploy.'); ?></h1>
    <p><?php __('Pandion Packager is a service for network administrators to automate Pandion IM deployment. Create a branded instant messaging client, configure settings, deploy to unlimited users, and manage software updates. All from an easy to use web interface.'); ?></p>
    <p><?php echo $html->link(__('Sign Up', TRUE), '/users/register', array('class' => 'signup-button')); ?></p>
  </article>
</section>

<nav class="tabs">
  <menu>
    <li><?php echo $html->link(__('Features', TRUE), '/', array('class' => 'active')); ?></li>
    <li><?php echo $html->link(__('Sign Up', TRUE), '/users/register', array()); ?></li>
    <li><?php echo $html->link(__('About', TRUE), '/about', array()); ?></li>
  </menu>
</nav>

<section class="panel">
  <article>
    <h1><?php __('Pandion Packager enables control.'); ?></h1>
    <ul>
      <li><?php __('Generate custom MSI packages ready for network deployment'); ?></li>
      <li><?php __('Full control over all application settings'); ?></li>
      <li><?php __('Manage software updates for your users'); ?></li>
      <li><?php __('Synchronized with official Pandion IM releases'); ?></li>
      <li><?php __('Automated customization or build from your own source code repository'); ?></li>
      <li><?php __('Unlimited users, free and open source software (GPL3)'); ?></li>
      <li><?php __('Developed by the Pandion IM team'); ?></li>
      <li><?php __('Support the Pandion IM project, karma++'); ?></li>
    </ul>
    <div class="quote"><?php __('We deployed Pandion IM to 200 users in our company and love the Packager service. Great job! - Jim Raynor'); ?></div>
  </article>
</section>
