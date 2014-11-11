<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleModelsService extends EstivoleModelsDefault
{
  function __construct()
  {

    $app = JFactory::getApplication();

    parent::__construct();       
  }

  function getItem()
  {

    $profile = JFactory::getUser($this->_user_id);
    $userDetails = JUserHelper::getProfile($this->_user_id);
    $profile->details =  isset($userDetails->profile) ? $userDetails->profile : array();

    $libraryModel = new EstivoleModelsLibrary();
    $libraryModel->set('_user_id',$this->_user_id);
    $profile->library = $libraryModel->getItem();

    $waitlistModel = new EstivoleModelsWaitlist();
    $waitlistModel->set('_waitlist', TRUE);
    $profile->waitlist = $waitlistModel->getItem();

    $wishlistModel = new EstivoleModelsWishlist();
    $profile->wishlist = $wishlistModel->listItems();

    $profile->isMine = JFactory::getUser()->id == $profile->id ? TRUE : FALSE;

    return $profile;
  }
  
  function listItems()
  {
    $services = parent::listItems();

    $n = count($services);

    return $services;
  }
 
  protected function _buildQuery()
  {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select("*");
    $query->from("#__estivole_services as s");

    return $query;
  }

  protected function _buildWhere($query)
  {
    return $query;
  }

}