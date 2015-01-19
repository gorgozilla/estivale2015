<?php
/*
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
	<table id="availibilityTable" class="table table-striped">
		<thead>
			<tr>
				<th class="center" colspan="4">
					<h4><?php echo date('d-m-Y',strtotime($this->daytimes[0]->daytime_day)); ?></h4>
				</th>
			</tr>
			<tr>
				<th class="left">
					<?php echo JText::_('Heure début'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Heure fin'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Quota'); ?>
				</th>
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($this->daytimes as $i => $item) :
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
				<td class="left">
					<?php echo date('H:i', strtotime($item->daytime_hour_start)); ?>
				</td>
				<td class="left">
					<?php echo date('H:i', strtotime($item->daytime_hour_end)); ?>
				</td>
				<td class="left">
					<?php echo $item->filledQuota !='' ? $item->filledQuota : '0'; echo ' / '.JText::_($item->quota); ?>
				</td>
				<td class="center hidden-phone">
					<?php //if ($canEdit) : ?>
						<!--<input type="checkbox" id="cb2" name="cid[]" value="" onclick="Joomla.isChecked(this.checked);"/>-->
						<?php echo JHtml::_('grid.id', $i, $item->daytime_id); ?>
					<?php //endif; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>