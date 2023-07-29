<?php
/**
*	Mambo Open Source Version 4.0.12
*	Dynamic portal server and Content managment engine
*	20-01-2003
*
*	Copyright (C) 2000 - 2003 Miro International Pty. Limited
*	Distributed under the terms of the GNU General Public License
*	This software may be used without warranty provided these statements are left
*	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*	This code is Available at http://sourceforge.net/projects/mambo
*
*	Site Name: Mambo Open Source Version 4.0.12
*	File Name: userpage.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 20-01-2003
* 	Version #: 4.0.12
*	Comments: User submitted forms - news, articles and faq's.
**/

include('configuration.php');
include("regglobals.php");
include_once( 'language/'.$lang.'/lang_userpage.php' );

if ($userhtml==""){
	require ("classes/html/userpage.php");
	include ("configuration.php");
	$userhtml = new HTML_user();
}

if ($database==""){
	require("classes/database.php");
	$database = new database();
}

if ($HTTP_COOKIE_VARS["usercookie"]!=""){
	$cryptSessionID=md5($usercookie);
	$query="SELECT userid FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
	$result=$database->openConnectionWithReturn($query);
	if (mysql_num_rows($result)!=0){
		list($uid)=mysql_fetch_array($result);
		if (phpversion() <= "4.2.1") {
			$browse = getenv("HTTP_USER_AGENT");
		} else {
			$browse = $_SERVER['HTTP_USER_AGENT'];
		}
		if (preg_match("/MSIE/i", "$browse")){
			if (preg_match("/Mac/i", $browse)){
				$text_editor = false;
			}elseif (preg_match("/Windows/i", $browse)){
				$text_editor = true;
			}
		}elseif (preg_match("/Mozilla/i", "$browse")){
			if (preg_match("/Mac/i", $browse)){
				$text_editor = false;
			}elseif (preg_match("/Windows/i", $browse)){
				$text_editor = false;
			}
		}

		switch($op){
			case "UserArticle":
			articleForm($userhtml, $database, $dbprefix, $uid, $option, $ImageName, $text_editor);
			break;
			case "SaveNewArticle":
			saveNewArticle($userhtml, $database, $dbprefix, $uid, $option, $arttitle, $artsection, $pagecontent, $ImageName2, $anonymous, $live_site, $sitename);
			break;
			case "saveUpload":
			saveUpload($userhtml, $database, $dbprefix, $uid, $option, $userfile, $userfile_name, $type, $existingImage);
			break;
			case "UserDetails":
			userEdit($userhtml, $database, $dbprefix, $uid, $option);
			break;
			case "saveUserEdit":
			saveUserEdit($database, $dbprefix, $uid, $option, $name2, $username2, $pass2, $email2, $verifyPass);
			break;
			case "UserFAQ":
			FAQForm($userhtml, $database, $dbprefix, $uid, $option, $text_editor);
			break;
			case "SaveNewFAQ":
			saveNewFAQ($userhtml, $database, $dbprefix, $uid, $option, $faqtitle, $faqsection, $pagecontent, $live_site, $sitename);
			break;
			case "UserLink":
			linkForm($userhtml, $database, $dbprefix, $uid, $option);
			break;
			case "SaveNewLink":
			saveNewLink($userhtml, $database, $dbprefix, $uid, $option, $linktitle, $linkdesc, $linksection, $linkUrl, $live_site, $sitename);
			break;
			case "UserNews":
			newsForm($userhtml, $database, $dbprefix, $uid, $option, $ImageName, $text_editor);
			break;
			case "SaveNewNews":
			saveNewNews($userhtml, $database, $dbprefix, $uid, $option, $newstitle, $newssection, $introtext, $fultext, $ImageName2, $position, $live_site, $sitename);
			break;
			default:
			$userhtml->frontpage();
			break;
		}
	}else{
		setcookie("usercookie");
		$usercookie="";
	}
}else{
	echo "<SCRIPT>document.location.href='index.php';</SCRIPT>";
}

function newsForm($userhtml, $database, $dbprefix, $uid, $option, $ImageName, $text_editor){
	//$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='News' and published=1";
	$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='News'";
	$result = $database->openConnectionWithReturn($query);
	$i = 0;
	while ($row = mysql_fetch_object($result)){
		$catid[$i] = $row->categoryid;
		$secname[$i] = $row->categoryname;
		$i++;
	}
	$userhtml->newsForm($catid, $secname, $uid, $option, $ImageName, $text_editor);
}

