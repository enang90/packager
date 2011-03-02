
<nav id="secondary-menu">
   <li><?php print $this->Html->link('All settings', '/admin/settings'); ?></li>
   <li><?php print $this->Html->link('Add setting', '/admin/settings/add'); ?></li>
</nav>

<h2><?php __('Edit this setting'); ?></h2>

<?php
echo $this->Form->create('Setting');
echo $this->Form->input('key');
echo $this->Form->input('value');
echo $this->Form->end('Save');
?>