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
		<?php
		// Search tools bar
		//echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Nom'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Prénom'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Email'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Tél.'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Adresse'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('NPA / Ville'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Prénom'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($this->members as $i => $item) :
			// $canEdit   = $this->canDo->get('core.edit');
			// $canChange = $loggeduser->authorise('core.edit.state',	'com_users');

			// // If this group is super admin and this user is not super admin, $canEdit is false
			// if ((!$loggeduser->authorise('core.admin')) && JAccess::check($item->id, 'core.admin'))
			// {
				// $canEdit   = false;
				// $canChange = false;
			// }
		?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center hidden-phone">
					<?php //if ($canEdit) : ?>
						<?php echo JHtml::_('grid.id', $i, $item->member_id); ?>
					<?php //endif; ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->lastname); ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->firstname); ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->email); ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->phone); ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->address); ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->npa." / ".$item->city); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<?php //Load the batch processing form. ?>
	<?php //echo $this->loadTemplate('batch'); ?>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHtml::_('form.token'); ?>
	</div>
</form>