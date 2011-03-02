<div class="brands index">
	<h2><?php __('Brands');?></h2>
	
	
  <div class="actions">
  	<h3><?php __('Actions'); ?></h3>
  	<ul>
  		<li><?php echo $this->Html->link(__('New Brand', true), array('action' => 'add')); ?></li>
  		<li><?php echo $this->Html->link(__('List Brands', true), array('action' => 'index')); ?> </li>
  	</ul>
  </div>
	
	<table class="admin-tabular" cellpadding="0" cellspacing="0">
	<thead>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('icon');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('subscription_id');?></th>
			<th><?php echo $this->Paginator->sort('owner');?></th>
			<th><?php echo $this->Paginator->sort('job_created');?></th>
			<th><?php echo $this->Paginator->sort('active');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</thead>
	<?php
	$i = 0;
	foreach ($brands as $brand):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $brand['Brand']['id']; ?>&nbsp;</td>
		<td><?php echo $brand['Brand']['name']; ?>&nbsp;</td>
		<td><?php echo $brand['Brand']['icon']; ?>&nbsp;</td>
		<td><?php echo $brand['Brand']['created']; ?>&nbsp;</td>
		<td><?php echo $brand['Brand']['subscription_id']; ?>&nbsp;</td>
		<td><?php echo $brand['Brand']['owner']; ?>&nbsp;</td>
		<td><?php echo $brand['Brand']['job_created']; ?>&nbsp;</td>
		<td><?php echo $brand['Brand']['active']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $brand['Brand']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $brand['Brand']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $brand['Brand']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $brand['Brand']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>