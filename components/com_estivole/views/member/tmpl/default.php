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
	<form action="<?php echo JRoute::_('index.php?option=com_estivole&view=member&layout=edit&member_id=' . (int) $this->member->member_id);?>" method="post" name="adminForm" id="member-form" class="form-horizontal form-validate">
		<div class="col-md-6">
			<div class="form-group">
				<label for="inputLastname" class="col-md-3 control-label">Nom</label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="lastname" placeholder="Nom" value="<?php echo $this->member->lastname; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputFirstname" class="col-md-3 control-label">Prénom</label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="lastname" placeholder="Prénom" value="<?php echo $this->member->firstname; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail" class="col-md-3 control-label">Email</label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="lastname" placeholder="Email" value="<?php echo $this->member->email; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputBirthdate" class="col-md-3 control-label">Date de naissance</label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="birthdate" placeholder="Date de naissance" value="<?php echo $this->member->birthdate; ?>">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="inputAddress" class="col-md-3 control-label">Adresse</label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="address" placeholder="Adresse" value="<?php echo $this->member->address; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputNpa" class="col-md-3 control-label">NPA</label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="npa" placeholder="NPA" value="<?php echo $this->member->npa; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputCity" class="col-md-3 control-label">Ville</label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="city" placeholder="Ville" value="<?php echo $this->member->city; ?>">
				</div>
			</div>
		</div>
	</form>	
<?php	} ?>