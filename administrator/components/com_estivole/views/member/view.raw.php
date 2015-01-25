<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once JPATH_COMPONENT . '/models/daytime.php';
require_once JPATH_COMPONENT . '/models/services.php';

class EstivoleViewMember extends JViewLegacy
{
    function display($tpl = null)
	{
		// Get the document object.
		$document = JFactory::getDocument();
		
		// Get the model for the view.
		$modelDaytime = new EstivoleModelDaytime();
		$this->daytimes = $modelDaytime->listItems();
		for($i=0; $i<count($this->daytimes); $i++){
			$this->daytimes[$i]->filledQuota = count($modelDaytime->getQuotasByDaytime($this->daytimes[$i]->daytime_id));
		}

        // Call parent
        parent::display($tpl);
    }
}