<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

//Display partial views
class EstivoleViewsLibraryPhtml extends JViewHTML
{

    function render()
    {
    	$this->_bookListView = EstivoleHelpersView::load('Book','_entry','phtml');
    	$this->_borrowBookView = EstivoleHelpersView::load('Book','_borrow','phtml');
    	$this->_lendBookView = EstivoleHelpersView::load('Book', '_lend', 'phtml');
    	$this->_returnBookView = EstivoleHelpersView::load('Book', '_return', 'phtml');

    	return parent::render();
 	}
}