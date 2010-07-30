<?php // @todo: needs hard refactoring! ?>
<?php // @todo: what if no Brand is active? ?>

<h2>Subscription plan</h2>

<p>Choose your subscription plan.</p>

<table class="subscriptions">
<?php

$fields = array('name', 'period', 'amount', 'button');
foreach ($fields as $field) {
	print "<tr class='$field'>";
	foreach ($subscriptions as $subscription) {
		switch ($field) {
      case 'name':
        if ($subscription['Subscription']['active']) :
          print '<td class="active">' . $subscription['Subscription'][$field] . '</td>';
        else :
       	  print '<td>' . $subscription['Subscription'][$field] . '</td>';
        endif;
        break;
      case 'period':
        	print '<td>' . $subscription['Subscription']['period'] . ' ' . $subscription['Subscription']['term'] . '</td>';
        break;
      case 'amount':
      		print '<td>' . $subscription['Subscription'][$field] . ' $</td>';
        break;
      case 'button':
  			print '<td>' . $paypal->button($subscription['Subscription']['name'],  array(
 				  'test' => TRUE,
				  'type' => $subscription['Subscription']['type'], 
			    'amount' => $subscription['Subscription']['amount'],
			    'term' => $subscription['Subscription']['term'],
			    'period' => $subscription['Subscription']['period'],
			    'item_name' => $subscription['Subscription']['id'],
    			'item_number' => $brand_id)) . '</td>';
		}
	}
	print '</tr>';
}

?>
</table>