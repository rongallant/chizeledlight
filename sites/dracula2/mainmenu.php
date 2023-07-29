<?php 
/**
*  Mambo Open Source Version 4.0.12
*  Dynamic portal server and Content managment engine
*  20-01-2003
*
*  Copyright (C) 2000 - 2003 Miro International Pty Ltd
*  Distributed under the terms of the GNU General Public License
*  This software may be used without warranty provided these statements are left
*  intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*  This code is available at http://sourceforge.net/projects/mambo
*
*  Site Name: Mambo Open Source Version 4.0.12
*  File Name: mainmenu.php
*  Original Original Developers: Danny Younes - danny@miro.com.au
*                       Nicole Anderson - nicole@miro.com.au
*  Date: 03/02/2003
*  Version #: 4.0.12
*  Comments:
**/

function printMenu($sublevel, $componentid, $hierarchyTree, $gid, $dbprefix) {
	global $database;
	if ($gid==-1){
		$sql = "select id, name, link, contenttype, browserNav from ".$dbprefix."menu where componentid='$componentid' and menutype='mainmenu' and inuse='1' order by ordering";
	} else {
		$sql = "select id, name, link, contenttype, browserNav from ".$dbprefix."menu where componentid='$componentid' and menutype='mainmenu' and inuse='1' AND access<='$gid' order by ordering";
	}
	$res = $database->openConnectionWithReturn($sql);
	$count = mysql_num_rows($res);
	$j=0;
	while (list($id, $name, $link, $contenttype, $browserNav) = mysql_fetch_array($res)) {
		for($i=0;$i<$sublevel-2;$i++)
		echo "&nbsp;&nbsp;";
		if ($sublevel!=2)
		echo "&nbsp;<img src=images/M_images/arrow.gif>&nbsp;";
		else
		echo "<li>";
		
		if ($contenttype=="mambo") {
			if ($link=="index.php")	{
				echo "<a class=mainmenu href='$link?Itemid=$id'>$name</a><br>";
			} else {
				echo "<a class=mainmenu href='$link&Itemid=$id'>$name</a><br>";
			}
		}
		else if ($contenttype=="web") {
			$correctLink = eregi("http://", $link);
			if ($correctLink!=1) {
				$link="http://$link";
			}
			if ($browserNav==1) {
				echo "<a class=mainmenu href='$link' target=_window>$name</a><br>";
			} else if ($browserNav==2) {
				echo "<a class=mainmenu href='$link'>$name</a><br>";
			} else {
				echo "<a class=mainmenu href=\"#\" onClick=\"javascript: window.open('$link', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');\">$name</a><br>";
			}
		} else if ($contenttype=="file") {
			echo "<a class=mainmenu href='index.php?option=displaypage&Itemid=$id&op=file&SubMenu=$SubMenu'>$name</a><br>";
		} else if ($contenttype=="typed") {
			echo "<a class=mainmenu href='index.php?option=displaypage&Itemid=$id&op=page&SubMenu=$SubMenu'>$name</a><br>";
		}
		
		if ($id == $hierarchyTree[$sublevel])
		printMenu($sublevel+1, $id, $hierarchyTree, $gid, $dbprefix);
		$j++;
	}
}

$hierarchyTree = Array();

if (isset($Itemid)) {
	array_push($hierarchyTree, $Itemid);
	$sql = "select sublevel, componentid from ".$dbprefix."menu where id='$Itemid'";
	$res = $database->openConnectionWithReturn($sql);
	list($sublevel, $componentid)=mysql_fetch_array($res);
} else {
	$componentid = 0;
	$sublevel = 0;
}

array_push($hierarchyTree, $componentid);
if (isset($sublevel)) {
if ($sublevel>=0) {
	for ($i=$sublevel;$i>=0;$i--) {
		$sql = "select componentid from ".$dbprefix."menu where id='$componentid'";
		$res = $database->openConnectionWithReturn($sql);
		list($componentid)=mysql_fetch_array($res);
		array_push($hierarchyTree, $componentid);
	}
}
}

$hierarchyTree = array_reverse($hierarchyTree);

if ($shownoauth) {
	$gid = -1;
} else {
	include_once ("includes/accesscheck.php");
	$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);
}

printMenu(2, 0, $hierarchyTree, $gid, $dbprefix);
?>
