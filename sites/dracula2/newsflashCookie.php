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
*	File Name: newsflashCookie.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Stores news flash in cookie.
**/

if (!$newsflashcookie){
	$query = "select * from ".$dbprefix."newsflash where showflash=1";
	$result = $database->openConnectionWithReturn($query);
	$numrows = mysql_num_rows($result);
	if ($numrows>1) {
		$numrows = $numrows-1;
		mt_srand((double)microtime()*1000000);
		$newsnum = mt_rand(0, $numrows);
	} else {
		$newsnum = 0;
	}
	$query2 = "select newsflashID from ".$dbprefix."newsflash where showflash=1 limit $newsnum,1";
	$result2 = $database->openConnectionWithReturn($query2);
	list($flashid) = mysql_fetch_row($result2);
	if($numrows>0) {
		if ($flashid!=""){
			$query3 ="select * from ".$dbprefix."newsflash where newsflashID='$flashid'";
			$result3 = $database->openConnectionWithReturn($query3);
			list($newsflashID, $flashtitle, $flashcontent) = mysql_fetch_array($result3);
			mysql_free_result($result3);
		}
	}
	$flashcontent= substr("$flashcontent", 0, 400);
	$newsflash = base64_encode("$newsflashID");
	//get the cookie lifetime as set in config.php3 and set this into a variable as the
	//number of seconds since Jan 1st,1970(epoch)
	$lifetime= (time() + 43200);
	setcookie("newsflashcookie", "$newsflash");
	$newsflashcookie=$newsflash;
	mysql_free_result($result2);
	mysql_free_result($result);
}
?>