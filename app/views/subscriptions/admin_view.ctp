<div class="subscriptions view">
<h2><?php  __('Subscription');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subscription['Subscription']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subscription['Subscription']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subscription['Subscription']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subscription['Subscription']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Term'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subscription['Subscription']['term']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Period'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subscription['Subscription']['period']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subscription', true), array('action' => 'edit', $subscription['Subscription']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Subscription', true), array('action' => 'delete', $subscription['Subscription']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subscription['Subscription']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriptions', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscription', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
