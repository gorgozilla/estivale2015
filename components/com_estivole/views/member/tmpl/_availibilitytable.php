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
	<link rel="stylesheet" href="/estivale2015/media/jui/css/bootstrap.min.css" type="text/css" />
	<table id="availibilityTable" class="table">
		<thead>
			<tr>
				<th class="center" colspan="4">
					<h4><?php echo date('d-m-Y', strtotime($this->_daytime_day)); ?></h4>
				</th>
			</tr>
			<tr>
				<th>
					<?php echo JText::_('Heure début'); ?>
				</th>
				<th>
					<?php echo JText::_('Heure fin'); ?>
				</th>
				<th>
					<?php echo JText::_('Quota'); ?>
				</th>
				<th>
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($this->daytimes as $item) : ?>
			<tr>
				<td>
					<?php echo date('H:i', strtotime($item->daytime_hour_start)); ?>
				</td>
				<td>
					<?php echo date('H:i', strtotime($item->daytime_hour_end)); ?>
				</td>
				<td>
					<?php //echo $item->filledQuota !='' ? $item->filledQuota : '0'; echo ' / '.JText::_($item->quota); ?>
				</td>
				<td>
					<?php //if ($canEdit) : ?>
						<!--<input type="checkbox" id="cb2" name="cid[]" value="" onclick="Joomla.isChecked(this.checked);"/>-->
						<?php echo JHtml::_('grid.id', $i, $item->daytime_id); ?>
					<?php //endif; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>