
<h2><?php __('Get started'); ?></h2>
<p><?php __('Create your brand'); ?></p>

<?php

echo $form->create('Brand', array('type' => 'file'));
echo $form->input('name');
echo $form->file('image');
echo $form->end('Do it');