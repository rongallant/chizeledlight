<?php 
/**
*  Mambo Open Source Version 4.0
*  Dynamic portal server and Content managment engine
*  20-01-2003
*
*  Copyright (C) 2000 - 2003 Miro International Pty Ltd
*  Distributed under the terms of the GNU General Public License
*  This software may be used without warranty provided these statements are left
*  intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*  This code is available at http://sourceforge.net/projects/mambo
*
*  Site Name: Mambo Open Source Version 4.0
*  File Name: mainbody.php
*  Original Original Developers: Danny Younes - danny@miro.com.au
*                       Nicole Anderson - nicole@miro.com.au
*  Date: 14/12/2002
*  Version #: 4.0.12
*  Comments:
**/
include('language/'.$lang.'/lang_mainbody.php');

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

switch ($option){
	case "news":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("news.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "articles":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("articles.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "weblinks":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("weblinks.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "faq":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("faq.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "surveyresult":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("pollBooth.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "search":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("search.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "contact":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("contact.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "user":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("userpage.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "archiveNews":
	$ret = menucheck($Itemid, $option, $gid, $dbprefix);
	if ($ret==true) {
		include("pastarticles.php");
	} else {
		echo _NOT_AUTH;
	}
	break;
	case "displaypage":
	include("displaypage.php");
	break;
	case "registration":
	include("registration.php");
	break;
	case "";
	$Itemid=1;
	include ("body.php");
	break;
	default:
	if ((substr($option,0,4))=="com_" && file_exists("components/$option.php")){
		$ret = menucheck($Itemid, $option, $gid, $dbprefix);
		if ($ret==true) {
			include ("components/$option.php");
		} else {
			echo _NOT_AUTH;
		}
	} else {
		echo ("<span class=\"articlehead\">Page does not exist</span>");
	}
	
}
?>