function articleForm($userhtml, $database, $dbprefix, $uid, $option, $ImageName, $text_editor){
	//$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='Articles' and published=1";
	$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='Articles'";
	$result = $database->openConnectionWithReturn($query);
	$i = 0;
	while ($row = mysql_fetch_object($result)){
		$catid[$i] = $row->categoryid;
		$secname[$i] = $row->categoryname;
		$i++;
	}
	$userhtml->articleForm($catid, $secname, $uid, $option, $ImageName, $text_editor);
}

function FAQForm($userhtml, $database, $dbprefix, $uid, $option, $text_editor){
	//$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='Faq' and published=1";
	$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='Faq'";
	$result = $database->openConnectionWithReturn($query);
	$i = 0;
	while ($row = mysql_fetch_object($result)){
		$catid[$i] = $row->categoryid;
		$secname[$i] = $row->categoryname;
		$i++;
	}
	$userhtml->FAQForm($catid, $secname, $uid, $option, $text_editor);
}

function linkForm($userhtml, $database, $dbprefix, $uid, $option){
	//$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='Weblinks' and published=1";
	$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='Weblinks'";
	$result = $database->openConnectionWithReturn($query);
	$i = 0;
	while ($row = mysql_fetch_object($result)){
		$catid[$i] = $row->categoryid;
		$secname[$i] = $row->categoryname;
		$i++;
	}
	$userhtml->linkForm($catid, $secname, $uid, $option);
}

function saveNewNews($userhtml, $database, $dbprefix, $uid, $option, $newstitle, $newssection, $introtext, $fultext, $ImageName2, $position, $live_site, $sitename){
	//if ((trim($newstitle)=="") || (trim($newssection)=="") || (trim($introtext)=="") || (trim($ImageName2)=="")){
	if ((trim($newstitle)=="") || (trim($newssection)=="") || (trim($introtext)=="")){
		print "<SCRIPT> alert(\""._SAVE_ERR."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		$query="select Max(ordering) as MaxOrder from ".$dbprefix."stories where catid='$newssection'";
		$result=$database->openConnectionWithReturn($query);
		list($MaxOrder)=mysql_fetch_array($result);
		$MaxOrder++;
		$date=date("Y-m-d");
		$time=date("H:i:s");
		$date="$date $time";
		$query="select name from ".$dbprefix."users where id='$uid'";
		$result=$database->openConnectionWithReturn($query);
		list($author)=mysql_fetch_array($result);
		mysql_free_result($result);
		if (isset($anonymous)){
			$SeeAuthor="";
		}else{
			$SeeAuthor=$author;
		}
		if (!get_magic_quotes_gpc()) {
			$newstitle = addslashes($newstitle);
			$introtext = addslashes($introtext);
			$fultext = addslashes($fultext);
		}
		$query = "INSERT INTO ".$dbprefix."stories SET title='$newstitle', author='$SeeAuthor', introtext='$introtext', fultext='$fultext', catid='$newssection', time='$date' , newsimage='$ImageName2', image_position='$position', approved=0";
		$database->openConnectionNoReturn($query);

		$query="select email, name, sendEmail from ".$dbprefix."users where usertype='superadministrator'";
		$result=$database->openConnectionWithReturn($query);
		list ($adminEmail, $adminName, $sendEmail)=mysql_fetch_array($result);

		$query="select name from ".$dbprefix."users where id='$uid'";
		$result=$database->openConnectionWithReturn($query);
		list ($author)=mysql_fetch_array($result);

		if ($sendEmail==1){
			$type="News Story";
			$title=$newstitle;
			sendAdminMail($adminName, $adminEmail, $email, $type, $title, $author, $live_site);
		}

		echo "<SCRIPT> alert(\""._THANK_SUB."\"); document.location.href='index.php?option=$option';</SCRIPT>";
	}
}


function saveNewArticle($userhtml, $database, $dbprefix, $uid, $option, $arttitle, $artsection, $pagecontent, $ImageName2, $anonymous, $live_site, $sitename){
	if ((trim($arttitle)=="") || (trim($artsection)=="") || (trim($pagecontent)=="")){
		print "<SCRIPT> alert(\""._SAVE_ERR."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		$query="select Max(ordering) as MaxOrder from ".$dbprefix."articles where catid='$artsection'";
		$result=$database->openConnectionWithReturn($query);
		list($MaxOrder)=mysql_fetch_array($result);
		$MaxOrder++;
		$date=date("Y-m-d");
		if (trim($ImageName2)!=""){
			$ImageLink="images/stories/$ImageName2";
			$pagecontent= "<img src=$ImageLink align=right> $pagecontent";
		}
		$query="select name from ".$dbprefix."users where id='$uid'";
		$result=$database->openConnectionWithReturn($query);
		list($author)=mysql_fetch_array($result);
		mysql_free_result($result);
		if (isset($anonymous)){
			$SeeAuthor="";
		}else{
			$SeeAuthor=$author;
		}
		if (!get_magic_quotes_gpc()) {
			$arttitle = addslashes($arttitle);
			$pagecontent = addslashes($pagecontent);
		}
		$query = "INSERT INTO ".$dbprefix."articles SET title='$arttitle', content='$pagecontent', catid='$artsection', date='$date' , userID='$uid', ordering='$MaxOrder', author='$SeeAuthor'";
		$database->openConnectionNoReturn($query);

		$query="select email, name, sendEmail from ".$dbprefix."users where usertype='superadministrator'";
		$result=$database->openConnectionWithReturn($query);
		list ($adminEmail, $adminName, $sendEmail)=mysql_fetch_array($result);

		if ($sendEmail==1){
			$type="Article";
			$title=$arttitle;
			sendAdminMail($adminName, $adminEmail, $email, $type, $title, $author, $live_site);
		}

		echo "<SCRIPT> alert(\""._THANK_SUB."\"); document.location.href='index.php?option=$option';</SCRIPT>";
	}
}

