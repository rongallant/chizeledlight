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
*	File Name: newsflash.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Display news flash.
**/

require ("classes/html/newsflash.php");
$newsflash = new newsflash();

if ($newsflashcookie){
	$newsflash2 = base64_decode($newsflashcookie);
	$cookie = explode(":", $newsflash2);
	$newsflashID=$cookie[0];
	$query4="select flashcontent from ".$dbprefix."newsflash WHERE newsflashID=\"$newsflashID\" AND showflash=1";
	$result4 = $database->openConnectionWithReturn($query4);
	list($flashcontent)=mysql_fetch_array($result4);
	mysql_free_result($result4);
	if (trim($flashcontent)!=""){
		$newsflash->WriteNewsflash($flashcontent);
	}
}
?>