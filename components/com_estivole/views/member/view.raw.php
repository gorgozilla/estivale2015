<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once JPATH_COMPONENT . '/models/daytime.php';

class EstivoleViewMember extends JViewLegacy
{
    function display($tpl = null)
    {
		// Get the document object.
		$document = JFactory::getDocument();
		$app = JFactory::getApplication();
		$this->_daytime_day = $app->input->get('daytime', null);
		
		// Get the model for the view.
		$modelDaytime = new EstivoleModelDaytime();
		$this->daytimes = $modelDaytime->listItems();
		for($i=0; $i<count($this->daytimes); $i++){
			$this->daytimes[$i]->filledQuota = count($modelDaytime->getQuotasByDaytime($this->daytimes[$i]->daytime_id));
			//$this->daytimes[$i]->isAvailable = $modelDaytime->isdaytimeavailableformember($this->daytimes[$i]->member_id, $this->daytimes[$i]->daytime_id);
		}

        // Call parent
        parent::display($tpl);
    }
}