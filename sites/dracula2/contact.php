<?php
/**
*	Mambo Open Source Version 4.0.12
*	Dynamic portal server and Content managment engine
*	03-02-2003
*
*	Copyright (C) 2000 - 2003 Miro International Pty. Limited
*	Distributed under the terms of the GNU General Public License
*	This software may be used without warranty provided these statements are left
*	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*	This code is Available at http://sourceforge.net/projects/mambo
*
*	Site Name: Mambo Open Source Version 4.0.12
*	File Name: contact.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Sends email to contact person.
**/
include ('regglobals.php');
include ('configuration.php');
include('language/'.$lang.'/lang_contact.php');

require ("classes/html/contacthtml.php");
$contact = new contact();

switch($op) {
	case "sendmail":
	sendmail($text, $from, $name, $email_to, $sitename);
	break;
	default:
	contactpage($database, $dbprefix, $contact, $absolute_path, $lang, $sitename);
}

function contactpage($database, $dbprefix, $contact, $absolute_path, $lang, $sitename){
	$query = "select * from ".$dbprefix."contact_details where id=1";
	$result = $database->openConnectionWithReturn($query);
	list ($id, $companyname, $ACN, $address, $suburb, $state, $country, $postcode, $telephone, $fax, $email_to)=mysql_fetch_array($result);
	
	$contact->contactpage($id, $companyname, $ACN, $address, $suburb, $state, $country, $postcode, $telephone, $fax, $email_to, $absolute_path, $lang, $sitename);
}

function sendmail($text, $from, $name, $email_to, $sitename){
	if ((isset($text)) && (isset($from))){
		$to = $email_to;
		$subject = $sitename." "._ENQUIRY;
		$text= _ENQUIRY_TEXT." ".$name."\n".stripslashes($text);
		$from2=_FROM." $name <$from>";
		mail ($to, $subject, $text, $from2);?>
		<SCRIPT> alert("<?php echo _THANK_MESSAGE; ?>"); document.location.href='index.php?option=contact';</SCRIPT>
		<?php 	}
}
?>
