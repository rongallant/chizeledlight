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
*	File Name: faq.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: The function listing retrieves all faq categories and titles from the database.
**/

include('language/'.$lang.'/lang_faq.php');

require ("classes/html/faq.php");
$faq = new faq();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

switch($task) {
	case "viewfaq":
	show($faq, $database, $dbprefix, $artid, $gid, $db);
	break;
	default:
	listfaq($faq, $database, $dbprefix, $topid, $gid, $shownoauth, $popup);
	break;
}

function listfaq($faq, $database, $dbprefix, $topid, $gid, $shownoauth){
	$query = "SELECT categoryid, categoryname FROM ".$dbprefix."categories where section='Faq' and published=1 AND access<='$gid' ORDER BY categoryname";
	$result = $database->openConnectionWithReturn($query);
	$j = 0;
	while ($row = mysql_fetch_object($result)){
		$catidtext[$j] = $row->categoryname;
		$catidid[$j] = $row->categoryid;
		$query1 = "SELECT artid, title, counter FROM ".$dbprefix."faqcont WHERE catid='$row->categoryid' and published=1 and archived=0 ORDER BY ordering";
		$result1 = $database->openConnectionWithReturn($query1);
		$num[$j] = mysql_num_rows($result1);
		if ($topid <> ""){
			$i=0;
			if (mysql_num_rows($result1)<> 0){
				while ($row2 = mysql_fetch_object($result1)){
					$sid[$row->categoryname][$i] = $row2->artid;
					$title[$row->categoryname][$i] = $row2->title;
					$counter[$row->categoryname][$i] = $row2->counter;
					$i++;
				}
			}
		}
		$j++;
	}
	
	if ($shownoauth){
		$query = "SELECT categoryid, categoryname from ".$dbprefix."categories where section='Faq' and published=1 AND access>'$gid' ORDER BY categoryname";
		$result = $database->openConnectionWithReturn($query);
		$numresult = mysql_num_rows($result);
		$j = 0;
		while ($row = mysql_fetch_object($result)){
			$noauth_catidtext[$j] = $row->categoryname;
			$j++;
		}
	}
	
	$faq->faqlist($catidtext, $catidid, $num, $title, $sid, $topid, $counter, $noauth_catidtext, $popup);
}
function show ($faq, $database, $dbprefix, $artid, $gid, $db) {
	
	$query = "SELECT title, content FROM ".$dbprefix."faqcont, ".$dbprefix."categories WHERE ".$dbprefix."faqcont.published=1 AND artid=$artid AND ".$dbprefix."categories.categoryid=".$dbprefix."faqcont.catid AND ".$dbprefix."categories.access <=$gid";
	
	$result = $database->openConnectionWithReturn($query);
	$count = mysql_num_rows($result);
	if ($count==0){
		echo _NOT_VALID;
	} else {
		while ($row = mysql_fetch_object($result)){
			$title = $row->title;
			$content = $row->content;
		}
		$query = "UPDATE ".$dbprefix."faqcont SET counter=counter+1 WHERE artid=$artid";
		$database->openConnectionNoReturn($query);
		$faq->showfaqs($title, $content, $artid);
	}
}
?>