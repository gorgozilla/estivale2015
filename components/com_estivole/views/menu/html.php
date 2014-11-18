<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleViewsMenuHtml extends JViewHtml
{
  function renderMenu()
  {
	$user=JFactory::getUser();
	if(!$user->guest){
    //If no User ID is set to current logged in user
    $this->user_id = $user->id;
	}
	
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    //retrieve task list from model
    $memberModel = new EstivoleModelsMember();

    // $this->_modalMessage = EstivoleHelpersView::load('Member','_message','phtml');
    $this->_menuView = EstivoleHelpersView::load('Menu','default','html');
    //display
    return parent::render();
  } 
}