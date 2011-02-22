<h2>Version Archive for '<?php echo $brandName; ?>'</h2>

<table id="versions">
	 <thead>
	 <tr>
		 <th>Created</th>
		 <th>Name</th>
		 <th>Safe name</th>
		 <th>Version number</th>
		 <th>Status</th>
		 <th>Package</th>
	</tr>
	</thead>

  <tbody id="sortable_table">
  <?php foreach ($versions as $version) : ?>
	<tr class="<?php echo $version['Version']['css_status']; ?>">
		<td><?php echo $this->Time->nice($version['Version']['inittime']); ?></td>
		<td><?php echo $version['Version']['name']; ?></td>
		<td><?php echo $version['Version']['name_safe']; ?></td>
		<td><?php echo $version['Version']['version_major'] . "." . $version['Version']['version_minor'] . "." . $version['Version']['version_build']; ?></td>
		<td><?php echo $version['Version']['human_status']; ?></td>
		<td>
			 <?php if (isset($version['Version']['download'])) : ?>
				 <?php echo $html->link('Download', 'download/' . $version['Version']['packager_token'], array('class'=>'button','target'=>'_blank')); ?>
			<?php endif; ?>
		</td>
	</tr>
  <?php endforeach; ?>
	</tbody>
</table>
