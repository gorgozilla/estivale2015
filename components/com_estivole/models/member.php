<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleModelsMember extends EstivoleModelsDefault
{

  /**
  * Protected fields
  **/
  var $_member_id     = null;
  
  var $_lastname     = null;
  
  var $_firstname  = null;

  var $_email  = null;

  var $_birthdate       = null;

  var $_phone   = 1;

  var $_address    = FALSE;

  var $_city    = FALSE;
  
  var $_npa = null;
  
  var $_tshirtsize = null;
  
  var $_availibility = null;
  
  var $_friendgroup = null;
  
  var $_favchoices = null;
  
  var $_created = null;
  
  var $_modified = null;


  function __construct()
  {
    $app = JFactory::getApplication();
    $this->_member_id = $app->input->get('id_member', null);
    
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
    $query->from('#__estivole_members as b');

    // $query->select('w.waitlist_id, w.user_id as borrower_id');
    // $query->leftjoin('#__estivole_waitlists as w on w.member_id = b.member_id AND w.fulfilled = 0');

    // $query->select('l.name as borrower');
    // $query->leftjoin('#__users as l on l.id = b.lent_uid');

    // $query->select('u.name as waitlist_user');
    // $query->leftjoin('#__users AS u on u.id = w.user_id');

    return $query;
  }

  public function getItem()
  {
    $member = parent::getItem();

    // $reviewModel = new EstivoleModelsReview();
    // $reviewModel->set('_member_id',$member->member_id);
    // $member->reviews = $reviewModel->listItems();

    return $member;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  *
  */
  protected function _buildWhere(&$query)
  {

    if(is_numeric($this->_member_id)) 
    {
      $query->where('b.member_id = ' . (int) $this->_member_id);
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

  /**
  * Lend the member
  * @param    array   Data array of member
  * @return   object  The member object loaned
  */
  public function lend($data = null)
  {
    $data = isset($data) ? $data : JRequest::get('post');

    if (isset($data['lend']) && $data['lend']==1)
    {
      $date = date("Y-m-d H:i:s");

      $data['lent'] = 1;
      $data['lent_date'] = $date;
      $data['lent_uid'] = $data['borrower_id'];

      $waitlistData = array('waitlist_id'=>$data['waitlist_id'], 'fulfilled' => 1, 'fulfilled_time' => $date, 'table' => 'Waitlist');
      $waitlistModel = new EstivoleModelsWaitlist();
      $waitlistModel->store($waitlistData);
    } else {
      $data['lent'] = 0;
      $data['lent_date'] = NULL;
      $data['lent_uid'] = NULL;

    }
    
    $row = parent::store($data);    
    
    return $row;

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