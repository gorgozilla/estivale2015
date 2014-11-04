<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleControllersAdd extends JControllerBase
{
  public function execute()
  {
    $app      = JFactory::getApplication();
    $return   = array("success"=>false);

    $modelName  = $app->input->get('model', 'Book');
    $view       = $app->input->get('view', 'Book');
    $layout     = $app->input->get('layout', '_entry');
    $item       = $app->input->get('item', 'book');

    $modelName  = 'EstivoleModels'.ucwords($modelName);

  	 $model = new $modelName();
   	if ( $row = $model->store() )
  	 {
  		 $return['success'] = true;
  		 $return['msg'] = JText::_('COM_ESTIVOLE_SAVE_SUCCESS');

     $return['html'] = EstivoleHelpersView::getHtml($view, $layout, $item, $row);
  	 }else{
  		 $return['msg'] = JText::_('COM_ESTIVOLE_SAVE_FAILURE');
  	 }
    
  	echo json_encode($return);

  }

}
