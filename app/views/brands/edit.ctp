
<h2><?php __('Get started'); ?></h2>
<p><?php __('Edit your brand'); ?></p>

<?php

echo $form->create('Brand', array('type' => 'file'));
echo $form->input('id', array('type'=>'hidden'));
echo $form->input('name');
echo $form->file('image');
echo $form->end('Edit');