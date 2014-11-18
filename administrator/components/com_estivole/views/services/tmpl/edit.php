<?php
/*
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.modal', 'a.modal');

// $listOrder  = $this->escape($this->state->get('list.ordering'));
// $listDirn   = $this->escape($this->state->get('list.direction'));
// $loggeduser = JFactory::getUser();
// $sortFields = $this->getSortFields();
?>
<script type="text/javascript">
	// Joomla.orderTable = function()
	// {
		// table = document.getElementById("sortTable");
		// direction = document.getElementById("directionTable");
		// order = table.options[table.selectedIndex].value;
		// if (order != '<?php echo $listOrder; ?>')
		// {
			// dirn = 'asc';
		// }
		// else
		// {
			// dirn = direction.options[direction.selectedIndex].value;
		// }
		// Joomla.tableOrdering(order, dirn, '');
	// }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=members');?>" method="post" name="adminForm" id="adminForm">
	<div id="j-main-container">
		<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
			<label for="name">Nom :</label>
			<input type="text" name="name" value="<?php echo $this->service->name; ?>" />
			
			<label for="name">Description :</label>
			<input type="text" name="summary" value="<?php echo $this->service->summary; ?>" />

		</form>
	</div>
</form>