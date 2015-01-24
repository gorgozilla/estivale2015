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


<?php 
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
	<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=member&member_id=' . (int) $this->member->member_id);?>" method="post" name="adminForm" id="member-form" class="form-horizontal form-validate">
		
	</form>	
<?php	} ?>