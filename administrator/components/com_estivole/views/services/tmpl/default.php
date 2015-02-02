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

<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=members');?>" method="post" name="adminForm" id="adminForm">
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
						<?php echo JText::_('Description'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($this->services as $i => $item) : ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center hidden-phone">
						<?php //if ($canEdit) : ?>
							<?php echo JHtml::_('grid.id', $i, $item->service_id); ?>
						<?php //endif; ?>
					</td>
					<td class="left">
						<a href="<?php echo JRoute::_('index.php?option=com_estivole&task=service.edit&service_id='.(int) $item->service_id); ?>">
						<?php echo JText::_($item->name); ?>
						</a>
					</td>
					<td class="left">
						<?php echo JText::_($item->summary); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>