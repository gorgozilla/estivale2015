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
		if (task == 'calendar.cancel' || document.formvalidator.isValid(document.id('calendar-form'))) {
			<?php //echo $this->form->getField('summary')->save(); ?>
			Joomla.submitform(task, document.getElementById('calendar-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=calendar&layout=edit&calendar_id=' . (int) $this->calendar->calendar_id);?>" method="post" name="adminForm" id="calendar-form" class="form-validate">
	<div class="form-horizontal">

		<div class="row-fluid">
			<div class="span9">
				<div class="form-vertical">
					<?php echo $this->form->getControlGroup('name'); ?>
					<?php echo $this->form->getControlGroup('description'); ?>
					<input type="hidden" name="task" value="" />
					<?php echo JHtml::_('form.token'); ?>
				</div>
			</div>
		</div>	
</form>