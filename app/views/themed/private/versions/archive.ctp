<h2>Version Archive for <?php echo $brand['name']; ?></h2>

<table>
	 <thead>
	 <tr>
		 <th>Time</th>
		 <th>Name</th>
		 <th>Safe name</th>
		 <th>Version number</th>
		 <th>Status</th>
	</tr>
	</thead>

  <tbody id="sortable_table">
  <?php foreach ($versions as $version) : ?>
	<tr>
		<td><?php echo $this->Time->nice($version['Version']['inittime']); ?></td>
		<td><?php echo $version['Version']['name']; ?></td>
		<td><?php echo $version['Version']['name_safe']; ?></td>
		<td><?php echo $version['Version']['version_major'] . "." . $version['Version']['version_minor'] . "." . $version['Version']['version_build']; ?></td>
		<td><?php echo $version['Version']['status']; ?></td>
	</tr>
  <?php endforeach; ?>
	</tbody>
</table>