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
*	File Name: banners.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: View banners and redirection to correct banner url.
**/
include ("configuration.php");
include ("regglobals.php");

switch($op) {
	case "click":
	clickbanner($bid, $database, $dbprefix);
	break;
	default:
	viewbanner($database, $dbprefix);
}

function viewbanner($database, $dbprefix){

	$query="select count(*) AS numrows from ".$dbprefix."banner where showBanner=1";
	$numrows = mysql_result(mysql_query($query), 0, "numrows");
	if ($numrows>1) {
		$numrows = $numrows-1;
		mt_srand((double)microtime()*1000000);
		$bannum = mt_rand(0, $numrows);
	} else {
		$bannum = 0;
	}
	$query="select bid, cid, imptotal, impmade, clicks, date, type, name, imageurl from ".$dbprefix."banner where showBanner=1 limit $bannum,1";
	$result=$database->openConnectionWithReturn($query);

	if (mysql_num_rows($result)!=0){
		list($bid, $cid, $imptotal, $impmande, $clicks, $date, $type, $name, $imageurl) = mysql_fetch_row($result);
		$query="update ".$dbprefix."banner set impmade=impmade+1 where bid=$bid";
		$database->openConnectionNoReturn($query);
		if($numrows>0) {
			// Check if this impression is the last one and print the banner
			if($imptotal==$impmade) {
				$query="insert into ".$dbprefix."bannerfinish (cid, type, name, impressions, clicks, imageurl, datestart, dateend) values ('$cid', '$type', '$name', '$impmade', '$clicks', '$imageurl', '$date', now())";
				$database->openConnectionNoReturn($query);
				$query="delete from ".$dbprefix."banner where bid=$bid";
				$database->openConnectionNoReturn($query);
			}
			if ((eregi(".gif", $imageurl)) || (eregi(".jpg", $imageurl))){
				$imageurl="images/banners/$imageurl";
				echo"<a href=banners.php?op=click&bid=$bid><img src=$imageurl border=\"0\" VSPACE=\"5\" WIDTH=\"468\" HEIGHT=\"60\" ALT='Advertisement'></a>";
			}else if (eregi(".swf", $imageurl)){
				$imageurl="images/banners/$imageurl";
				echo "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0\" height=\"50\" border=\"5\" VSPACE=\"5\">
						<param name=\"SRC\" value=\"$imageurl\"><embed src=\"$imageurl\" loop=\"false\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" height=\"50\">
 						</object>
				</a>";
			}
		}
	}else{
		echo "&nbsp;";
	}
}

/********************************************/
/* Function to redirect the clicks to the   */
/* correct url and add 1 click              */
/********************************************/
function clickbanner($bid, $database, $dbprefix){
	if ($database==""){
		require("classes/database.php");
		$database = new database();
	}
	$query="select clickurl from ".$dbprefix."banner where bid=$bid";
	$result=$database->openConnectionWithReturn($query);
	list($clickurl) = mysql_fetch_row($result);
	$query="update ".$dbprefix."banner set clicks=clicks+1 where bid=$bid";
	$database->openConnectionNoReturn($query);
	$pat="http://";
	if (!eregi($pat, $clickurl)){
		$clickurl="http://".$clickurl;
	}
	echo "<script> window.open('$clickurl', 'newwin'); void(0); window.history.go(-1);</script>";

}?>