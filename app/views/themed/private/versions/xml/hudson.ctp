<?php if (isset($error)) :?>
<error>
	<?php print $error; ?>
</error>
<?php endif; ?>

<?php if (isset($version)) : ?>
	<?php $xml->serialize($version); ?>
<?php endif; ?>