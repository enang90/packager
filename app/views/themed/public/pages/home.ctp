<section class="intro">
  <div class="placeholder"><?php __('Slideshow'); ?></div>
  <article>
    <h1><?php __('Brand, Configure, Deploy'); ?></h1>
    <p><?php __('Pandion Packager is a service for network administrators to automate Pandion IM deployment. Create a branded instant messaging client, configure settings, deploy to unlimited users, and manage software updates. All from an easy to use web interface.'); ?></p>
    <p><?php echo $html->link(__('Pricing and Sign Up', TRUE), '/users/register', array('class' => 'button')); ?></p>
  </article>
</section>

<section class="main">

  <menu class="tabs">
    <nav>
      <li><?php echo $html->link(__('Features', TRUE), '/', array('class' => 'active')); ?></li>
      <li><?php echo $html->link(__('Pricing and Sign Up', TRUE), '/users/register', array()); ?></li>
    </nav>
  </menu>

  <article>
    <h1><?php __('Pandion Packager makes life easier'); ?></h1>
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
