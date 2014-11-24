<?php
/*
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.modal', 'a.modal');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'daytime.cancel' || document.formvalidator.isValid(document.id('daytime-form'))) {
			<?php //echo $this->form->getField('summary')->save(); ?>
			Joomla.submitform(task, document.getElementById('daytime-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=daytime&layout=edit&daytime_id=' . (int) $this->daytime->daytime_id);?>" method="post" name="adminForm" id="daytime-form" class="form-validate">
	<div class="form-horizontal">
		<div class="row-fluid">
			<div class="span9">
				<div class="form-vertical">
					<div class="control-group ">
						<div class="control-label">
							<label id="jform_daytime_day-lbl" for="jform_daytime_day" class="required">
						</div>
						<div class="controls">
							<?php echo JHTML::calendar($this->daytime->daytime_day,'jform[daytime_day]', 'jform_daytime_day', '%Y-%m-%d',array('size'=>'8','maxlength'=>'10','class'=>'required')); ?>
						</div>
					</div>
					<input type="hidden" name="calendar_id" value="<?php echo $this->daytime->calendar_id; ?>" />
					<input type="hidden" name="task" value="" />
					<?php echo JHtml::_('form.token'); ?>
				</div>
			</div>
		</div>
		<a href="javascript:void(0);" class="btn btn-large btn-success" role="button" onclick="addTimeModal('<?php echo $this->daytime->daytime_id; ?>');"><?php echo JText::_('COM_LENDR_LEND_BOOK'); ?></a>
</form>
	<br />
	<br />
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Jour'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Heure début'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Heure fin'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Quota'); ?>
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
				<td class="center hidden-phone">
					<?php //if ($canEdit) : ?>
						<?php echo JHtml::_('grid.id', $i, $item->daytime_id); ?>
					<?php //endif; ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->daytime_day); ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->daytime_hour_start); ?>
				</td>
				<td class="left">
					<?php echo JText::_($item->daytime_hour_end); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php include_once (JPATH_COMPONENT.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'daytime'.DIRECTORY_SEPARATOR.'tmpl'.DIRECTORY_SEPARATOR.'_adddaytime.php'); ?>