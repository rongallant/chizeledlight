<?php 
/**
*	Mambo Open Source Version 4.0.12
*	Dynamic portal server and Content managment engine
*	07-04-2003
*
*	Copyright (C) 2000 - 2003 Miro International Pty. Limited
*	Distributed under the terms of the GNU General Public License
*	This software may be used without warranty provided these statements are left
*	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*	This code is Available at http://sourceforge.net/projects/mambo
*
*	Site Name: Mambo Open Source Version 4.0.12
*	File Name: registration.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 07-04-2003
* 	Version #: 4.0.12
*	Comments: Functions to retrieve lost passwords, register new users.
**/

include_once('language/'.$lang.'/lang_registration.php' );

$sec="SELECT id, module FROM ".$dbprefix."components WHERE publish='1' AND module='login'";
$result=$database->openConnectionWithReturn($sec);
$row = mysql_num_rows($result);
if ($row!='1') {
	print "<SCRIPT>document.location.href='index.php'</SCRIPT>\n";
}
require ("classes/html/registration.php");
$registration = new registration();

switch($task) {
	case "lostPassword":
	lostPassForm($registration, $option);
	break;
	case "sendNewPass":
	sendNewPass($checkusername, $confirmEmail, $option, $database, $dbprefix, $live_site);
	break;
	case "register":
	registerForm($registration, $option);
	break;
	case "saveRegistration":
	saveRegistration($yourname, $username1, $email, $pass, $verifyPass, $option, $database, $dbprefix, $live_site);
	break;
}

function lostPassForm($registration, $option){
	$registration->lostPassForm($option);
}

function sendNewPass($checkusername, $confirmEmail, $option, $database, $dbprefix, $live_site){
	$query="select email from ".$dbprefix."users where username='$checkusername' and email='$confirmEmail' and usertype='user'";
	$result=$database->openConnectionWithReturn($query);
	if (mysql_num_rows($result)==0){
		print "<SCRIPT> alert(\""._ERROR_PASS."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		$newpass=makepass();
		$message=_NEWPASS_MSG;
		eval ("\$message = \"$message\";");
		$subject=_NEWPASS_SUB;
		eval ("\$subject = \"$subject\";");
		mail($confirmEmail, $subject, $message, "From: Administration");
		$newpass=md5($newpass);
		$query="update ".$dbprefix."users set password='$newpass' where username='$checkusername' and usertype='user'";
		$database->openConnectionNoReturn($query);
		echo '&nbsp;&nbsp;<BR><BR><B>'._NEWPASS_SENT.'</B>';
	}
}

function makePass() {
	$makepass="";
	$syllables="er,in,tia,wol,fe,pre,vet,jo,nes,al,len,son,cha,ir,ler,bo,ok,tio,nar,sim,ple,bla,ten,toe,cho,co,lat,spe,ak,er,po,co,lor,pen,cil,li,ght,wh,at,the,he,ck,is,mam,bo,no,fi,ve,any,way,pol,iti,cs,ra,dio,sou,rce,sea,rch,pa,per,com,bo,sp,eak,st,fi,rst,gr,oup,boy,ea,gle,tr,ail,bi,ble,brb,pri,dee,kay,en,be,se";
	$syllable_array=explode(",", $syllables);
	mt_srand((double)microtime()*1000000);
	for ($count=1;$count<=4;$count++) {
		if (mt_rand()%10 == 1) {
			$makepass .= sprintf("%0.0f",(mt_rand()%50)+1);
		} else {
			$makepass .= sprintf("%s",$syllable_array[mt_rand()%62]);
		}
	}
	return($makepass);
}

function registerForm($registration, $option){
	$registration->registerForm($option);
}

function saveRegistration($yourname, $username1, $email, $pass, $verifyPass, $option, $database, $dbprefix, $live_site){
	$checkpass = split("\.", $pass);
	$checkpass2 = strlen($checkpass[0]);
	$yourname = str_replace ('<', '&lt;', $yourname);
	$yourname = str_replace ('>', '&gt;', $yourname);
	if (trim($yourname)==""){
		print "<SCRIPT> alert(\""._REGWARN_NAME."\"); window.history.go(-1); </SCRIPT>\n";
	}else if (trim($username1)==""){
		print "<SCRIPT> alert(\""._REGWARN_UNAME."\"); window.history.go(-1); </SCRIPT>\n";
	}else if (trim($email)==""){
		print "<SCRIPT> alert(\""._REGWARN_MAIL."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		$query="select id from ".$dbprefix."users where username='$username1' and usertype='user'";
		$result=$database->openConnectionWithReturn($query);
		$query2="select name, email from ".$dbprefix."users where usertype='superadministrator'";
		$result2=$database->openConnectionWithReturn($query2);
		if (mysql_num_rows($result2)!=0){
			list($adminName, $adminEmail)=mysql_fetch_array($result2);}
			if (mysql_num_rows($result)!=0){
				print "<SCRIPT> alert(\""._REGWARN_INUSE."\"); window.history.go(-1); </SCRIPT>\n";
			}else{
				$newpass=makepass();
				$subject = _SEND_SUB;
				eval ("\$subject = \"$subject\";");
				$message = _USEND_MSG;
				eval ("\$message = \"$message\";");
				$headers .= "From: ".$adminName." <".$adminEmail.">\r\n";
				$headers .= "Reply-To: ".$adminName." <".$adminEmail.">\r\n";
				$headers .= "X-Priority: 1\r\n";
				$headers .= "Return-Path: <".$adminEmail.">\r\n";  // Return path for errors
				$headers .= "X-MSMail-Priority: High\r\n";
				$headers .= "X-Mailer: PHP\n";
				mail($email, $subject, $message, $headers);
				$cryptpass=md5($newpass);
				$query="insert into ".$dbprefix."users (name, username, email, password, usertype) values ('$yourname', '$username1', '$email', '$cryptpass', 'user')";
				$database->openConnectionNoReturn($query);
				
				$query2="select name, email from ".$dbprefix."users where usertype='superadministrator' and sendEmail=1";
				$result2=$database->openConnectionWithReturn($query2);
				if (mysql_num_rows($result2)!=0){
					list($adminName, $adminEmail)=mysql_fetch_array($result2);
					$subject2 = _SEND_SUB;
					eval ("\$subject2 = \"$subject2\";");
					$message2 = _ASEND_MSG;
					eval ("\$message2 = \"$message2\";");
					$headers2 .= "From: ".$adminName." <".$adminEmail.">\r\n";
					$headers2 .= "Reply-To: ".$adminName." <".$adminEmail.">\r\n";
					$headers2 .= "X-Priority: 1\r\n";
					$headers2 .= "Return-Path: <".$adminEmail.">\r\n";
					$headers2 .= "X-Mailer: PHP\n";
					mail($adminEmail, $subject2, $message2, $headers2);
				}
				echo '<BR><BR>&nbsp;&nbsp;'._REG_COMPLETE;
			}
	}
}
?>
