<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_estivole
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Content frontend view.
 *
 * @package     Joomla.Site
 * @subpackage  com_contact
 * @since       1.6
 */
class EstivoleViewFrontend extends JViewLegacy
{
        /**
         * Display the frontend view
         *
         * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
         *
         * @return  void
         */
        public function display($tpl = null) 
        {
                // Assign data to the view
                $this->msg = 'Hello World';
 
                // Display the view
                parent::display($tpl);
        }
}
