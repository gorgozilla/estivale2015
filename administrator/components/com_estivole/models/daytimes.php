<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class EstivoleModelDaytimes extends JModelList
{
	function __construct()
	{
		$app = JFactory::getApplication();
		$this->member_daytime_id = $app->input->get('member_daytime_id', null);
		$this->_member_id = $app->input->get('member_id', null);
		$this->_calendar_id = $app->input->get('calendar_id', null);
	
		$config['filter_fields'] = array(
			'm.lastname',
			'm.firstname',
			'm.email',
			'm.city',
			's.name',
			'md.status_id'
		);
		parent::__construct($config);     
	}
  
	protected function populateState($ordering = null, $direction = null) {
		$app = JFactory::getApplication();
		
		// Get pagination request variables
		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		parent::populateState('lastname', 'ASC');
	}
	
	function getData() 
	{
		// if data hasn't already been obtained, load it
		if (empty($this->_data)) {
			$query = $this->_buildQuery();
			$query = $this->_buildWhere($query);
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));	
		}
		return $this->_data;
	}

  function getTotal()
  {
 	// Load the content if it doesn't already exist
 	if (empty($this->_total)) {
 	    $query = $this->_buildQuery();
		$query = $this->_buildWhere($query);
 	    $this->_total = $this->_getListCount($query);	
 	}
 	return $this->_total;
  }

  function getPagination()
  {
 	// Load the content if it doesn't already exist
 	if (empty($this->_pagination)) {
 	    jimport('joomla.html.pagination');
 	    $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
 	}
 	return $this->_pagination;
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
		$query->from('#__estivole_members as m, #__estivole_services as s, #__estivole_daytimes as d, #__estivole_members_daytimes as md');
		$query->where('md.member_id = m.member_id');
		$query->where('md.service_id = s.service_id');
		$query->where('md.daytime_id = d.daytime_id');
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
		if(is_numeric($this->_member_id)) 
		{
			$query->where('md.member_id = ' . $this->_member_id);
		}
		
		if(is_numeric($this->_calendar_id)) 
		{
			$query->where('d.calendar_id = ' . $this->_calendar_id);
		}

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
	* Build query and where for protected _getList function and return a list
	*
	* @return array An array of results.
	*/
	public function listItemsByDate()
	{
		$db = JFactory::getDBO();
		$query = $this->_buildQuery();    
		$query = $this->_buildWhere($query);
		$query->order('d.daytime_day');
		$db->setQuery($query);
		$result = $db->loadObjectList();
		return $result;
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
		$limit = $this->getState('limit');
		$limitstart = $this->getState('limitstart');
		$db = JFactory::getDBO();
		$query->order($db->escape($this->getState('list.ordering', 'm.lastname')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		$db->setQuery($query, $limitstart, $limit);
		$result = $db->loadObjectList();
		return $result;
	}
}