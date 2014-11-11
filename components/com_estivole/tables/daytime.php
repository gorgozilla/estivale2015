<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableDayTime extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__estivole_daytimes', 'daytime_id', $db);
  }
}