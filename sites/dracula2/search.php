<?php 
/**
*	Mambo Open Source Version 4.0.12
*	Dynamic portal server and Content managment engine
*	01-11-2002
*
*	Copyright (C) 2000 - 2003 Miro International Pty. Limited
*	Distributed under the terms of the GNU General Public License
*	This software may be used without warranty provided these statements are left
*	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*	This code is Available at http://sourceforge.net/projects/mambo
*
*	Site Name: Mambo Open Source Version 4.0.12
*	File Name: search.php
*	Original Developers: Emir Sakic - saka@hotmail.com
*	Date: 07-02-2003
* 	Version #: 4.0.12
*	Comments: Search stories, articles, faqs and content for user input.
**/

require ("classes/html/search.php");
$search = new search();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

$search->openhtml();
if ($searchword==""||$searchword==" ") {
	$search->nokeyword();
} else {
	$searchword = str_replace ('<', '&lt;', $searchword);
	$searchword = str_replace ('>', '&gt;', $searchword);
	$search->searchintro($searchword);
	
	$totalRows = 0;
	$result = mysql_query ("SELECT sid, title, time, catid, introtext FROM ".$dbprefix."stories, ".$dbprefix."categories WHERE ((title LIKE '%$searchword%' OR introtext LIKE '%$searchword%' OR fultext LIKE '%$searchword%') AND ".$dbprefix."stories.published=1  AND ".$dbprefix."categories.categoryid=catid AND ". $dbprefix."categories.access <=$gid) ORDER BY time DESC");
	$i = 0;
	$id = array();
	$title = array();
	$time = array();
	$text = array();
	
	while ($row = mysql_fetch_object($result)){
		$id[$i] = $row->sid;
		$title[$i] = $row->title;
		$time[$i] = $row->time;
		$text[$i] = $row->introtext;
		$i++;
	}
	
	mysql_free_result($result);
	$totalRows = ($totalRows + count($id));
	$search->stories($id, $title, $time, $text, $searchword, $popup);
	
	$result = mysql_query ("SELECT artid, title, catid, content, date FROM ".$dbprefix."articles, ".$dbprefix."categories WHERE ((title LIKE '%$searchword%' OR content LIKE '%$searchword%') AND ".$dbprefix."articles.published=1 AND ".$dbprefix."categories.categoryid=catid AND ". $dbprefix."categories.access <=$gid) ORDER BY date DESC");
	$i = 0;
	$id = array();
	$title = array();
	$text = array();
	$date = array();
	while ($row = mysql_fetch_object($result)){
		$id[$i] = $row->artid;
		$title[$i] = $row->title;
		$time[$i] = $row->date;
		$text[$i] = $row->content;
		$i++;
	}
	mysql_free_result($result);
	
	$totalRows = ($totalRows + count($id));
	$search->articles($id, $title, $time, $text, $searchword, $popup);
	
	$result = mysql_query ("SELECT artid, title, catid, content FROM ".$dbprefix."faqcont, ".$dbprefix."categories WHERE ((title LIKE '%$searchword%' OR content LIKE '%$searchword%') AND ".$dbprefix."faqcont.published=1  AND ".$dbprefix."categories.categoryid=catid AND ". $dbprefix."categories.access <=$gid)");
	$i = 0;
	$title = array();
	$text = array();
	$id = array();
	
	while ($row = mysql_fetch_object($result)){
		$id[$i] = $row->artid;
		$title[$i] = $row->title;
		$text[$i] = $row->content;
		$i++;
	}
	mysql_free_result($result);
	
	$totalRows = ($totalRows + count($id));
	$search->faqs($id, $title, $text, $searchword, $popup);
	
	$result = mysql_query ("SELECT mcid, menuid, content, heading FROM ".$dbprefix."menucontent WHERE (content LIKE '%$searchword%' OR heading LIKE '%$searchword%')");
	$i = 0;
	$content = array();
	$heading = array();
	$id = array();
	$mid = array();
	$sublevel = array();
	
	while ($row = mysql_fetch_object($result)){
		$id[$i] = $row->mcid;
		$mid[$i] = $row->menuid;
		$content[$i] = $row->content;
		$heading[$i] = $row->heading;
		$mresult = mysql_query ("SELECT inuse, sublevel FROM ".$dbprefix."menu WHERE id='$mid[$i]'");
		$row2 = mysql_fetch_object($mresult);
		$inuse = $row2->inuse;
		$sublevel[$i] = $row2->sublevel;
		if ($inuse != 0) $i++;
	}
	
	mysql_free_result($result);
	$totalRows = ($totalRows + count($id));
	$search->content($id, $mid, $heading, $content, $sublevel, $searchword);
	
	$result = mysql_query ("SELECT title, url, description, published, approved FROM ".$dbprefix."links WHERE ((title LIKE '%$searchword%' OR description LIKE '%$searchword%') AND published=1 AND approved=1)");
	$i = 0;
	$title = array();
	$url = array();
	$description = array();
	
	while ($row = mysql_fetch_object($result)){
		$title[$i] = $row->title;
		$url[$i] = $row->url;
		$description[$i] = $row->description;
		$i++;
	}
	mysql_free_result($result);
	$totalRows = ($totalRows + count($title));
	$search->weblinks($title, $url, $description, $searchword);
	
	$search->conclusion($totalRows, $searchword);
	
}
$search->closehtml();
?>
