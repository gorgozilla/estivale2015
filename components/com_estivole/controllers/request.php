<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleControllersRequest extends JControllerBase
{
  public function execute()
  {

  	$return = array("success"=>false);

  	$model = new EstivoleModelsWaitlist();
  	if ( $model->store() )
  	{
  		$return['success'] = true;
  		$return['msg'] = JText::_('COM_ESTIVOLE_BOOK_REQUEST_SUCCESS');

  	}else{
  		$return['msg'] = JText::_('COM_ESTIVOLE_BOOK_REQUEST_FAILURE');
  	}

  	echo json_encode($return);

  }

}