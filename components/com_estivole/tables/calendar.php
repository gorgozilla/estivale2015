<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableCalendar extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__estivole_calendars', 'calendar_id', $db);
  }
}