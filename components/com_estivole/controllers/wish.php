<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleControllersWish extends JControllerBase
{
  public function execute()
  {

  	$return = array("success"=>false);

  	$model = new EstivoleModelsWishlist();
  	if ( $model->store() )
  	{
  		$return['success'] = true;
  		$return['msg'] = JText::_('COM_ESTIVOLE_WISHLIST_SUCCESS');

  	}else{
  		$return['msg'] = JText::_('COM_ESTIVOLE_WISHLIST_FAILURE');
  	}

  	echo json_encode($return);

  }

}