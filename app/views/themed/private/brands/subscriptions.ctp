
<h2>Subscription plan</h2>

<p>Choose your subscription plan.</p>

<table>
	
<?php foreach ($subscriptions as $subscription) : ?>

<tr>
	<?php foreach ($subscription['Subscription'] as $field) : ?>
	<td>
		<?php print $field; ?>
	</td>
	<?php endforeach; ?>
	
	<td>
	<?php print $paypal->button($subscription['Subscription']['name'],  array( 
		  'type' => $subscription['Subscription']['type'], 
	    'amount' => $subscription['Subscription']['amount'],
	    'term' => $subscription['Subscription']['term'],
	    'period' => $subscription['Subscription']['period'])); 
	?>
	</td>
</tr>

<?php endforeach; ?>

</table>