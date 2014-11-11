<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

//Display partial views
class EstivoleViewsServicePhtml extends JViewHTML
{

    function render()
    {
    	$this->_serviceEntryView = EstivoleHelpersView::load('Service','_entry','phtml');
    	return parent::render();
 	}
}