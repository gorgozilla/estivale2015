<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
  class TableMember extends JTable
  {                      
    /**
    * Constructor
    *
    * @param object Database connector object
    */
    function __construct( &$db ) {
      parent::__construct('#__estivole_members', 'member_id', $db);
    }
  }