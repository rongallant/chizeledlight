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
*	File Name: news.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: The function listing retrieves all news categories and titles from the database.
**/


include('language/'.$lang.'/lang_news.php');

require ("classes/html/news.php");
$news = new news();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

switch($task) {
	case "viewarticle":
	show($news, $database, $dbprefix, $sid, $gid, $db);
	break;
	default:
	listing($news, $database, $dbprefix, $topid, $gid, $shownoauth, $popup);
	break;
}

function listing($news, $database, $dbprefix, $topid, $gid, $shownoauth, $popup){
	/* Query to retrieve all categories that belong under the news section and that are published. */
	$query = "SELECT categoryname, categoryid FROM ".$dbprefix."categories where section='News' and published=1 AND access<='$gid' ORDER BY categoryname";
	$result = $database->openConnectionWithReturn($query);
	$j = 0;
	while ($row = mysql_fetch_object($result)){		/* Retrieve all category names and id */
	$catidtext[$j] = $row->categoryname;
	$catidid[$j] = $row->categoryid;
	/* Query to retrieve all news titles that belong to the category chosen by the user. */
	$query = "SELECT sid, title, author, time, counter, access FROM ".$dbprefix."stories WHERE catid=$row->categoryid and published=1 and frontpage=0 and archived=0 ORDER BY time DESC";
	$result2 = $database->openConnectionWithReturn($query);
	$num[$j] = mysql_num_rows($result2);
	$i = 0;
	if ($topid <> ""){
		if (mysql_num_rows($result2) <> 0){
			while ($row2 = mysql_fetch_object($result2)){		/* Retrieve all titles. */
			$title[$row->categoryname][$i] = $row2->title;
			$author[$row->categoryname][$i] = $row2->author;
			$sid[$row->categoryname][$i] = $row2->sid;
			$time[$row->categoryname][$i] = $row2->time;
			$counter[$row->categoryname][$i] = $row2->counter;
			$access[$row->categoryname][$i] = $row2->access;
			$i++;
			} /* while */
		} /* if */
	} /* if */
	$j++;
	} /* while */
	
	if ($shownoauth){
		$query = "SELECT categoryid, categoryname from ".$dbprefix."categories where section='News' and published=1 AND access>'$gid' ORDER BY categoryname";
		$result = $database->openConnectionWithReturn($query);
		$numresult = mysql_num_rows($result);
		$j = 0;
		while ($row = mysql_fetch_object($result)){
			$noauth_catidtext[$j] = $row->categoryname;
			$j++;
		}
	}
	$news->newsmaker($catidid, $catidtext, $num, $title, $sid, $topictext, $author, $topid, $time, $counter, $noauth_topictext, $popup, $gid, $access);
} /* listing */

function show($news, $database, $dbprefix, $sid, $gid, $db){
	
	  $query = "SELECT time, title, author, introtext, fultext, newsimage, ".$dbprefix."stories.image_position, ".$dbprefix."stories.access FROM ".$dbprefix."stories, ".$dbprefix."categories WHERE ".$dbprefix."categories.categoryid=".$dbprefix."stories.catid AND ".$dbprefix."stories.published=1 AND ".$dbprefix."stories.access<=$gid AND sid=$sid AND ".$dbprefix."categories.access <=$gid";
	  $result = $database->openConnectionWithReturn($query);
		$count = mysql_num_rows($result);
	  if ($count==0){
		  echo _NOT_VALID;
	  } else {
	    while ($row = mysql_fetch_object($result)){
		    $dbtime = $row->time;
		    $title = $row->title;
		    $author = $row->author;
		    $introtext = $row->introtext;
		    $fultext = $row->fultext;
		    $image = $row->newsimage;
		    $imageposition = $row->image_position;
		    $access = $row->access;
	    }
	
	    $dates = explode("-", $dbtime);
	    $time = strftime ("%d %b %Y", mktime (0,0,0,$dates[1],$dates[2],$dates[0]));
	    $introtext = stripslashes($introtext);
	    $fultext = stripslashes($fultext);
	
	    $query2 = "UPDATE ".$dbprefix."stories SET counter=counter+1 WHERE sid=$sid";
	    $database->openConnectionNoReturn($query2);
	    $news->shownewsmaker($time, $title, $author, $introtext, $fultext, $catid, $image, $sid, $imageposition, $gid, $access);
	}	
}
?>
