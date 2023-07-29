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
*	File Name: OSdetect.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 06/01/2003
* 	Version #: 4.0.12
*	Comments: Determines which operating system is being used.
**/
if (phpversion() <= "4.2.1") {
	$browse = getenv("HTTP_USER_AGENT");
} else {
	$browse = $_SERVER['HTTP_USER_AGENT'];
}
if (preg_match("/Mac/i", $browse)){
	$query = "UPDATE ".$dbprefix."counter SET count = count + 1 WHERE type='OS' AND name='Mac'";
}
elseif (preg_match("/Windows/i", $browse)){
	$query = "UPDATE ".$dbprefix."counter SET count = count + 1 WHERE type='OS' AND name='Windows'";
}
elseif (preg_match("/Linux/i", $browse)){
	$query = "UPDATE ".$dbprefix."counter SET count = count + 1 WHERE type='OS' AND name='Linux'";
}
elseif (preg_match("/FreeBSD/i", $browse)){
	$query = "UPDATE ".$dbprefix."counter SET count = count + 1 WHERE type='OS' AND name='FreeBSD'";
}
else {
	$query = "UPDATE ".$dbprefix."counter SET count = count + 1 WHERE type='OS' AND name='Unknown'";
}
$database->openConnectionNoReturn($query);
?>