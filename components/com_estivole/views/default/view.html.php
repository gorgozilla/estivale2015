<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 

class EstivoleViewDefault extends JViewLegacy
{
	function display($tpl=null)
	{
		JFactory::getDocument()->setTitle('Set your title here');
		
		//display
		return parent::display($tpl);
	}
}