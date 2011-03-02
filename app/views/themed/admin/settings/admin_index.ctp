<nav id="secondary-menu">
   <li><?php print $this->Html->link('All settings', '/admin/settings'); ?></li>
   <li><?php print $this->Html->link('Add setting', '/admin/settings/add'); ?></li>
</nav>

<h2><?php __('Settings'); ?></h2>

<table class="admin-tabular" id="settings">
  <thead>
    <tr>
      <td><?php __('Key')?></td>
      <td><?php __('Value')?></td>
      <td><?php __('Operations')?></td>
    </tr>
  </thead>
  <tbody>
<?php

$fields = array('key', 'value', 'operations');

foreach ($settings as $setting) {
	print "<tr class='" . $setting['Setting']['id'] . "'>";
 	foreach ($fields as $field) {
		switch ($field) {
      case 'key':
        print '<td class="active">' . $setting['Setting']['key'] . '</td>';
        break;
      case 'value':
        print '<td>' .$setting['Setting']['value'] . '</td>';
        break;
      case 'operations':
        print '<td>' .
   		       $html->link('Edit', array('action' => 'edit', $setting['Setting']['id'])) . ' ' .
		         $html->link('Delete', array('action' => 'delete', $setting['Setting']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setting['Setting']['id'])) .
		    '</td>';
        break;
    }
	}
	print '</tr>';
}

?>
  </tbody>
</table>