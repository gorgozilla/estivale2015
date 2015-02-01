<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class EstivoleHelpersStyle
{
	function load()
	{
		$document = JFactory::getDocument();

		// //stylesheets
		$document->addStylesheet(JURI::base().'components/com_estivole/assets/css/watable.css');
		
		//javascripts
		$document->addScript(JURI::base().'components/com_estivole/assets/js/estivole.js');
		$document->addScript(JURI::base().'components/com_estivole/assets/js/jquery.watable.js');
	}
}