<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_estivole
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Estivole component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_estivole
 * @since       1.6
 */
class EstivoleHelpersEstivole
{
	public static $extension = 'com_estivole';

	/**
	 * @return  JObject
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_estivole';
		$level = 'component';

		$actions = JAccess::getActions('com_estivole', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}