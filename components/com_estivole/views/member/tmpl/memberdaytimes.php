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
	<script type="text/javascript" language="javascript">
		jQuery(document).ready(function() {
			<?php if(count($this->calendars[0]->member_daytimes)>0){ ?>
			jQuery('#memberDaytimesTable').DataTable({
				"paging":   false,
				"info":     false,
				"searching":	false
			});
			<?php } ?>
			
		});
	</script>
	<h1>Espace benevole > Mon calendrier</h1>
	
	<p>C'est ici que vous réservez votre place pour devenir bénévole. Pour se faire, c'est très simple : </p>
	
	<ul>
	<li>Cliquez sur le bouton "Ajouter une disponibilité" ci-dessous.</li>
	<li>Sélectionnez le secteur et la date pour laquelle vous souhaitez participer.</li>
	<li>La liste des tranches horaires s'affiche, sélectionnez celle de votre choix en fonction de votre disponibilité et de la tâche vous arrangeant.</li>
	
	<p>Vous pouvez bien sûr ajouter autan de disponibilité que vous le souhaitez. Pour chaque disponibilité, une confirmation vous sera envoyée par email.</p>
	
	<h2>Calendrier "<?php echo $this->calendars[0]->name; ?>"</h2>
	
	<table class="table" id="memberDaytimesTable">
		<thead>
		<tr>
			<th>Date</th>
			<th>Secteur</th>
			<th>Tâche</th>
			<th>Horaire</th>
			<th class="center">
				<?php echo JText::_('Actions'); ?>
			</th>
		</tr>
		</thead>
		<?php if(count($this->calendars[0]->member_daytimes)<1){ ?>
			<tr>
				<td colspan="5">
					<p>Pas d'attribution à ce calendrier.</p>
				</td>
			</tr>
		<?php }else{ 
			foreach($this->calendars[0]->member_daytimes as $daytime) :
		?>
			<tr>
				<td>
					<?php if($daytime->status_id==0){ ?>
						<a title="Date en attente de confirmation"><span class="badge-warning"><i class="icon-time"></i></span></a>
					<?php }else{ ?>
						<a title="Date confirmée"><span class="badge-success">&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
					<?php } ?>
					
					<?php echo date('d-m-Y',strtotime($daytime->daytime_day)); ?>
				</td>
				<td><?php echo $daytime->name; ?></td>
				<td><?php echo $daytime->description; ?></td>
				<td><?php echo date('H:i', strtotime($daytime->daytime_hour_start)).' - '.date('H:i', strtotime($daytime->daytime_hour_end));  ?></td>
				<td class="center">
					<?php if($daytime->status_id==0){ ?>
						<a title="Supprimer la disponibilité. Une fois validée, votre inscription ne pourra plus être supprimée." href="index.php?option=com_estivole&controller=member&task=member.deleteAvailibility&member_daytime_id=<?php echo $daytime->member_daytime_id; ?>" class="btn">
							<i class="icon-trash"></i>
						</a>
					<?php } ?>
				</td>
			</tr>
		<?php endforeach;
		}
		?>
		</tr>
	</table>
	<br />
	<a href="/estivale2015/index.php?option=com_estivole&view=member&layout=_addavailibility&tmpl=component&calendar_id=<?php echo $this->calendars[0]->calendar_id; ?>" class="modal btn btn-default" rel="{size: {x: 800, y: 650}, onClose:function(){var js = window.location.reload();}, handler:'iframe'}">
        Ajouter une disponibilité
	</a>
<?php	} ?>