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
*	File Name: articles.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: The function listing retrieves all article categories and titles from the database.
**/

include('language/'.$lang.'/lang_articles.php');

require("classes/html/articles.php");
$articles = new articles();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

switch($task) {
	case "viewarticle":
	show($articles, $database, $dbprefix, $artid, $gid, $db);
	break;
	default:
	listsections($articles, $database, $dbprefix, $topid, $gid, $shownoauth, $popup);
	break;
}


function listsections($articles, $database, $dbprefix, $topid, $gid, $shownoauth, $popup){
	$query = "SELECT categoryid, categoryname from ".$dbprefix."categories where section='Articles' and published=1 AND access<='$gid' ORDER BY categoryname";
	$result = $database->openConnectionWithReturn($query);
	$j = 0;
	while ($row = mysql_fetch_object($result)){
		$catidtext[$j] = $row->categoryname;
		$catidid[$j] = $row->categoryid;
		$query1 = "SELECT artid, title, date, counter, author FROM ".$dbprefix."articles WHERE catid='$row->categoryid' AND approved=1 and published=1 and archived=0 ORDER BY date DESC";
		
		$result1 = $database->openConnectionWithReturn($query1);
		$num[$j] = mysql_num_rows($result1);
		if ($topid <> ""){
			$i=0;
			if (mysql_num_rows($result1)<> 0){
				while ($row1 = mysql_fetch_object($result1)){
					$sid[$row->categoryname][$i] = $row1->artid;
					$title[$row->categoryname][$i] = $row1->title;
					$date[$row->categoryname][$i] = $row1->date;
					$counter[$row->categoryname][$i] = $row1->counter;
					$author[$row->categoryname][$i] = $row1->author;
					$i++;
				}
			}
		}
		$j++;
	}
	
	if ($shownoauth){
		$query = "SELECT categoryid, categoryname from ".$dbprefix."categories where section='Articles' and published=1 AND access>'$gid' ORDER BY categoryname";
		$result = $database->openConnectionWithReturn($query);
		$numresult = mysql_num_rows($result);
		$j = 0;
		while ($row = mysql_fetch_object($result)){
			$noauth_catidtext[$j] = $row->categoryname;
			$j++;
		}
	}
	
	$articles->listarticles($catidtext, $catidid, $num, $title, $sid, $topid, $date, $counter, $author, $noauth_catidtext, $popup);
}

function show ($articles, $database, $dbprefix, $artid, $gid, $db) {
	
	$query = "SELECT title, content, author FROM ".$dbprefix."articles, ".$dbprefix."categories WHERE artid=$artid AND ".$dbprefix."articles.published=1 AND ".$dbprefix."categories.categoryid=".$dbprefix."articles.catid AND ".$dbprefix."categories.access <=$gid";
	$result = $database->openConnectionWithReturn($query);
	$count = mysql_num_rows($result);
	if ($count==0){
		echo _NOT_VALID;
	} else {
		while ($row = mysql_fetch_object($result)){
			$title = $row->title;
			$author = $row->author;
			$content = $row->content;
		}
		$query = "UPDATE ".$dbprefix."articles SET counter=counter+1 WHERE artid=$artid";
		$database->openConnectionNoReturn($query);
		$articles->showarticles($title, $author, $content, $artid);
	}
}
?>
