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
*	File Name: displaypage.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 20-01-2003
* 	Version #: 4.0.12
*	Comments: Display page, reading from a file or a page read from the database.
**/

include_once('language/'.$lang.'/lang_displaypage.php' );

require ("classes/html/displaypage.php");
$display = new displaycontent();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

$ret = menucheck($Itemid, $option, $gid, $dbprefix);
if ($ret==true) {
	switch ($op){
		case "file":
		$query="select id, link from ".$dbprefix."menu where id='$Itemid'";
		$result=$database->openConnectionWithReturn($query);
		list ($id, $link)=mysql_fetch_array($result);
		$basedir = "$link";
		$file=file($basedir);
		$file=implode("\n",$file);
		$file=str_replace("\\'", "'",$file);
		$file=str_replace("\\\"", "\"",$file);
		$content=$file;
		$heading="";
		$display->displaypage($id, $content, $heading);
		break;
		case "page":
		$query="select menuid AS id, content, heading from ".$dbprefix."menucontent where menuid='$Itemid'";
		$result=$database->openConnectionWithReturn($query);
		list ($id, $content, $heading)=mysql_fetch_array($result);
		$display->displaypage($id, $content, $heading);
		break;
	}
} else {
	echo _NOT_AUTH;
}
?>
