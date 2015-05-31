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
	<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=daytimes');?>" method="post" name="adminForm" id="adminForm">
			<div id="j-main-container">
			<?php
			// Search tools bar
			//echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
			?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="left">
						<?php echo JHTML::_( 'grid.sort', 'Nom', 'm.lastname', $this->sortDirection, $this->sortColumn); ?>
					</th>
					<th class="left">
						<?php echo JHTML::_( 'grid.sort', 'Prénom', 'm.firstname', $this->sortDirection, $this->sortColumn); ?>
					</th>
					<th class="left">
						<?php echo JHTML::_( 'grid.sort', 'Email', 'm.email', $this->sortDirection, $this->sortColumn); ?>
					</th>
					<th class="left">
						<?php echo JHTML::_( 'grid.sort', 'Secteur', 's.name', $this->sortDirection, $this->sortColumn); ?>
					</th>
					<th class="left">
						<?php echo JText::_('Date'); ?>
					</th>
					<th class="left">
						<?php echo JText::_('Horaire'); ?>
					</th>
					<th class="left">
						<?php echo JHTML::_( 'grid.sort', 'Status', 'md.status_id', $this->sortDirection, $this->sortColumn); ?>
					</th>
					<th class="center">
						<?php echo JText::_('Actions'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($this->member_daytimes as $i => $item) : ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="left">
						<a href="<?php echo JRoute::_('index.php?option=com_estivole&task=member.edit&member_id='.(int) $item->member_id); ?>">
							<?php echo JText::_($item->lastname); ?>
						</a>
					</td>
					<td class="left">
						<a href="<?php echo JRoute::_('index.php?option=com_estivole&task=member.edit&member_id='.(int) $item->member_id); ?>">
						<?php echo JText::_($item->firstname); ?>
						</a>
					</td>
					<td class="left">
						<a href="<?php echo JRoute::_('index.php?option=com_estivole&task=member.edit&member_id='.(int) $item->member_id); ?>">
						<?php echo JText::_($item->email); ?>
						</a>
					</td>
					<td class="left">
						<?php echo JText::_($item->name); ?>
					</td>
					<td class="left">
						<?php echo date('d-m-Y',strtotime($item->daytime_day)); ?>
					</td>
					<td class="left">
						<?php echo date('H:i', strtotime($item->daytime_hour_start)).' - '.date('H:i', strtotime($item->daytime_hour_end)); ?>
					</td>
					<td class="left">
						<?php if($item->status_id==0){ ?>
							<a href="index.php?option=com_estivole&controller=daytime&task=daytime.changeStatusDaytime&member_daytime_id=<?php echo $item->member_daytime_id; ?>&status_id=1" title="Confirmer la disponibilité">
								<span class="badge-warning"><i class="icon-time"></i></span>
							</a>
						<?php }else{ ?>
							<a href="index.php?option=com_estivole&controller=daytime&task=daytime.changeStatusDaytime&member_daytime_id=<?php echo $item->member_daytime_id; ?>&status_id=0" title="Remttre le status en attente de validation">
								<span class="badge-success"><i class="icon-ok"></i></span>
							</a>
						<?php } ?>
					</td>
					<td class="center">
						<a class="btn" href="index.php?option=com_estivole&controller=member&task=member.deleteAvailibility&member_daytime_id=<?php echo $item->member_daytime_id; ?>">
							<i class="icon-trash"></i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>