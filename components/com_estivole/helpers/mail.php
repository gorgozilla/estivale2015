<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
require_once JPATH_COMPONENT . '/models/daytime.php';
require_once JPATH_COMPONENT . '/models/service.php';
require_once JPATH_COMPONENT . '/models/member.php';

/*
JMail deifinition
--------------------
addAttachment 
- Add file attachments to the email

addBCC
-Add blind carbon copy recipients to the email

addCC 
- Add carbon copy recipients to the email

addRecipient 
- Add recipients to the email

addReplyTo 
- Add Reply to email address(es) to the email

getInstance 
- Returns the global email object, only creating it if it doesn't already exist.

isHtml 
- Sets message type to HTML

Send 
- Send the mail

sendAdminMail 
- Sends mail to administrator for approval of a user submission

sendMail 
- Function to send an email

setBody 
- Set the email body

setSender 
- Set the email sender

setSubject 
- Set the email subject

useSendmail 
- Use sendmail for sending the email

useSMTP 
- Use SMTP for sending the email */

class EstivoleHelpersMail
{	
	function sendMemberDaytimeToAdmin($member_id, $service_id, $daytime_id){
		define("BodyMemberDaytimeToAdmin", "<h1>Nouvelle inscription � une tranche horaire</h1><p>Un b�n�vole s'est inscrit � un secteur / tranche horaire.</p><p><strong>Nom :</strong> %s <br /><strong>Secteur :</strong> %s<br /><strong>Date :</strong> %s<br /><strong>Tranche horaire :</strong> %s</p><p><a href=\"http://127.0.0.1/estivale2015/administrator/index.php?option=com_estivole&view=member&layout=edit&member_id=%s\">Cliquez ici</a> pour valider l'inscription et/ou recontacter le b�n�vole.</p>");
		define("SubjectMemberDaytimeToAdmin", "Nouvelle inscription � une tranche horaire");
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);

		$query->select('*');
		$query->from('#__estivole_members as b, #__estivole_services as s, #__estivole_daytimes as d');
		$query->where('b.member_id = ' . (int) $member_id);
		$query->where('s.service_id = ' . (int) $service_id);
		$query->where('d.daytime_id = ' . (int) $daytime_id);
		$db->setQuery($query);
		$mailModel = $db->loadObject();
		
		$mail = JFactory::getMailer();
		$mail->setBody(sprintf(constant("BodyMemberDaytimeToAdmin"), $mailModel->firstname.' '.$mailModel->lastname, $mailModel->name, date('d-m-Y',strtotime($mailModel->daytime_day)), date('H:i',strtotime($mailModel->daytime_hour_start)).' - '.date('H:i',strtotime($mailModel->daytime_hour_start)), $mailModel->member_id));
		$mail->setSubject(constant("SubjectMemberDaytimeToAdmin"));
		$mail->isHtml();
		$mail->addRecipient('ljeanmonod@gmail.com');
		$mail->Send('estivole@estivale.ch');
	}
}