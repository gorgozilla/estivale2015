<a href="<?php echo JRoute::_('index.php?option=com_estivole&view=member&layout=list'); ?>" class="btn pull-right"><i class="icon icon-chevron-left"></i> <?php echo JText::_('COM_ESTIVOLE_BACK'); ?></a>
<h2 class="page-header">Edition profil > <?php echo $this->member->firstname; ?> <?php echo $this->member->lastname; ?></h2>
<div class="row-fluid">
	<form id="memberForm">
		<label for="lastname">Nom :</label>
		<input type="text" name="lastname" value="<?php echo $this->member->lastname; ?>" />
		
		<label for="firstname">Prénom :</label>
		<input type="text" name="firstname" value="<?php echo $this->member->firstname; ?>" />
		
		<label for="lastname">Email :</label>
		<input type="text" name="email" value="<?php echo $this->member->email; ?>" />
		
		<label for="lastname">Date de naissance :</label>
		<input type="text" name="birthdate" value="<?php echo $this->member->birthdate; ?>" />
		
		<label for="lastname">Téléphone :</label>
		<input type="text" name="phone" value="<?php echo $this->member->phone; ?>" />
		
		<label for="lastname">Adresse :</label>
		<input type="text" name="address" value="<?php echo $this->member->address; ?>" />
		
		<label for="lastname">NPA :</label>
		<input type="text" name="npa" value="<?php echo $this->member->npa; ?>" />
		
		<label for="lastname">Ville :</label>
		<input type="text" name="city" value="<?php echo $this->member->city; ?>" />
		
		<input type="hidden" name="member_id" value="<?php echo $this->member->member_id; ?>" />
		<input type="hidden" name="model" value="member" />
		<input type="hidden" name="table" value="member" />
	</form>
		<button class="btn btn-primary" onclick="addMember()"><?php echo JText::_('COM_ESTIVOLE_ADD'); ?></button>
</div>
<?php echo $this->_modalMessage->render(); ?>