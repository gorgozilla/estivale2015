<?php
  require_once JPATH_COMPONENT . '/models/member.php';
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
    public static function registerUser($name, $username, $email, $password, $gender, $formData)
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
				
				//Update member that has been created through user registration by plugin estivole
				$user_id = $user->id;
				$query="SELECT * FROM #__estivole_members WHERE user_id='$user_id'";

                $db->setQuery($query);
                $db->query();
				$memberObj = $db->loadObject();
				$member = JTable::getInstance('Member','Table');
				$member->load($memberObj->member_id);
				$member->firstname = $formData['firstname'];
				$member->lastname = $formData['lastname'];
				$member->birthday = $formData['birthday'];
				$member->tshirtsize = $formData['tshirtsize'];
				$member->city = $formData['city'];
				$member->address = $formData['address'];
				$member->npa = $formData['npa'];
				
				if(!$member->store()) 
				{
					$return->message = 'Problème update member!';
					$return->success=false;
					return $return;
				}
				
                // Everything OK!               
                if ($user->id != 0)
                {                   
                    // Auto registration
                    if($useractivation == 0)
                    {
                         
                        $emailSubject = 'Confirmation inscription bénévole Estivale Open Air';
                        $emailBody = '<p>Merci pour votre inscription en tant que bénévole, prépare-toi à kiffer la vibe, du moins nous allons tout faire pour que ce soit le cas! :)</p>';
										
                        $return = JFactory::getMailer()->sendMail('benevoles@estivale.ch', 'Benevoles Estivale', $user->email, $emailSubject, $emailBody, true);                             
						$return->success=true;
						$return->member_id=$memberObj->member_id;
                        return $return;
 
                        // Your code here...
                    }
                    else if($useractivation == 1)
                    {
						// Append this URL in your email body						
                        $user_activation_url = JURI::root().'index.php?option=com_users&task=registration.activate&token='.$user->activation; 
                        $emailSubject = 'Activation compte Estivale Open Air';
                        $emailBody = '	<p>Merci pour votre inscription en tant que bénévole, prépare-toi à kiffer la vibe, du moins nous allons tout faire pour que ce soit le cas! :)</p>
										<p>Afin de finaliser votre inscription et valider votre compte, merci de cliquer sur le lien suivant :<br />'
										.$user_activation_url.
										'<p>Votre nom d\'utilisateur ainsi que votre mot de passe vous sont parvenus dans un email séparé. 
										Utilisez ces derniers pour vous connecter à votre compte,
										vous pourrez ensuite modifier vos paramètres et sélectionnez les dates auxquelles vous souhaitez vous inscrire.</p>
										<p>Meilleures salutations et à bientôt,</p>
										<p>Team Bénévoles Estivale Open Air</p>';
 
                        $return = JFactory::getMailer()->sendMail('sender email', 'sender name', $user->email, $emailSubject, $emailBody, true);                             
						$return->success=true;
						$return->member_id=$memberObj->member_id;
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