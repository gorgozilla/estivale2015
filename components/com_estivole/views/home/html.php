<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewsHomeHtml extends JViewHtml
{
  function render()
  {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    switch($layout) {

      case "default":

      break;
    }

    //display
    return parent::render();
  } 
}