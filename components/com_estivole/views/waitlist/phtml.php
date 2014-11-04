<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

//Display partial views
class EstivoleViewsWaitlistPhtml extends JViewHTML
{

    function render()
    {
    	$this->_bookListView = EstivoleHelpersView::load('Book','_entry','phtml');
    	return parent::render();
 	}
}