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
*	File Name: usermenu.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 03-02-2003
* 	Version #: 4.0.12
*	Comments: Display user menu once logged in.
**/

include("configuration.php");
include('language/'.$lang.'/lang_usermenu.php');
include("regglobals.php");

if ($usermenuhtml==""){
	require ("classes/html/usermenu.php");
	$usermenuhtml = new HTML_usermenu();
}

if ($database==""){
	require("classes/database.php");
	$database = new database();
}

switch($op2){
	case "login":
	checkLogin($op2, $username, $passwd, $database, $dbprefix, $usermenuhtml, $option, $HTTP_COOKIE_VARS);
	break;
	case "CorrectLogin":
	showMenu($usermenuhtml, $database, $dbprefix, $uid, $option);
	break;
	case "showMenuComponent":
	showMenuComponent($usermenuhtml, $database, $dbprefix, $uid, $option);
	break;
}

function checkLogin($op2, $username, $passwd, $database, $dbprefix, $usermenuhtml, $option, $HTTP_COOKIE_VARS){
	if ((trim($username)=="") || (trim($passwd)=="")){
		echo "<SCRIPT> alert(\""._LOGIN_INCOMPLETE."\"); window.history.go(-1); </SCRIPT>\n";
	}else{
		$passwd=md5($passwd);
		$query="select id, gid, block, usertype from ".$dbprefix."users where username='$username' and password='$passwd'";

		$result=$database->openConnectionWithReturn($query);
		if (mysql_num_rows($result)!=0){
			list($uid, $gid, $block, $usertype)=mysql_fetch_array($result);
			if ($block==1){
				echo "<SCRIPT>alert(\""._LOGIN_BLOCKED."\"); window.history.go(-1); </SCRIPT>\n";
			}else{
				if ($HTTP_COOKIE_VARS["sessioncookie"]!=""){
					$sessionID=$HTTP_COOKIE_VARS["sessioncookie"];
					$cryptSessionID=md5($sessionID);
					$query="UPDATE ".$dbprefix."session SET guest=0, username='$username', userid='$uid', usertype='$usertype' , gid='$gid' WHERE session_id='$cryptSessionID'";
					$database->openConnectionWithReturn($query);
				}else{
					$existSessionID=0;
					while ($existSessionID==0){
						$sessionID=getSessionID();
						if ($sessionID!=""){
							$cryptSessionID=md5($sessionID);
							$query="SELECT session_id FROM ".$dbprefix."session where session_id='$cryptSessionID'";
							$result=$database->openConnectionWithReturn($query);
							if (mysql_num_rows($result)==0){
								$existSessionID=1;
							}
						}
					}
					/*
					if ($existSessionID==1){
						$query="INSERT into ".$dbprefix."session set session_id='$cryptSessionID', guest='', userid='$uid', usertype='$usertype', gid='$gid', username='$username'";
						$database->openConnectionNoReturn($query);

						setcookie("sessioncookie", "$sessionID");
						$sessioncookie=$sessionID;
					}
					*/
				}

				$option="user";
				$lifetime= (time() + 43200);
				setcookie("usercookie", "$sessionID");
				$usercookie=$sessionID;
				print "<SCRIPT>document.location.href='index.php?option=$option'</SCRIPT>\n";
			}
		}else{
			echo "<SCRIPT>alert(\""._LOGIN_INCORRECT."\"); window.history.go(-1); </SCRIPT>\n";
		}
	}
}

function showMenu($usermenuhtml, $database, $dbprefix, $option){
	print "<SCRIPT>document.location.href='index.php?option=$option'</SCRIPT>\n";
}

function showMenuComponent($usermenuhtml, $database, $dbprefix, $uid, $option){
	$query="select name from ".$dbprefix."users where id='$uid'";
	$result=$database->openConnectionWithReturn($query);
	list($uName)=mysql_fetch_array($result);
	$query2="select id, name, link from ".$dbprefix."menu where menutype='usermenu' order by ordering";
	$result2=$database->openConnectionWithReturn($query2);
	$i=0;
	while (list($id[$i], $name[$i], $link[$i])=mysql_fetch_array($result2)){
		$i++;
	}
	$usermenuhtml->showMenuComponent($uName, $uid, $id, $name, $link, $option);
}

function getSessionID(){
	mt_srand ((double) microtime() * 1000000);
	$pass_len = mt_rand (20,40);
	$allchar = "abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789";
	$str = "" ;
	for ( $i = 0; $i<$pass_len ; $i++ ){
		$str .= substr( $allchar, mt_rand (0,62), 1 ) ;
	}
	$timestamp= time();
	$str=$str.$timestamp;
	return($str);
}
?>