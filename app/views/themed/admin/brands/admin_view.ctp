<div class="brands view">
<h2><?php  __('Brand');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Icon'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['icon']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subscription Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['subscription_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['owner']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Job Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['job_created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $brand['Brand']['active']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Brand', true), array('action' => 'edit', $brand['Brand']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Brand', true), array('action' => 'delete', $brand['Brand']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $brand['Brand']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Brands', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Brand', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks', true), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track', true), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versions', true), array('controller' => 'versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version', true), array('controller' => 'versions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php __('Related Tracks');?></h3>
	<?php if (!empty($brand['Track'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Stable Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_stable_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Beta Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_beta_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Dev Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_dev_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Stable Active');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_stable_active'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Beta Active');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_beta_active'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Dev Active');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_dev_active'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Stable Time');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_stable_time'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Beta Time');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_beta_time'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Track Dev Time');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['track_dev_time'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Brand Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $brand['Track']['brand_id'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Track', true), array('controller' => 'tracks', 'action' => 'edit', $brand['Track']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Versions');?></h3>
	<?php if (!empty($brand['Version'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Brand Id'); ?></th>
		<th><?php __('Inittime'); ?></th>
		<th><?php __('Version Major'); ?></th>
		<th><?php __('Version Minor'); ?></th>
		<th><?php __('Version Build'); ?></th>
		<th><?php __('Source Official Tag'); ?></th>
		<th><?php __('Source Type'); ?></th>
		<th><?php __('Source Git Url'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Name Safe'); ?></th>
		<th><?php __('Company'); ?></th>
		<th><?php __('Homepage Url'); ?></th>
		<th><?php __('Support Url'); ?></th>
		<th><?php __('Info Url'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Packager Token'); ?></th>
		<th><?php __('Hudson Id'); ?></th>
		<th><?php __('Hudson Artifact'); ?></th>
		<th><?php __('Hudson Artifact Size'); ?></th>
		<th><?php __('Uuid'); ?></th>
		<th><?php __('Publishtime'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($brand['Version'] as $version):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $version['id'];?></td>
			<td><?php echo $version['brand_id'];?></td>
			<td><?php echo $version['inittime'];?></td>
			<td><?php echo $version['version_major'];?></td>
			<td><?php echo $version['version_minor'];?></td>
			<td><?php echo $version['version_build'];?></td>
			<td><?php echo $version['source_official_tag'];?></td>
			<td><?php echo $version['source_type'];?></td>
			<td><?php echo $version['source_git_url'];?></td>
			<td><?php echo $version['name'];?></td>
			<td><?php echo $version['name_safe'];?></td>
			<td><?php echo $version['company'];?></td>
			<td><?php echo $version['homepage_url'];?></td>
			<td><?php echo $version['support_url'];?></td>
			<td><?php echo $version['info_url'];?></td>
			<td><?php echo $version['status'];?></td>
			<td><?php echo $version['packager_token'];?></td>
			<td><?php echo $version['hudson_id'];?></td>
			<td><?php echo $version['hudson_artifact'];?></td>
			<td><?php echo $version['hudson_artifact_size'];?></td>
			<td><?php echo $version['uuid'];?></td>
			<td><?php echo $version['publishtime'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'versions', 'action' => 'view', $version['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'versions', 'action' => 'edit', $version['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'versions', 'action' => 'delete', $version['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $version['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Version', true), array('controller' => 'versions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($brand['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Blocked'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($brand['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['blocked'];?></td>
			<td><?php echo $user['group_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
