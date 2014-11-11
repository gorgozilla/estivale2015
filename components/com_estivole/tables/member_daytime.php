<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableMemberDaytimes extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__estivole_members_daytimes', 'schedule_id', $db);
  }
}