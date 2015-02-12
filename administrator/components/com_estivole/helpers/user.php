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
class EstivoleHelpersUser
{
    public static function registerUser($name, $username, $email, $password, $gender)
    {
        $mainframe =& JFactory::getApplication('site');
        $mainframe->initialise();
        $user = clone(JFactory::getUser());
        $pathway = & $mainframe->getPathway();
        $config = & JFactory::getConfig();
        $authorize = & JFactory::getACL();
        $document = & JFactory::getDocument();
         
        $response = array();
        $usersConfig = &JComponentHelper::getParams( 'com_users' );
 
        if($usersConfig->get('allowUserRegistration') == '1')
        {
            // Initialize new usertype setting
            jimport('joomla.user.user');
            jimport('joomla.application.component.helper');
 
            $useractivation = $usersConfig->get('useractivation');
 
            $db = JFactory::getDBO();
            // Default group, 2=registered
            $defaultUserGroup = 2;
 
            $acl = JFactory::getACL();
 
            jimport('joomla.user.helper');
            $salt     = JUserHelper::genRandomPassword(32);
            $password_clear = $password;
 
            $crypted  = JUserHelper::getCryptedPassword($password_clear, $salt);
            $password = $crypted.':'.$salt;
            $instance = JUser::getInstance();
            $instance->set('id'         , 0);
            $instance->set('name'           , $name);
            $instance->set('username'       , $username);
            $instance->set('password' , $password);
            $instance->set('password_clear' , $password_clear);
            $instance->set('email'          , $email);
            $instance->set('usertype'       , 'deprecated');
            $instance->set('groups'     , array($defaultUserGroup));
            // Here is possible set user profile details
            $instance->set('profile'    , array('gender' =>  $gender));
 
            // Email with activation link
            if($useractivation == 1)
            {
                $instance->set('block'    , 1);
                $instance->set('activation'    , JApplication::getHash(JUserHelper::genRandomPassword()));
            }
 
            if (!$instance->save())
            {             	
                // Email already used!!!
				$return->message = 'Email déjà utilisé!';
				$return->success=false;
                return $return;
            }
            else
            {   
                $db->setQuery("update #__users set email='$email' where username='$username'");
                $db->query();
 
                $db->setQuery("SELECT id FROM #__users WHERE email='$email'");
                $db->query();
                $newUserID = $db->loadResult();
 
                $user = JFactory::getUser($newUserID);
 
                // Everything OK!               
                if ($user->id != 0)
                {                   
                    // Auto registration
                    if($useractivation == 0)
                    {
                         
                        $emailSubject = 'Email Subject for registration successfully';
                        $emailBody = 'Email body for registration successfully';                       
                        $return = JFactory::getMailer()->sendMail('sender email', 'sender name', $user->email, $emailSubject, $emailBody);
 
                        // Your code here...
                    }
                    else if($useractivation == 1)
                    {
                        $emailSubject = 'Email Subject for activate the account';
                        $emailBody = 'Email body for for activate the account';     
                        $user_activation_url = JURI::base().JRoute::_('index.php?option=com_users&task=registration.activate&token=' . $user->activation, false);  // Append this URL in your email body
                        $return = JFactory::getMailer()->sendMail('sender email', 'sender name', $user->email, $emailSubject, $emailBody);                             
						$return->success=true;
                        return $return;
                    }
                }
             }
 
        } else {
            // Registration CLOSED!
				$return->message = 'Enregistrement déjà utilisé utilisé!';
				$return->success=false;
                return $return;     
        }
    }
}