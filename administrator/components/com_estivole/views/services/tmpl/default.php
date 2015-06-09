<?php
/*
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$this->sortColumn	= $this->escape($this->state->get('list.ordering'));
$this->sortDirection	= $this->escape($this->state->get('list.direction'));
?>
<script language="javascript" type="text/javascript">
function tableOrdering( order, dir, task )
{
	var form = document.adminForm;
 
	form.filter_order.value = order;
	form.filter_order_Dir.value = dir;
	document.adminForm.submit( task );
}
</script>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=services');?>" method="post" name="adminForm" id="adminForm">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="1%" class="hidden-phone">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th class="left">
						<?php echo JHTML::_( 'grid.sort', 'Nom', 'b.name', $this->sortDirection, $this->sortColumn); ?>
					</th>
					<th class="left">
						<?php echo 'Description'; ?>
					</th>
					<th class="center">
						<?php echo JText::_('Actions'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($this->services as $i => $item) : ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->service_id); ?>
					</td>
					<td class="left">
						<a href="<?php echo JRoute::_('index.php?option=com_estivole&task=service.edit&service_id='.(int) $item->service_id); ?>">
						<?php echo JText::_($item->name); ?>
						</a>
					</td>
					<td class="left">
						<?php echo JText::_($item->summary); ?>
					</td>
					<td class="center">
					
						<?php echo JHtml::_('job.publishList', $item->published, $i); ?>
						<!--<a class="btn" href="index.php?option=com_estivole&task=services.deleteListService&service_id=<?php echo $item->service_id; ?>">
							<i class="icon-publish"></i>
						</a>-->
						<a class="btn" onClick="javascript:return confirm('Supprimera également toutes les inscriptions associées au secteur. Êtes-vous sûr?')" href="index.php?option=com_estivole&task=services.deleteListService&service_id=<?php echo $item->service_id; ?>">
							<i class="icon-trash"></i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>

			</tbody>
		</table>
		
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="model" value="service" />
		<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>