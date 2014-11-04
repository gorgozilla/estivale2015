<?php // No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

//sessions
jimport( 'joomla.session.session' );
 
//load tables
JTable::addIncludePath(JPATH_COMPONENT.'/tables');

//load classes
JLoader::registerPrefix('Estivole', JPATH_COMPONENT);

//Load plugins
JPluginHelper::importPlugin('estivole');
 
//Load styles and javascripts
EstivoleHelpersStyle::load();

//application
$app = JFactory::getApplication();
 
// Require specific controller if requested
$controller = $app->input->get('controller','default');

// Create the controller
$classname  = 'EstivoleControllers'.ucwords($controller);
$controller = new $classname();
 
// Perform the Request task
$controller->execute();