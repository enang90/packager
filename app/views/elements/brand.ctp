
<?php 
  $variables = $this->requestAction('brands/information'); 
  extract($variables);
?>


<div id="brands-widget">
	<?php if (!empty($brands)) : ?>
		<?php foreach ($brands as $brand) : ?>
			<?php $classes = ($brand['active']) ? "brand clearfix active" : "brand clearfix"; ?>
			<div class="<?php print $classes; ?>">
  		  <?php echo $html->image('icons/' . $brand['icon']); ?>
	  	  <h2><?php echo $brand['name']; ?></h2>
	    	<span><?php echo $html->link('Edit this brand', array('controller' => 'brands', 'action' => 'edit', $brand['id'])); ?>
		  </div>
		<?php endforeach; ?>
	<?php else : ?>
		<div class="brand clearfix active">
	 	  <?php echo $html->image('placeholder.gif'); ?>
	    <h2>Goliath Messenger</h2>
	 	  <span><?php echo $html->link('Get started', array('controller' => 'brands', 'action' => 'add')); ?>
	  </div>
	<?php endif; ?>
</div>