function saveNewFAQ($userhtml, $database, $dbprefix, $uid, $option, $faqtitle, $faqsection, $pagecontent, $live_site, $sitename){
	if ((trim($faqtitle)=="") || (trim($faqsection)=="") || (trim($pagecontent)=="")){
		print "<SCRIPT> alert(\""._SAVE_ERR."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		$query="select Max(ordering) as MaxOrder from ".$dbprefix."faqcont where catid='$artsection'";
		$result=$database->openConnectionWithReturn($query);
		list($MaxOrder)=mysql_fetch_array($result);
		$MaxOrder++;
		$date=date("Y-m-d");
		if (!get_magic_quotes_gpc()) {
			$faqtitle = addslashes($faqtitle);
			$pagecontent = addslashes($pagecontent);
		}
		$query = "INSERT INTO ".$dbprefix."faqcont SET title='$faqtitle', content='$pagecontent', catid='$faqsection', ordering='$MaxOrder', approved=0";
		$database->openConnectionNoReturn($query);

		$query="select email, name, sendEmail from ".$dbprefix."users where usertype='superadministrator'";
		$result=$database->openConnectionWithReturn($query);
		list ($adminEmail, $adminName, $sendEmail)=mysql_fetch_array($result);

		$query="select name from ".$dbprefix."users where id='$uid'";
		$result=$database->openConnectionWithReturn($query);
		list ($author)=mysql_fetch_array($result);

		$pat="\\\'";
		$replace="'";

		$faqtitle=eregi_replace($pat, $replace, $faqtitle);

		if ($sendEmail==1){
			$type="FAQ";
			$title=$faqtitle;
			sendAdminMail($adminName, $adminEmail, $email, $type, $title, $author, $live_site);
		}
		echo "<SCRIPT> alert(\""._THANK_SUB."\"); document.location.href='index.php?option=$option';</SCRIPT>";
	}
}

function saveNewLink($userhtml, $database, $dbprefix, $uid, $option, $linktitle, $linkdesc, $linksection, $linkUrl, $live_site, $sitename){
	if ((trim($linktitle)=="") || (trim($linksection)=="") || (trim($linkUrl)=="")){
		print "<SCRIPT> alert(\""._SAVE_ERR."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		$checkLink=eregi("http://", $linkUrl);
		if (!$checkLink){
			$linkUrl="http://".$linkUrl;
		}

		$query="select Max(ordering) as MaxOrder from ".$dbprefix."links where catid='$linksection'";
		$result=$database->openConnectionWithReturn($query);
		list($MaxOrder)=mysql_fetch_array($result);
		$MaxOrder++;
		$date=date("Y-m-d");
		if (!get_magic_quotes_gpc()) {
			$linktitle = addslashes($linktitle);
			$linkdesc = addslashes($linkdesc);
		}
		$query = "INSERT INTO ".$dbprefix."links SET title='$linktitle', description='$linkdesc', url='$linkUrl', catid='$linksection', ordering='$MaxOrder', approved=0, date='$date'";
		echo $query;
		$database->openConnectionNoReturn($query);

		$query="select email, name, sendEmail from ".$dbprefix."users where usertype='superadministrator'";
		$result=$database->openConnectionWithReturn($query);
		list ($adminEmail, $adminName, $sendEmail)=mysql_fetch_array($result);

		$query="select name from ".$dbprefix."users where id='$uid'";
		$result=$database->openConnectionWithReturn($query);
		list ($author)=mysql_fetch_array($result);

		if ($sendEmail==1){
			$type="Weblink";
			$title=$linktitle;
			sendAdminMail($adminName, $adminEmail, $email, $type, $title, $author, $live_site);
		}
		echo "<SCRIPT> alert(\""._THANK_SUB."\"); document.location.href='index.php?option=$option';</SCRIPT>";
	}
}


