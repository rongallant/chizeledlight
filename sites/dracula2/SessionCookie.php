<?php
/**
*      Mambo Open Source Version 4.0.12
*      Dynamic portal server and Content managment engine
*      03-02-2003
*
*      Copyright (C) 2000 - 2003 Miro International Pty. Limited
*      Distributed under the terms of the GNU General Public License
*      This software may be used without warranty provided these statements are left
*      intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*      This code is Available at http://sourceforge.net/projects/mambo
*
*      Site Name: Mambo Open Source Version 4.0.12
*      File Name: SessionCookie.php
*      Original Developers: Danny Younes - danny@miro.com.au
*                              Nicole Anderson - nicole@miro.com.au
*      Date: 03-02-2003
*      Version #: 4.0.12
*      Comments: Determine who is online, registered users and guests.
**/

$past = time()-1800;
$query="DELETE FROM ".$dbprefix."session WHERE (time < $past)";
$database->openConnectionNoReturn($query);
$current_time = time();
if ($HTTP_COOKIE_VARS["sessioncookie"]==""){
	while (true){
		$randnum=getSessionID1();
		if ($randnum!=""){
			$cryptrandnum=md5($randnum);
			$query="SELECT session_id FROM ".$dbprefix."session where session_id='$cryptrandnum'";
			$result=$database->openConnectionWithReturn($query);
			if (mysql_num_rows($result)==0){
				break;
			}
		}
	}
	$lifetime = (time() + 43200);
	setcookie("sessioncookie", "$randnum");
	$guest=1;
	$query="INSERT into ".$dbprefix."session SET username='', time=$current_time, session_id='$cryptrandnum', guest=$guest";
	$database->openConnectionNoReturn($query);
} else {
	$cryptSessionCookie=md5($HTTP_COOKIE_VARS["sessioncookie"]);
	if ($option=="logout"){
		$query="UPDATE ".$dbprefix."session SET guest=1, username='', userid='', usertype='', gid='' where session_id='$cryptSessionCookie'";
		$database->openConnectionNoReturn($query);
	} else {
		$query = "SELECT username FROM ".$dbprefix."session WHERE session_id='$cryptSessionCookie'";
		$result=$database->openConnectionWithReturn($query);
		if (mysql_num_rows($result)> 0){
			list ($username)=mysql_fetch_array($result);
			if ($username!=""){
				$sessionID=$HTTP_COOKIE_VARS["sessioncookie"];
				setcookie("usercookie", "$sessionID");
				$HTTP_COOKIE_VARS["usercookie"]=$sessionID;
			}
			$query="UPDATE ".$dbprefix."session SET username='$username', time=$current_time WHERE session_id='$cryptSessionCookie'";
			$database->openConnectionNoReturn($query);
		} else {
			$option=="";
			while (true){
				$randnum=getSessionID1();
				if ($randnum!=""){
					$cryptrandnum=md5($randnum);
					$query="SELECT session_id FROM ".$dbprefix."session where session_id='$cryptrandnum'";
					$result=$database->openConnectionWithReturn($query);
					if (mysql_num_rows($result)==0){
						break;
					}
				}
			}
			$lifetime = (time() + 43200);
			setcookie("sessioncookie", "$randnum");
			$guest=1;
			$query="INSERT into ".$dbprefix."session SET username='', time=$current_time, session_id='$cryptrandnum', guest=$guest";
			$database->openConnectionNoReturn($query);
		}
	}
}

function getSessionID1(){
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
