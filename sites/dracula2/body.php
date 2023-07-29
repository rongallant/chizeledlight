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
*	File Name: body.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Display front page news stories.
**/
require ("classes/html/body.php");

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);
$not_auth = "You are not authorized to view this resource.<br>You may need to login or <a href='index.php?option=registration&task=register'>register</a>.";

$body = new body();
$query = "SELECT sid, author, introtext, fultext, title, time, newsimage, image_position, access FROM ".$dbprefix."stories WHERE archived=0 AND published=1 AND frontpage=1 ORDER BY ordering";
$result = $database->openConnectionWithReturn($query);
$count = mysql_num_rows($result);
$title = array();
$sid = array();
$time = array();
$introtext = array();
$fultext = array();
$newsimage = array();
$imageposition = array();
if ($count <> 0){
	$i = 0;
	while ($row = mysql_fetch_object($result)){
		$sid[$i] = $row->sid;
		$author[$i] = $row->author;
		$introtext[$i] = $row->introtext;
		$fultext[$i] = $row->fultext;
		$title[$i] = $row->title;
		$dbtime = $row->time;
		$dates = explode("-", $dbtime);
		$time[$i] = strftime("%d %b %Y", mktime (0,0,0,$dates[1],$dates[2],$dates[0]));
		
		$newsimage[$i] = $row->newsimage;
		$imageposition[$i] = $row->image_position;
		$access[$i] = $row->access;
		$i++;
	}
	$body->indexbody($sid, $author, $introtext, $fultext, $title, $time, $newsimage, $imageposition, $col_main, $gid, $access);
}
?>