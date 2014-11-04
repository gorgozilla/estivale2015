<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

//Display partial views
class EstivoleViewsReviewPhtml extends JViewHTML
{

    function render()
    {
    	$this->_reviewEntryView = EstivoleHelpersView::load('Review','_entry','phtml');
    	return parent::render();
 	}
}