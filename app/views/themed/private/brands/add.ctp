
<h2><?php __('Get started'); ?></h2>
<p><?php __('Create your brand'); ?></p>

<?php
echo $this->Form->create('Brand', array('type' => 'file'));
echo $this->Form->input('name');
echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $user_id));
echo $this->Form->input('owner', array('type' => 'hidden', 'value' => $user_id));
echo $this->Form->file('image');
echo $this->Form->end('Do it');