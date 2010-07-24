
<h2><?php __('Get started'); ?></h2>
<p><?php __('Edit your brand'); ?></p>

<?php

echo $this->Form->create('Brand', array('type' => 'file'));
echo $this->Form->input('id', array('type'=>'hidden'));
echo $this->Form->input('name');
echo $this->Form->file('image');
echo $this->Form->end('Edit');