function saveUpload($userhtml, $database, $dbprefix, $uid, $option, $userfile, $userfile_name, $type, $existingImage){
	$base_Dir = "images/stories/";

	$checksize=filesize($userfile);
	if ($checksize > 15000){
		echo "<SCRIPT> alert(\""._UP_SIZE."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		if (file_exists($base_Dir.$userfile_name)){
			$message=_UP_EXISTS;
			eval ("\$message = \"$message\";");
			print "<SCRIPT> alert('$message'); window.history.go(-1);</SCRIPT>\n";
		}else{
			if ((!strcasecmp(substr($userfile_name,-4),".gif")) || (!strcasecmp(substr($userfile_name,-4),".jpg"))){
				if (!(move_uploaded_file($userfile, $base_Dir.$userfile_name) && chmod($base_Dir.$userfile_name, 0644))){
					echo _UP_COPY_FAIL." $userfile_name";
				}else{
					echo "<SCRIPT>window.opener.focus;</SCRIPT>";
					if ($type=="news"){
						$op="UserNews";
					}elseif ($type=="articles"){
						$op="UserArticle";
					}

					if ($existingImage!=""){
						if (file_exists($base_Dir.$existingImage)) {
							//delete the exisiting file
							unlink($base_Dir.$existingImage);
						}
					}
					echo "<SCRIPT>window.opener.document.adminForm.ImageName.value='$userfile_name';</SCRIPT>";
					echo "<SCRIPT>window.opener.document.adminForm.ImageName2.value='$userfile_name';</SCRIPT>";
					echo "<SCRIPT>window.opener.document.adminForm.imagelib.src=null;</SCRIPT>";
					echo "<SCRIPT>window.opener.document.adminForm.imagelib.src='images/stories/$userfile_name';</SCRIPT>";
					echo "<SCRIPT>window.close(); </SCRIPT>";
				}
			}else{
				echo "<SCRIPT> alert(\""._UP_TYPE_WARN."\"); window.history.go(-1); </SCRIPT>\n";
			}
		}
	}
}

function sendAdminMail($adminName, $adminEmail, $email, $type, $title, $author, $live_site){
	$recipient = "$adminName <$adminEmail>";
	$subject = _MAIL_SUB." '$type'";
	$message = _MAIL_MSG;
	eval ("\$message = \"$message\";");
	$headers .= "From: $sitename <$adminEmail>\n";
	$headers .= "X-Sender: <$live_site> \n";
	$headers .= "X-Mailer: PHP\n"; // mailer
	$headers .= "Return-Path: <$email>\n";  // Return path for errors
	mail($recipient, $subject, $message, $headers);
}

function userEdit($userhtml, $database, $dbprefix, $uid, $option){
	$query = "SELECT name, username, email FROM ".$dbprefix."users where id='$uid'";
	$result = $database->openConnectionWithReturn($query);
	$i = 0;
	list($name, $username, $email)=mysql_fetch_array($result);
	$userhtml->userEdit($uid, $name, $username, $email, $option);
}

function saveUserEdit($database, $dbprefix, $uid, $option, $name2, $username2, $pass2, $email2, $verifyPass){
	echo "&nbsp;";
	if ((trim($name2)=="") || (trim($username2)=="") || (trim($email2)=="")){
		print "<SCRIPT> alert(\""._SAVE_ERR."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		if ((trim($pass2)!="") && (trim($verifyPass)=="")){
			print "<SCRIPT> alert(\""._PASS_VERR1."\"); window.history.go(-1); </SCRIPT>\n";
		}elseif ((trim($pass2)!="") && (trim($verifyPass)!="")){
			if ($pass2 != $verifyPass){
				print "<SCRIPT> alert(\""._PASS_VERR2."\"); window.history.go(-1); </SCRIPT>\n";
			}
		}
		$query="select id from ".$dbprefix."users where username='$username2' and id!='$uid' and usertype='user'";
		$result=$database->openConnectionWithReturn($query);
		if (mysql_num_rows($result)!=0){
			print "<SCRIPT> alert(\""._UNAME_INUSE."\"); window.history.go(-1); </SCRIPT>\n";
		}else{
			if ($pass2!=""){
				$pass2=md5($pass2);
				$query="update ".$dbprefix."users set name='$name2', username='$username2', email='$email2', password='$pass2' where id=$uid";
				$database->openConnectionNoReturn($query);
			}else{
				$query="update ".$dbprefix."users set name='$name2', username='$username2', email='$email2' where id=$uid";
				$database->openConnectionNoReturn($query);
			}
			echo "<SCRIPT>document.location.href='index.php?option=user';</SCRIPT>";
		}
	}

}
?>
