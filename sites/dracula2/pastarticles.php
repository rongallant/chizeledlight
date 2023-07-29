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
*	File Name: pastarticles.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Search for past articles.
**/

require("classes/html/pastarticles.php");
$pastarticles = new pastarticles();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

switch($task){
	case "search":
	returnSearch($option, $search, $days, $pastarticles, $type, $database, $dbprefix, $gid, $db, $popup);
	break;
	default:
	viewArchivePage($option, $pastarticles, $type);
	break;
}


function viewArchivePage($option, $pastarticles, $type){
	$pastarticles->searchArchiveForm($option, $search, $days, $type);
}

function returnSearch($option, $search, $days, $pastarticles, $type, $database, $dbprefix, $gid, $db, $popup){
	if ($type=="News"){
		
		if ($days!=0 && (isset($search))){
			$query = "select ".$dbprefix."stories.* from ".$dbprefix."stories, ".$dbprefix."categories where archived='1' AND TO_DAYS(NOW()) - TO_DAYS(time) <= $days AND title LIKE '%$search%' AND ". $dbprefix."categories.access <=$gid AND ".$dbprefix."categories.categoryid = ".$dbprefix."stories.catid";
		}
		elseif ((isset($search)) && ($days == 0)) {
			$query= "select ".$dbprefix."stories.* from ".$dbprefix."stories, ".$dbprefix."categories where archived='1' AND title LIKE '%$search%' AND ". $dbprefix."categories.access <=$gid AND ".$dbprefix."categories.categoryid = ".$dbprefix."stories.catid";
		}
		elseif (($search == "") && ($days > 0)) {
			$query = "select ".$dbprefix."stories.* from ".$dbprefix."stories, ".$dbprefix."categories where archived='1' AND TO_DAYS(NOW()) - TO_DAYS(time) <= $days AND ". $dbprefix."categories.access <=$gid AND ".$dbprefix."categories.categoryid = ".$dbprefix."stories.catid";
		}
		
	}else if ($type=="Articles"){
		
		if ($days!=0 && (trim($search)!="")){
			$query = "select artid, title, date from ".$dbprefix."articles,".$dbprefix."categories WHERE archived='1' AND TO_DAYS(NOW()) - TO_DAYS(date) <= $days AND title LIKE '%$search%' AND ". $dbprefix."categories.access <=$gid AND ".$dbprefix."categories.categoryid = ".$dbprefix."articles.catid";;
		}
		elseif ((isset($search)) && ($days == 0)) {
			$query= "select artid, title, date from ".$dbprefix."articles,".$dbprefix."categories WHERE archived='1' AND title LIKE '%$search%' AND ". $dbprefix."categories.access <=$gid AND ".$dbprefix."categories.categoryid = ".$dbprefix."articles.catid";
		}
		elseif (($search == "") && ($days > 0)) {
			$query = "select artid, title, date from ".$dbprefix."articles,".$dbprefix."categories WHERE archived='1' AND TO_DAYS(NOW()) - TO_DAYS(date) <= $days AND ". $dbprefix."categories.access <=$gid AND ".$dbprefix."categories.categoryid = ".$dbprefix."articles.catid";
		}
	}
	
	$result=$database->openConnectionWithReturn($query);
	$length = mysql_num_rows($result);
	
	if ($length<>0) {
		display_query($length, $result, $pastarticles, $option, $search, $days, $type, $popup);
	} else {
		$pastarticles->searchArchiveForm($option, $search, $days, $type);
		$pastarticles->displaySearchResults($sid, $title, $date2, $option, $length, $type, $popup);
	}
}

function display_query($length, $result, $pastarticles, $option, $search, $days, $type, $popup){
	$pastarticles->searchArchiveForm($option, $search, $days, $type);
	if ($type=="News"){
		for ($i=0; $i < mysql_num_rows($result); $i++){
			$row=mysql_fetch_object($result);
			$sid[$i]=$row->sid;
			$title[$i]=$row->title;
			$date[$i]=$row->time;
			$articledate = split(" ", $date[$i]);
			$date3 = $articledate[0];
			list ($year,$month, $day) = split ('[/.-]', $date3);
			$date3 = date ("M d Y", mktime (0,0,0,$month,$day,$year));
			$date2[$i]=$date3;
		}
	}else if ($type=="Articles"){
		for ($i=0; $i < mysql_num_rows($result); $i++){
			$row=mysql_fetch_object($result);
			$sid[$i]=$row->artid;
			$title[$i]=$row->title;
			$date[$i]=$row->date;
			list ($year,$month, $day) = split ('[/.-]', $date[$i]);
			$date3 = date ("M d Y", mktime (0,0,0,$month,$day,$year));
			$date2[$i]=$date3;
		}
	}
	
	mysql_free_result($result);
	$pastarticles->displaySearchResults($sid, $title, $date2, $option, $length, $type, $popup);
}
?>