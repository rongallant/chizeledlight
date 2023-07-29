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
*	File Name: weblinks.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: The function listing retrieves all web links categories and titles from the database.
**/

require ("classes/html/weblinks.php");
$weblinks = new weblinks();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

listweblinks($weblinks, $database, $dbprefix, $topid, $gid, $shownoauth);

function listweblinks($weblinks, $database, $dbprefix, $topid, $gid, $shownoauth) {
	/* Query to retrieve all categories that belong under the web links section and that are published. */
	$query = "SELECT categoryid, categoryname, categoryimage, image_position FROM ".$dbprefix."categories WHERE section='Weblinks' AND published=1 and access<=$gid ORDER BY categoryname";
	$result = $database->openConnectionWithReturn($query);
	$j = 0;
	while ($row = mysql_fetch_object($result)){
		$catidid[$j] = $row->categoryid;
		$catidtext[$j] = $row->categoryname;
		$query2 = "SELECT url, title, description, date FROM ".$dbprefix."links WHERE catid=$row->categoryid and published=1 and archived=0 ORDER BY ordering";
		$result2 = $database->openConnectionWithReturn($query2);
		$num[$j] = mysql_num_rows($result2);
		if ($topid <> ""){
			$i=0;
			while ($row2 = mysql_fetch_object($result2)){
				$sid[$row->categoryname][$i] = $row2->url;
				$title[$row->categoryname][$i] = $row2->title;
				$description[$row->categoryname][$i] = $row2->description;
				$date[$row->categoryname][$i] = $row2->date;
				$url[$row->categoryname][$i] = $row2->url;
				$i++;
			}
		}
		$j++;
	}
	
	if ($shownoauth){
		$query = "SELECT categoryid, categoryname from ".$dbprefix."categories where section='Weblinks' and published=1 AND access>$gid ORDER BY categoryname";
		$result = $database->openConnectionWithReturn($query);
		$numresult = mysql_num_rows($result);
		$j = 0;
		while ($row = mysql_fetch_object($result)){
			$noauth_catidtext[$j] = $row->categoryname;
			$j++;
		}
	}
	
	$weblinks->displaylist($catidtext, $catidid, $num, $title, $description, $sid, $topid, $date, $url, $noauth_catidtext);
	mysql_free_result ($result);
}
?>
