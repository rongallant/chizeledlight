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
*	File Name: whosOnline.php
*	Original Developers: Danny Younes - danny@miro.com.au
*					Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Display's number of users online.
**/

include('language/'.$lang.'/lang_whosOnline.php');

$query2 = "SELECT session_id FROM ".$dbprefix."session where guest=1 and (usertype is NULL OR usertype='')";
$result2=$database->openConnectionWithReturn($query2);
$guest_online_num = mysql_num_rows($result2);

$query2 = "SELECT session_id FROM ".$dbprefix."session where guest=0 and (usertype is NULL OR usertype='user')";
$result2=$database->openConnectionWithReturn($query2);
$member_online_num = mysql_num_rows($result2);

$username="";
if ($guest_online_num==1){
	$content=_GUEST_COUNT;
	eval ("\$content = \"$content\";");
}else{
	$content=_GUESTS_COUNT;
	eval ("\$content = \"$content\";");
}
if ($member_online_num==1){
	$content.=_MEMBER_COUNT;
	eval ("\$content = \"$content\";");
}else{
	$content.=_MEMBERS_COUNT;
	eval ("\$content = \"$content\";");
}
?>
