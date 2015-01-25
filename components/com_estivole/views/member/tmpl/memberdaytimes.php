<?php
/*
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHTML::_('behavior.modal');

	//If user not logged in, then display login form
	if($this->user->guest){
	$position = 'login';
	$modules =& JModuleHelper::getModules($position); 
	foreach ($modules as $module) { 
		echo JModuleHelper::renderModule($module); 
	}
}else{
	// Else display member edit form ?>
	<h1>Espace benevole > Mon calendrier</h1>
	
	<h2>Calendrier "<?php echo $this->calendars[0]->name; ?>"</h2>
	
	<table class="table">
		<tr>
			<th>Date</th>
			<th>Secteur</th>
			<th>Tranche horaire</th>
			<th class="center">
				<?php echo JText::_('Actions'); ?>
			</th>
		</tr>
		<?php if(count($this->calendars[0]->member_daytimes)<1){ ?>
			<tr>
				<td colspan="4">
					<p>Pas d'attribution à ce calendrier.</p>
				</td>
			</tr>
		<?php }else{ 
			foreach($this->calendars[0]->member_daytimes as $daytime) :
		?>
			<tr>
				<td><?php echo date('d-m-Y',strtotime($daytime->daytime_day)); ?></td>
				<td><?php echo $daytime->name; ?></td>
				<td><?php echo date('H:i', strtotime($daytime->daytime_hour_start)).' - '.date('H:i', strtotime($daytime->daytime_hour_end));  ?></td>
				<td class="center">
					<button type="button" class="btn" onclick="deleteAvailibility('<?php echo $daytime->member_daytime_id; ?>')">
						<i class="icon-trash"></i>
					</button>
				</td>
			</tr>
		<?php endforeach;
		}
		?>
		</tr>
	</table>
	<a href="/estivale2015/index.php?option=com_estivole&view=member&layout=_addavailibility&tmpl=component&calendar_id=<?php echo $this->calendars[0]->calendar_id; ?>" class="modal btn btn-default" rel="{size: {x: 800, y: 650}, handler:'iframe'}">
        Ajouter une disponibiité
	</a>
<?php	} ?>