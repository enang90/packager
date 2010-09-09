
<?php
  $brand = $this->Session->read('Brand');
  $brands = $user->data['Brand'];
?>

<div id="brands-widget">
	<?php if ($brand) : ?>
		<div class="brand clearfix">
		  <?php echo $html->image('icons/' . $brand['icon']); ?>
  	  <h2><?php echo $brand['name']; ?></h2>
    	<span><?php echo $html->link('Edit this brand', array('controller' => 'brands', 'action' => 'edit', $brand['id'])); ?></span>
  	  <span><?php echo $html->link('Add a new brand', array('controller' => 'brands', 'action' => 'add')); ?></span>
      <?php if (count($brands) > 1): ?>
      	<img src="/img/brand_selection_button.png" id="brands-select" class="modalInput" rel="#brands-selector" />
      <?php endif; ?>
	  </div>	
	<?php else : ?>
		<div class="brand clearfix">
	 	  <?php echo $html->image('placeholder.gif'); ?>
	    <h2>Goliath Messenger</h2>
	 	  <span><?php echo $html->link('Get started', array('controller' => 'brands', 'action' => 'add')); ?></span>
	  </div>
	<?php endif; ?>
</div>

<div id="brands-selector" class="modal">
	<?php foreach ($brands as $brand) : ?>
			<div class="brand clearfix">
  		  <?php echo $html->image('icons/' . $brand['icon']); ?>
    	  <h2><?php echo $brand['name']; ?></h2>
      	<span><?php echo $html->link('Edit this brand', array('controller' => 'brands', 'action' => 'edit', $brand['id'])); ?></span>
      	<span><?php echo $html->link('Switch to this brand', array('controller' => 'brands', 'action' => 'switchBrand', $brand['id'])); ?></span>
		  </div>
	<?php endforeach; ?>
  <span><?php echo $html->link('Add a new brand', array('controller' => 'brands', 'action' => 'add')); ?></span>
</div>


