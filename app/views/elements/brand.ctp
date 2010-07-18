
<?php $brand = $this->requestAction('brands/index'); ?>

<div id="brand" class="clearfix">
	<?php echo $html->image($brand['icon']); ?>
	<h2><?php echo $brand['name']; ?></h2>
	<span><?php echo $html->link('Get started', array('controller' => 'brands', 'action' => 'add')); ?>
</div>