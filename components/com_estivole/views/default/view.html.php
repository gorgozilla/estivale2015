<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once JPATH_COMPONENT . '/models/daytime.php';
require_once JPATH_COMPONENT . '/models/services.php';
require_once JPATH_COMPONENT . '/models/calendars.php';

class EstivoleViewDefault extends JViewLegacy
{
	function display($tpl=null)
	{
		$app = JFactory::getApplication();

		$model = new EstivoleModelMember();

		$this->state	= $this->get('State');
		$this->member		= $this->get('Item');
		$this->form		= $this->get('Form');
		
		$modelCalendars = new EstivoleModelCalendars();
		$modelDaytime = new EstivoleModelDaytime();
		$this->calendars = $modelCalendars->listItems();
		
		for($i=0; $i<count($this->calendars); $i++){
			$this->calendars[$i]->member_daytimes = $modelDaytime->getMemberDaytimes($this->member->member_id, $this->calendars[$i]->calendar_id);
		}

		$this->addToolbar();

		//display
		return parent::display($tpl);
	}
}