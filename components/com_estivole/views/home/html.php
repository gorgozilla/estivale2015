<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewsHomeHtml extends EstivoleViewsMenuHtml
{
  function render()
  {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');
	
    switch($layout) {

      case "default":

      break;
    }
	//parent::renderMenu();
    $this->_menuView = EstivoleHelpersView::load('Menu','default','html');
    //display
    return parent::render();
  } 
}