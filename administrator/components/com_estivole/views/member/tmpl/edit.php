<?php
/*
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'member.cancel' || document.formvalidator.isValid(document.id('member-form'))) {
			<?php //echo $this->form->getField('summary')->save(); ?>
			Joomla.submitform(task, document.getElementById('member-form'));
		}
	}
</script>
<div id="j-main-container" class="span12">
	<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=member&layout=edit&member_id=' . (int) $this->member->member_id);?>" method="post" name="adminForm" id="member-form" class="form-validate">
		<div class="form-inline form-inline-header">
			<?php echo $this->form->getControlGroup('firstname'); ?>
			<?php echo $this->form->getControlGroup('lastname'); ?>
			<?php echo $this->form->getControlGroup('email'); ?>
			<?php echo $this->form->getControlGroup('phone'); ?>
			<?php echo $this->form->getControlGroup('address'); ?>
			<?php echo $this->form->getControlGroup('npa'); ?>
			<?php echo $this->form->getControlGroup('city'); ?>
			<?php echo $this->form->getControlGroup('tshirtsize'); ?>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
	<h2>Assignation aux calendriers</h2>
	
	<?php
	foreach($this->calendars as $calendar){
		echo '<h3>'.$calendar->name.'</h3>';
	?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Date'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Secteur'); ?>
				</th>
				<th class="left">
					<?php echo JText::_('Tranche horaire'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($calendar->member_daytimes as $i => $item) :
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
					<a href="index.php?option=com_estivole&view=daytime&layout=edit&calendar_id=<?php echo $calendar->calendar_id; ?>&daytime=<?php echo $item->daytime_day; ?>">
						<?php echo JText::_($item->daytime_day); ?>
					</a>
				</td>
				<td class="left">
					<a href="index.php?option=com_estivole&view=daytime&layout=edit&calendar_id=<?php echo $calendar->calendar_id; ?>&daytime=<?php echo $item->name; ?>">
						<?php echo JText::_($item->name); ?>
					</a>
				</td>
				<td class="left">
					<a href="index.php?option=com_estivole&view=daytime&layout=edit&calendar_id=<?php echo $calendar->calendar_id; ?>&daytime=<?php echo $item->daytime_time; ?>">
						<?php echo JText::_($item->daytime_hour_start).' - '.JText::_($item->daytime_hour_end); ?>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php
	}
	?>
	<a href="javascript:void(0);" class="btn btn-large btn-success" role="button" onclick="addAvailibilityModal('<?php echo $this->member->member_id; ?>')"><?php echo JText::_('Assigner à un poste'); ?></a>
</div>
<?php include_once (JPATH_COMPONENT.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'member'.DIRECTORY_SEPARATOR.'tmpl'.DIRECTORY_SEPARATOR.'_addavailibility.php'); ?>