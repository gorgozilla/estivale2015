<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

//Display partial views
class EstivoleViewsServiceHtml extends JViewHTML
{

    function render()
    {
		$app = JFactory::getApplication();
		$layout = $app->input->get('layout');

		//retrieve task list from model
		$serviceModel = new EstivoleModelsService();

		$this->_modalMessage = EstivoleHelpersView::load('Service','_message','phtml');

		switch($layout) {

		  case "service":
			$this->service = $serviceModel->getItem();

		  break;

		  case "list":
		  default:
			$this->services = $serviceModel->listItems();
			$this->_serviceListView = EstivoleHelpersView::load('Service','_entry','phtml');
		  break;

		}
    	return parent::render();
 	}
}