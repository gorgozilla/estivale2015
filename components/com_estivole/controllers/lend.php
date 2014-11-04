<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleControllersLend extends JControllerBase
{
  public function execute()
  {

  	$return = array("success"=>false);

  	$model = new EstivoleModelsBook();
  	if ( $row = $model->lend() )
  	{
  		$return['success'] = true;
  		$return['msg'] = JText::_('COM_ESTIVOLE_BOOK_LEND_SUCCESS');

  	}else{
  		$return['msg'] = JText::_('COM_ESTIVOLE_BOOK_LEND_FAILURE');
  	}

  	echo json_encode($return);

  }

}