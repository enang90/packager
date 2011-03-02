
<h2><?php __('Add a setting'); ?></h2>

<?php
echo $this->Form->create('Setting');
echo $this->Form->input('key');
echo $this->Form->input('value');
echo $this->Form->end('Save');
?>