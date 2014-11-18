<?php // No direct access

defined('_JEXEC') or die;

$controller	= JControllerLegacy::getInstance('Estivole');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();