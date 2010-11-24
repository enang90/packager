<response>
  <?php if (!$status) : ?>
  <status>
	  <?php print $status; ?>
	</status>
	<message>
  	<?php print $message; ?>
  </message>
  <?php else : ?>
	<status>
		<?php print $status; ?>
	</status>
	<message>
		<?php print $message; ?>
	</message>
	<object>
	<?php print $xml->serialize($version); ?>
	</object>
  <?php endif; ?>
</response>