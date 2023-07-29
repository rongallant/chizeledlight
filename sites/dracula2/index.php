<?php 
/**
*  Mambo Open Source Version 4.0.13
*  Dynamic portal server and Content managment engine
*  20-01-2003
*
*  Copyright (C) 2000 - 2003 Miro International Pty Ltd
*  Distributed under the terms of the GNU General Public License
*  This software may be used without warranty provided these statements are left
*  intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*  This code is available at http://sourceforge.net/projects/mambo
*
*  Site Name: Mambo Open Source Version 4.0.13
*  File Name: index.php
*  Original Original Developers: Danny Younes - danny@miro.com.au
*             	   Nicole Anderson - nicole@miro.com.au
*  Date: 31/10/2001
*  Version #: 4.0.13
*  Comments:
**/

//  Start TIMER
//  -----------
$stimer =explode (' ' ,microtime () );
$stimer =$stimer [1] + $stimer [0];
//  -----------

include ("regglobals.php");
include ("configuration.php");
if ($lang=='') $lang='eng';

require ("classes/database.php");
$database = new database();

include_once ("includes/accesscheck.php");
$gid = checkaccess($HTTP_COOKIE_VARS["usercookie"], $db, $dbprefix);

$query = "SELECT id, title, module, position FROM ".$dbprefix."components WHERE publish='1' AND access<='$gid' ORDER BY ordering";

$result = $database->openConnectionWithReturn($query);
while ($row = mysql_fetch_object($result)){
	$components_array[] = array('id' => $row->id,
	'title' => $row->title,
	'module' => $row->module,
	'position' => $row->position);
}

require ("classes/html/components.php");
$components = new components();

$query2 = "select cur_theme,col_main from ".$dbprefix."system where id=0";
$result2 = $database->openConnectionWithReturn($query2);
list ($cur_theme,$col_main)=mysql_fetch_array($result2);
include ("themes/$cur_theme.php");


//  End TIMER
//  ---------
$etimer =explode (' ' ,microtime () );
$etimer =$etimer [1] + $etimer [0];
//echo ("<div align='center'>");
//printf ("<span class='smalldark'>Page Rendered in: <b>%f</b> seconds.</span>" , ( $etimer -$stimer ));
//echo ("</div>");
//  ---------
?>
