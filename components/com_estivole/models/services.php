<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleModelServices extends JModelLegacy
{

  /**
  * Protected fields
  **/
  var $_service_id     = null;
  
  function __construct()
  {
    $app = JFactory::getApplication();
    $this->_service_id = $app->input->get('service_id', null);
	
    
    parent::__construct();       
  }
 
  /**
  * Builds the query to be used by the member model
  * @return   object  Query object
  *
  *
  */
  protected function _buildQuery()
  {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('*');
    $query->from('#__estivole_services as b');

    // $query->select('w.waitlist_id, w.user_id as borrower_id');
    // $query->leftjoin('#__estivole_waitlists as w on w.member_id = b.member_id AND w.fulfilled = 0');

    // $query->select('l.name as borrower');
    // $query->leftjoin('#__users as l on l.id = b.lent_uid');

    // $query->select('u.name as waitlist_user');
    // $query->leftjoin('#__users AS u on u.id = w.user_id');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  *
  */
  protected function _buildWhere(&$query)
  {

    if(is_numeric($this->_service_id)) 
    {
      $query->where('b.service_id = ' . (int) $this->_service_id);
    }

    // if(is_numeric($this->_user_id)) 
    // {
      // $query->where('b.user_id = ' . (int) $this->_user_id);
    // }

    // if(is_numeric($this->_library_id)) 
    // {
      // $query->where('b.library_id = ' . (int) $this->_library_id);
    // }

    // if($this->_waitlist)
    // {
      // $query->where('w.waitlist_id <> ""');
    // }

    // $query->where('b.published = ' . (int) $this->_published);
    return $query;
  }
  
  public function getItem()
  {
    $db = JFactory::getDBO();

    $query = $this->_buildQuery();
    $this->_buildWhere($query);
    $db->setQuery($query);

    $item = $db->loadObject();

    return $item;
  }
  
  /**
  * Build query and where for protected _getList function and return a list
  *
  * @return array An array of results.
  */
  public function listItems()
  {
    $query = $this->_buildQuery();    
    $query = $this->_buildWhere($query);
    $list = $this->_getList($query, $this->limitstart, $this->limit);

    return $list;
  }
  
  /**
  * Gets an array of objects from the results of database query.
  *
  * @param   string   $query       The query.
  * @param   integer  $limitstart  Offset.
  * @param   integer  $limit       The number of records.
  *
  * @return  array  An array of results.
  *
  * @since   11.1
  */
  protected function _getList($query, $limitstart = 0, $limit = 0)
  {
    $db = JFactory::getDBO();
    $db->setQuery($query, $limitstart, $limit);
    $result = $db->loadObjectList();
 
    return $result;
  }

  /**
  * Delete a member
  * @param int      ID of the member to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $id   = $id ? $id : $app->input->get('member_id');

    $member = JTable::getInstance('Member','Table');
    $member->load($id);

    $member->published = 0;

    if($member->store()) 
    {
      return true;
    } else {
      return false;
    }
  }
}