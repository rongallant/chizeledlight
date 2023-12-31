<?php
/*
setup_mysql.php : mySQL calls list for miniBB.
Copyright (C) 2001-2002 miniBB.net.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function getByDay($prefix,$table,$field){
global $days;
if($table!='') $table.='.';
$xtr2="{$prefix} TO_DAYS(now())-TO_DAYS({$table}{$field})<{$days}";
return $xtr2;
}

function addToTable($cook, $db, $dbprefix, $Tu){
/*MAMBO - Create User in Forum Table*/
    $uinfo[0] = 0;
		$uinfo[1] = "";
	if ($cook<>""){
		//Get UserID
		$cryptSessionID=md5($cook);
  	$queryg = "SELECT userid,username FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
		$resultg = mysql_db_query($db, $queryg) or die("Did not execute query");
		while ($rowg = mysql_fetch_object($resultg)){
			$uinfo[0] = $rowg->userid;
			$uinfo[1] = $rowg->username;
		}
    //Check if already in Forum Table
    if ($uinfo[0]>0){
		  $queryc = "SELECT user_id FROM $Tu WHERE user_id=$uinfo[0]";
      $resultc = mysql_query($queryc);
		  If ($resultc) {
        $count = mysql_num_rows($resultc);
		  } else {
		    $count=0;
		  }
		  if ($count==0){
        $result = mysql_query("INSERT into $Tu (user_id, username) values ($uinfo[0], '$uinfo[1]')");
        $row=mysql_insert_id();
	    }
		}
	}
	return $uinfo;
}

function getClForums($closedForums,$more,$prefix,$field,$syntax,$condition){
$xtr=$more;
if($prefix!='') $prefix=$prefix.'.';
$siz=sizeof($closedForums);
foreach($closedForums as $c) {
$xtr.=" {$prefix}{$field}{$condition}$c";
$siz--;
if ($siz!=0) $xtr.=" $syntax";
}
return $xtr;
}

function DB_query ($n, $sus) {
global $result, $reslt, $mini_user_usr, $topic, $forum, $makeLim, $viewlastdiscussions, $extra;
global $Tf,$Tp,$Tt,$Ts,$Tb,$Tu,$Mu;
global $closedForums;

if($n==89){
global $thisIp, $thisIpMask;
$res = mysql_query("select id from $Tb where banip='{$thisIp}' or banip='{$thisIpMask[0]}' or banip='{$thisIpMask[1]}'");
if ($res) $row=mysql_fetch_row($res);
}

elseif($n==7){
if(!$sus) $result=mysql_query("SELECT poster_id, poster_name, post_time, post_text, poster_ip, post_status, post_id FROM $Tp WHERE topic_id=$topic ORDER BY post_time ASC $makeLim");
$row=mysql_fetch_row($result);
}

elseif($n==10){
if(!$sus) $result=mysql_query("SELECT topic_id, topic_title, topic_poster, topic_poster_name, topic_time, topic_views, topic_status, CASE topic_status WHEN 9 THEN 1 WHEN 8 THEN 1 ELSE 0 END as sticky FROM $Tt WHERE forum_id=$forum ORDER BY sticky DESC,topic_time DESC $makeLim");
if ($result) $row=mysql_fetch_row($result);
}

elseif($n==11){
if(!$sus) $result=mysql_query("SELECT $Tt.topic_id, $Tt.topic_title, $Tt.topic_poster, $Tp.poster_name, $Tp.post_time, $Tt.topic_views, $Tt.topic_status, CASE $Tt.topic_status WHEN 9 THEN 1 WHEN 8 THEN 1 ELSE 0 END as sticky FROM $Tt, $Tp WHERE $Tt.topic_last_post_id=$Tp.post_id AND $Tp.forum_id=$forum ORDER BY sticky DESC,$Tp.post_time DESC $makeLim");
if ($result) $row=mysql_fetch_row($result);
}

elseif($n==5) $row=mysql_fetch_row(mysql_query("SELECT topic_title, topic_status, topic_poster, topic_poster_name, forum_id FROM $Tt WHERE topic_id=$topic"));

elseif($n==6)
$row=mysql_result(mysql_query("SELECT count(topic_id) FROM $Tp WHERE topic_id=$topic"),0);

elseif($n==95){
/*Get forum replies count*/
$row=mysql_result(mysql_query("select count(forum_id) from $Tp where forum_id=$forum"),0);
}

elseif($n==1)
$row=mysql_fetch_row(mysql_query("SELECT username, password FROM $Mu WHERE username='$mini_user_usr' LIMIT 1"));

elseif($n==2)
$row=mysql_fetch_row(mysql_query("SELECT user_id, user_sorttopics FROM $Tu WHERE username='$mini_user_usr'"));

elseif($n==3){
$result=mysql_query("UPDATE $Tt SET topic_views=topic_views+1 WHERE topic_id=$topic");
$row=mysql_affected_rows();
}

elseif($n==14){
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'where','','forum_id','and','!=');
$result=mysql_query("SELECT topic_id, topic_title, topic_poster, topic_poster_name, topic_time, topic_views, forum_id FROM $Tt $xtr ORDER BY topic_time DESC limit $viewlastdiscussions") or die("<center><b>".mysql_error()."</b></center>");
}
if ($result) $row=mysql_fetch_row($result);
}

elseif($n==15){
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'and',$Tp,'forum_id','and','!='); else $xtr='';
$result=mysql_query("SELECT $Tt.topic_id, $Tt.topic_title, $Tt.topic_poster, $Tp.poster_name, $Tp.post_time, $Tt.topic_views, $Tp.forum_id FROM $Tt,$Tp WHERE $Tt.topic_last_post_id=$Tp.post_id $xtr ORDER BY $Tp.post_time DESC limit $viewlastdiscussions");
}
if ($result) $row=mysql_fetch_row($result);
}

elseif($n==16){
if(!$sus) $result=mysql_query("SELECT forum_id, forum_name, forum_desc, forum_icon FROM $Tf ORDER BY forum_order ASC");
$row=mysql_fetch_row($result);
}

elseif($n==8){
if($rslt=mysql_query("SELECT forum_name, forum_id, forum_icon FROM $Tf WHERE forum_id=$forum")) $row=mysql_fetch_row($rslt);
else $row=FALSE;
}

elseif($n==9)
$row=mysql_result(mysql_query("SELECT count(topic_id) FROM $Tt WHERE forum_id=$forum"),0);

elseif($n==4){
global $searchString, $searchString2;
/*Search - Topics & posts*/
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tp,'forum_id','AND','!=');
$xtr2=getByDay('AND',$Tp,'post_time');
$result=mysql_query("SELECT $Tp.post_id, $Tp.forum_id, $Tp.topic_id, $Tp.post_text, $Tp.post_time, $Tt.topic_title, $Tf.forum_name FROM $Tp, $Tt, $Tf WHERE $Tp.topic_id=$Tt.topic_id AND $Tt.forum_id=$Tf.forum_id AND (( $searchString ) OR ( $searchString2 )) $xtr $xtr2 ORDER BY post_time DESC $makeLim");
}
$row=mysql_fetch_row($result);
}

elseif($n==52){
/*Search - Topics only*/
global $searchString;
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tt,'forum_id','AND','!=');
$xtr2=getByDay('AND','','topic_time');
$result=mysql_query("SELECT $Tt.topic_id, $Tt.forum_id, $Tt.topic_title, $Tt.topic_time, $Tf.forum_name FROM $Tt, $Tf WHERE $Tt.forum_id=$Tf.forum_id AND $searchString $xtr $xtr2 ORDER BY $Tt.topic_time DESC $makeLim");
}
$row=mysql_fetch_row($result);
}

elseif($n==57){
/*Search - users in topics & posts*/
global $searchString;
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tp,'forum_id','AND','!=');
$result=mysql_query("SELECT $Tp.post_id, $Tp.forum_id, $Tp.topic_id, $Tp.post_text, $Tp.post_time, $Tt.topic_title, $Tf.forum_name FROM $Tp, $Tt, $Tf WHERE $Tp.topic_id=$Tt.topic_id AND $Tt.forum_id=$Tf.forum_id AND $searchString $xtr ORDER BY post_time DESC $makeLim");
}
$row=mysql_fetch_row($result);
}

elseif($n==78){
global $tmpRslt;
/*Search - this one used in search func. for reverse page redirects only(posts by time)*/
if(!$sus) $tmpRslt=mysql_query("SELECT post_id FROM $Tp WHERE topic_id=$topic ORDER BY post_time ASC");
$row=mysql_fetch_array($tmpRslt);
}

elseif($n==76){
global $tmpRslt;
/*Search - this one used in search func. for reverse page redirects only(topics by time)*/
if(!$sus) $tmpRslt=mysql_query("SELECT topic_id FROM $Tt WHERE forum_id=$forum ORDER BY topic_time DESC");
$row=mysql_fetch_array($tmpRslt);
}

elseif($n==77){
global $tmpRslt;
/*Search - this one used in search func. for reverse page redirects only(topics by new answers)*/
if(!$sus) $tmpRslt=mysql_query("SELECT $Tt.topic_id FROM $Tt, $Tp WHERE $Tt.topic_last_post_id=$Tp.post_id AND $Tt.forum_id=$forum ORDER BY $Tp.post_time DESC");
$row=mysql_fetch_array($tmpRslt);
}

elseif($n==53){
/*Search - numRows topics & posts*/
global $searchString, $searchString2;
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tp,'forum_id','AND','!=');
$xtr2=getByDay('AND',$Tp,'post_time');
$row=mysql_result(mysql_query("SELECT count($Tt.topic_id) FROM $Tp, $Tt WHERE $Tp.topic_id=$Tt.topic_id AND (( $searchString ) OR ( $searchString2 )) $xtr $xtr2 "),0);
}

elseif($n==54){
/*Search - numRows topics only*/
global $searchString;
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tt,'forum_id','AND','!=');
$xtr2=getByDay('AND','','topic_time');
$row=mysql_result(mysql_query("SELECT count(topic_id) FROM $Tt WHERE $searchString $xtr $xtr2 "),0);
}

elseif($n==58){
/*Search - numRows users*/
global $searchString;
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tp,'forum_id','AND','!=');
$row=mysql_result(mysql_query("SELECT count(*) FROM $Tp, $Tt WHERE $Tp.topic_id=$Tt.topic_id AND $searchString $xtr "),0);
}

elseif($n==19)
/*Check if topic and forum ID exist*/
$row=mysql_num_rows(mysql_query("SELECT topic_id FROM $Tt WHERE forum_id=$forum AND topic_id=$topic"));

elseif($n==20){
/* Insert new post and update topics db correspondly*/
global $mini_user_id, $mini_user_usr, $postText, $poster_ip;
$result = mysql_query("INSERT INTO $Tp (forum_id, topic_id, poster_id, poster_name, post_text, post_time, poster_ip, post_status) VALUES ($forum, $topic, $mini_user_id, '$mini_user_usr', '$postText', now(), '$poster_ip', 0)") or die("a1".mysql_error());
$lastID=mysql_insert_id();
$result=mysql_query("UPDATE $Tt set topic_last_post_id=$lastID WHERE topic_id=$topic;");
$row=mysql_affected_rows();
}

elseif($n==22){
/*Insert new topic*/
global $topicTitle, $mini_user_id, $mini_user_usr;
$result=mysql_query("INSERT INTO $Tt VALUES(0,'$topicTitle',$mini_user_id,'$mini_user_usr',now(),0,$forum,0,0)");
$row=mysql_insert_id();
}

elseif($n==23){
/*Delete topic*/
mysql_query("DELETE FROM $Ts WHERE topic_id=$topic");
mysql_query("DELETE FROM $Tt WHERE topic_id=$topic AND forum_id=$forum");
$row=mysql_affected_rows();
}

elseif($n==24){
/*Delete all posts with associated topic*/
$result=mysql_query("DELETE FROM $Tp WHERE topic_id=$topic AND forum_id=$forum");
$row=mysql_affected_rows();
}

elseif($n==25){
/* Getting Topic name or not*/
$rslt = mysql_query("SELECT topic_title FROM $Tt WHERE topic_id=$topic");
$row = mysql_fetch_row($rslt); $row = $row[0];
}

elseif($n==27){
$result=mysql_query("UPDATE $Tt SET topic_status=$sus WHERE topic_id=$topic");
$row=mysql_affected_rows();
}

elseif($n==28){
/*Num forums*/
$res=mysql_query("SELECT count(forum_id) FROM $Tf");
if ($res) $row=mysql_result($res,0); else $row=FALSE;
}

elseif($n==26){
/*Check if topic poster and user_usr are the same*/
global $mini_user_id;
$result=mysql_query("SELECT topic_poster FROM $Tt WHERE topic_id=$topic AND topic_poster=$mini_user_id");
if (mysql_num_rows($result)<=0) $row = FALSE;
else $row=mysql_fetch_row($result);
}

elseif($n==30){
/*Admin - add forum*/
global $forumname, $forumdesc, $forumicon;
$result=mysql_query("insert into $Tf (forum_name, forum_desc, forum_icon) values ('$forumname', '$forumdesc', '$forumicon')");
$used_id=mysql_insert_id();
$result=mysql_query("update $Tf set forum_order=forum_id where forum_id=$used_id");
$row=mysql_affected_rows();
}

elseif($n==31){
/*Admin - edit forum*/
if(!$sus) $result=mysql_query("select * from $Tf order by forum_order, forum_name");
$row=mysql_fetch_array($result);
}

elseif($n==32){
if(!$sus) $result=mysql_query("select * from $Tf order by forum_order");
$row=mysql_fetch_array($result);
}

elseif($n==33){
global $forumID;
if(!$sus) $result=mysql_query("select * from $Tf where forum_id=$forumID");
$row=mysql_fetch_array($result);
}

elseif($n==34){
/*Admin - update forums*/
global $forumname, $forumdesc, $forum_order, $forumicon, $forumID;
$result=mysql_query("update $Tf set forum_name='$forumname', forum_desc='$forumdesc', forum_order='$forum_order', forum_icon='$forumicon' where forum_id=$forumID");
$row=mysql_affected_rows();
}

elseif($n==35){
/*Admin - Deleting forum*/
global $forumID;
mysql_query("DELETE FROM $Tf WHERE forum_id=$forumID");
$row=mysql_affected_rows();
mysql_query("DELETE FROM $Tt WHERE forum_id=$forumID");
$row=$row+mysql_affected_rows();
mysql_query("DELETE FROM $Tp WHERE forum_id=$forumID");
$row=$row+mysql_affected_rows();
if($rrr=mysql_query("select $Tt.topic_id from $Tt,$Ts where $Tt.forum_id=$forumID and $Tt.topic_id=$Ts.topic_id") and mysql_num_rows($rrr)>0 and $row1=mysql_fetch_row($rrr)){
$ord='';
do $ord.="topic_id={$row1[0]} or ";
while($row1=mysql_fetch_row($rrr));
$ord=substr($ord,0,strlen($ord)-4);
mysql_query("DELETE FROM $Ts WHERE $ord");
$row=$row+mysql_affected_rows();
}
}

elseif($n==40){
global $post;
$result = mysql_query("SELECT poster_name FROM $Tp WHERE post_id=$post");
$row=mysql_fetch_row($result);
}

elseif($n==41){
global $post;
$result=mysql_query("DELETE FROM $Tp WHERE post_id=$post");
$row=mysql_affected_rows();
}

elseif($n==42){
/*Check if post has to be deleted is not the first topic*/
global $post, $topic;
$row=mysql_fetch_row(mysql_query("select post_id from $Tp where topic_id=$topic order by post_id ASC limit 1"));
$row = $row[0];
if ($row == $post) $row = TRUE; else $row = FALSE;
}

elseif($n==43){
/*Check if topic isn't locked*/
$row=mysql_fetch_row(mysql_query("select topic_status from $Tt where topic_id=$topic"));
$row=$row[0];
}

elseif($n==44){
/*Check if user is allowed to edit his post*/
global $post, $mini_user_id;
$result = mysql_query("select poster_id from $Tp where post_id=$post and poster_id=$mini_user_id;");
$row=mysql_fetch_row($result);
}

elseif($n==45){
/*Get info about (edit) post text and possible topic title*/
global $post;
$result = mysql_query("select $Tp.post_text, $Tt.topic_title, $Tp.post_time from $Tp,$Tt where $Tp.post_id=$post and $Tp.topic_id=$Tt.topic_id;");
$row=mysql_fetch_row($result);
}

elseif($n==46){
/*Update topic title when editing message*/
global $topic, $postTopic;
$row = mysql_query("update $Tt set topic_title='$postTopic' where topic_id=$topic") or die(mysql_error());
}

elseif($n==47){
/*Check if post wasn't edited by admin or moderator before*/
global $post;
$row = mysql_fetch_row(mysql_query("select post_status from $Tp where post_id=$post"));
$row = $row[0];
}

elseif($n==61){
/*User registration*/
}

elseif($n==62){
/*Check if there is a user with following username and/or email*/
global $mini_userData;
if(!$sus) $result = mysql_query("SELECT $Mu.* from $Mu where $Mu.username='$mini_userData[1]' or $Mu.email='$mini_userData[4]'");
$row=mysql_fetch_row($result);
}

elseif($n==63){
/*Get user data*/
$sus+=0;
$result = mysql_query("SELECT $Tu.*,$Mu.* from $Tu,$Mu where $Tu.user_id=$sus and $Mu.id=$sus");
if (mysql_num_rows($result)>0) { $row = mysql_fetch_array($result); } else $row=FALSE;
}

elseif($n==12){
/*Stats Stuff*/
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'AND','','forum_id','AND','!=');
$xtr2=getByDay('AND','','topic_time');
$result=mysql_query("SELECT topic_id, topic_views, topic_title, forum_id FROM $Tt WHERE topic_views>0 $xtr $xtr2 ORDER BY topic_views DESC , topic_time DESC $makeLim");
echo mysql_error();
}
if ($result) $row=mysql_fetch_row($result);
}

elseif($n==36)
/*Stats Stuff - Num Users*/
$row=mysql_result(mysql_query("SELECT count(user_id) FROM $Tu WHERE user_id>1"),0);

elseif($n==37)
/*Stats Stuff - Num Topics*/
$row=mysql_result(mysql_query("SELECT count(topic_id) FROM $Tt"),0);

elseif($n==38)
/*Stats Stuff - Num Posts*/
$row=mysql_result(mysql_query("SELECT count(post_id) FROM $Tp"),0);

elseif($n==39){
/*Stats Stuff - Num Posts*/
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tt,'forum_id','AND','!=');
$xtr2=getByDay('AND',$Tp,'post_time');
$result=mysql_query("SELECT $Tt.topic_id, $Tt.topic_title, $Tt.forum_id, count($Tp.topic_id) as cnt FROM $Tt, $Tp WHERE $Tt.topic_id=$Tp.topic_id $xtr $xtr2 GROUP BY $Tp.topic_id ORDER BY cnt DESC, $Tt.topic_id DESC $makeLim ");
}
if($result) $row=mysql_fetch_row($result);
}

elseif($n==55){
/*Stats Stuff - most active users*/
if(!$sus) $result=mysql_query("SELECT $Tu.user_id, $Tu.username, count($Tp.poster_id) as cnt FROM $Tu, $Tp WHERE $Tu.user_id>1 AND $Tu.user_id=$Tp.poster_id GROUP BY $Tp.poster_id ORDER BY cnt DESC, $Tu.user_id DESC $makeLim ");
if($result) $row=mysql_fetch_row($result);
}

elseif($n==75){
/*Stats - admin name*/
$row=mysql_result(mysql_query("SELECT username FROM $Mu WHERE usertype='superadministrator'"),0);
}

elseif($n==74)
/*Stats - last registered usr*/
$row=mysql_fetch_row(mysql_query("SELECT user_id, username FROM $Tu ORDER BY user_id DESC LIMIT 1"));

elseif($n==72){
/*User Stats Forums*/
global $mini_userID;
if(!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'AND',$Tf,'forum_id','AND','!=');
$result=mysql_query("SELECT $Tf.forum_id, $Tf.forum_name, count($Tp.forum_id) as cnt FROM $Tf, $Tp WHERE $Tf.forum_id=$Tp.forum_id AND $Tp.poster_id=$mini_userID $xtr GROUP BY $Tp.forum_id ORDER BY cnt DESC, $Tf.forum_order, forum_name");
}
$row=mysql_fetch_array($result);
}

elseif($n==79){
global $poster_ip, $postRange;
/*Anti-Spam*/
if($postRange) $z=mysql_result(mysql_query("SELECT count(post_id) FROM $Tp WHERE poster_ip='$poster_ip' AND now()-post_time<$postRange"),0);
if($z>0) $row=FALSE; else $row=TRUE;
}

elseif($n==64){
/*Deleting user from users table*/
$result = mysql_query("DELETE from $Tu where user_id=$sus");
$row = mysql_affected_rows();
}

elseif($n==65){
/*Deleting user messages from posts and topics table. Topics - delete also all associated posts*/
$prom1 = mysql_query("SELECT topic_id from $Tt where topic_poster='$sus'");
if (mysql_num_rows($prom1)>0) {
$row1=TRUE;
$doit = mysql_fetch_row($prom1);
do {
$topic_id = $doit[0];
$prom2 = mysql_query("DELETE from $Tp where topic_id=$topic_id");
$prom3 = mysql_query("DELETE from $Tt where topic_id=$topic_id");
}
while ($doit = mysql_fetch_row($prom1));
}
/*Topics*/

/*Posts - update also all associated topic_last_post_id's*/
$trm1 = mysql_query("SELECT topic_id from $Tp where poster_id=$sus");
if (mysql_num_rows($trm1)>0) {
$row2=TRUE;
$toWhat = mysql_fetch_row($trm1); 
do {
$topic_id = $toWhat[0];
$res0 = mysql_query("DELETE from $Tp where topic_id=$topic_id and poster_id=$sus");
$res1 = mysql_query("SELECT post_id from $Tp where topic_id={$toWhat[0]} order by post_id DESC limit 1");
if (mysql_num_rows($res1)>0) { $lastID = mysql_fetch_row($res1); $lastID = $lastID[0]; } else $lastID = 0;
$res2 = mysql_query("UPDATE $Tt set topic_last_post_id=$lastID where topic_id={$toWhat[0]}");
}
while ($toWhat = mysql_fetch_row($trm1));
}
/*Posts*/

/*Delete from sendMails*/
$res = mysql_query("delete from $Ts where user_id=$sus");

if ($row1 or $row2) $row = TRUE; else $row = FALSE;
}

elseif($n==48){
/*Update post text*/
global $post, $topic, $postText;
$result = mysql_query("update $Tp set post_text='$postText', post_status='$sus' where post_id=$post and topic_id=$topic");
$row = mysql_affected_rows();
}

elseif($n==50){
/*Update topics DB after deleted post*/
$row=mysql_fetch_row(mysql_query("SELECT post_id from $Tp where topic_id=$topic order by post_id DESC limit 1"));
$row=$row[0];
if($row) $row=mysql_query("UPDATE $Tt set topic_last_post_id=$row where topic_id=$topic");
}

elseif($n==51){
/*Move topic to another forum*/
global $forumWhere;
$row=mysql_fetch_row(mysql_query("SELECT forum_id from $Tf where forum_id=$forum"));
$row=$row[0];
if ($row) {
$row1=mysql_query("UPDATE $Tt set forum_id=$forumWhere where topic_id=$topic and forum_id=$forum");
$row2=mysql_query("UPDATE $Tp set forum_id=$forumWhere where topic_id=$topic and forum_id=$forum");
if ($row1==TRUE and $row2==TRUE) $row = TRUE; else $row=FALSE;
}
}

elseif($n==59){
/*View all posters that are posted under requested IP*/
global $postip;
if (!$sus) $result=mysql_query("SELECT DISTINCT poster_name, poster_id from $Tp where poster_ip like '%{$postip}%'");
$row=mysql_fetch_row($result);
}

elseif($n==60){
/*Check if there is an admin in database, and get all available data about him*/
$result = mysql_query("SELECT $Mu.*,$Tu.* from $Tu,$Mu where $Tu.user_id=1 and $Mu.usertype='superadministrator'");
$row = mysql_fetch_row($result);
}

elseif($n==66){
/*Make user posts as anonymous*/
$result1 = mysql_query("UPDATE $Tp set poster_id=0 where poster_id=$sus");
$result2 = mysql_query("UPDATE $Tt set topic_poster=0 where topic_poster='$sus'");
if ($result1 or $result2) $row = TRUE; else $row = FALSE;
}

elseif($n==67){
/*Check if email exists*/
global $email;
$result = mysql_query("select id from $Mu where email='$email'");
if (mysql_num_rows($result)>0) { $row = mysql_fetch_row($result); $row=$row[0]; } else $row=0;
}

elseif($n==68){
/*Create new user password and accept key*/
}

elseif($n==69){
/*Update confirmed password*/
}

elseif($n==70){
/*Update user prefs*/
global $mini_user_id; 
$mini_userData=$sus;
$result = mysql_query("UPDATE $Mu SET $Mu.email='$mini_userData[email]' WHERE $Mu.id=$mini_user_id");
$row=mysql_affected_rows();
$result = mysql_query("UPDATE $Tu SET $Tu.user_icq='$mini_userData[user_icq]', $Tu.user_website='$mini_userData[user_website]', $Tu.user_occ='$mini_userData[user_occ]', $Tu.user_from='$mini_userData[user_from]', $Tu.user_interest='$mini_userData[user_interest]', $Tu.user_viewemail='$mini_userData[user_viewemail]', $Tu.user_sorttopics='$mini_userData[user_sorttopics]' WHERE $Tu.user_id=$mini_user_id");
$row=mysql_affected_rows()+$row;
}

elseif($n==71){
/*When updating user email, see if no other exists*/
global $mini_user_id, $email1;
$res = mysql_query("select id from $Mu where email='$email1' and id<>'$mini_user_id'");
if (mysql_num_rows($res)>0) $row=1; else $row=0;
}

elseif($n==80){
global $mini_user_id;
if (!$extra) $xtr="user_id={$mini_user_id} and"; else $xtr='';
$rs = mysql_result(mysql_query("SELECT count(*) from $Ts where $xtr topic_id=$topic"),0);
if($rs>0) $row=TRUE; else $row=FALSE;
}

elseif($n==81){
global $mini_user_id, $mini_user_email;
if ($mini_user_email!='') {
$rs = mysql_query("insert into $Ts (user_id, topic_id) values ('$mini_user_id', '$topic')")or die(mysql_error());
$row = mysql_affected_rows();
}
else $row=FALSE;
}

elseif($n==82){
global $delemail;
$sql="delete from $Ts";
if ($delemail!=''){
$rrr=mysql_query("select id from $Mu where email='$delemail'");
if(mysql_num_rows($rrr)>0){
$usid=mysql_fetch_row($rrr); 
$res=mysql_query($sql." where id='{$usid[0]}';");
$row=mysql_affected_rows();
}
else $row=0;
}

else{
$res=mysql_query($sql.';');
$row=mysql_affected_rows();
}

}

elseif($n==83){
/*User mass emailing*/
global $mini_user_id;
if (!$sus) $result = mysql_query("select $Mu.email from $Tu,$Ts,$Mu where $Ts.topic_id=$topic and $Ts.user_id=$Tu.user_id and $Ts.user_id!='{$mini_user_id}' AND $Mu.id=$Tu.user_id");
$row = mysql_fetch_row($result);
}

elseif($n==84){
/*Admin - restore data*/
}

elseif($n==86){
global $banip;
$res = mysql_query("insert into $Tb (banip) values ('$banip')");
$row = mysql_affected_rows();
}

elseif($n==87){
/*Bans - admin panel*/
if (!$sus) $result = mysql_query ("select * from $Tb order by banip");
$row=mysql_fetch_row($result);
}

elseif($n==88){
if (sizeof($sus)>0) {
$xtr=getClForums($sus,'where','','id','or','=');
$res = mysql_query("delete from $Tb $xtr");
$row = mysql_affected_rows();
}
else $row=FALSE;
}

elseif($n==90){
global $mini_user, $viewmaxtopic;
if (!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'and','','forum_id','and','!=');
$result = mysql_query("select topic_id, forum_id, topic_title from $Tt where topic_poster=$mini_user $xtr order by topic_time desc limit $viewmaxtopic");
}
$row = mysql_fetch_row($result);
}

elseif($n==91){
/*Userinfo - last replies */
global $mini_user, $viewmaxtopic;
if (!$sus){
if ($extra==1) $xtr=getClForums($closedForums,'and',$Tp,'forum_id','and','!=');
$result = mysql_query("select distinct $Tp.topic_id, $Tp.forum_id, $Tt.topic_title, max($Tp.post_time) as m from $Tp,$Tt where $Tp.poster_id=$mini_user and $Tp.topic_id=$Tt.topic_id and $Tp.poster_id!=$Tt.topic_poster $xtr group by $Tp.topic_id order by m desc limit $viewmaxtopic");
}
$row = mysql_fetch_row($result);
}

elseif($n==92){
if (!$sus) $result = mysql_query("select $Tu.* from $Tu order by $Tu.user_id $makeLim");
if ($result) $row = mysql_fetch_array($result); else $row=FALSE;
}

elseif($n==93){
/*Get user posts count*/
global $mini_user;
$result = mysql_query("select count(poster_id) from $Tp where poster_id!=0 and poster_id=$mini_user");
if ($result) $row = mysql_fetch_row($result); else $row=FALSE;
}

elseif($n==94){
/*Get user topics count*/
global $mini_user;
$result = mysql_query("select count(topic_poster) from $Tt where topic_poster!=0 and topic_poster=$mini_user");
if ($result) $row = mysql_fetch_row($result); else $row=FALSE;
}

elseif($n==96){
/* Unsubscribe from topic */
global $mini_user_id, $topicU;
$result=mysql_query("delete from $Ts where user_id={$mini_user_id} and topic_id={$topicU}");
$row = mysql_affected_rows();
}

elseif($n==97){
/* Admin - user last post date */
$reslt=mysql_query("select max(post_time) from $Tp where poster_id='$sus'");
if (mysql_num_rows($reslt)>0) $row=mysql_result($reslt,0); else $row=FALSE;
}

elseif($n==98){
/*Admin - users that didnt any post */
if ($extra==1) $what='count(user_id)'; else $what='*';
if (!$sus) $result=mysql_query("select $what from $Tu LEFT JOIN $Tp ON $Tu.user_id=$Tp.poster_id where $Tp.poster_id IS NULL order by $Tu.user_id $makeLim");
$row=mysql_fetch_row($result);
}

elseif($n==99){
/*Admin-dead users*/
global $less;
if (!$sus) $result=mysql_query("select $Tu.user_id,$Tu.username,$Tu.user_regdate,$Mu.password,$Mu.email,max($Tp.post_time) as m from $Tp,$Tu,$Mu where $Tu.user_id=$Tp.poster_id AND $Mu.id=$Tp.poster_id group by $Tp.poster_id having m<'$less' $makeLim");
if($extra==2) $row=mysql_fetch_row($result); else $row=mysql_num_rows($result);
}

elseif($n==100){
/*Admin-view subscriptions*/
if (!$sus) $result=mysql_query("select $Ts.id,$Ts.user_id,$Mu.username,$Mu.email from $Ts,$Tu,$Mu where topic_id='$topic' and $Ts.user_id=$Tu.user_id AND $Mu.id=$Tu.user_id");
$row=mysql_fetch_row($result);
}

elseif($n==101){
/*Admin-delete from subscriptions*/
$xtr=getClForums($closedForums,'where','','id','or','=');
$res = mysql_query("delete from $Ts $xtr");
$row = mysql_affected_rows();
}

elseif($n==102){
/*Get moderators names*/
global $modIds;
$xtr=getClForums($modIds,'where','','user_id','or','=');
if (!$sus) $result=mysql_query("select $Mu.username,$Tu.user_id from $Tu,$Mu $xtr order by user_id asc");
$row=mysql_fetch_row($result);
}

elseif($n==201){
/*Export emails*/
if (!$sus) $result = mysql_query("select $Mu.email, $Tu.username from $Mu, $Tu WHERE $Mu.id=$Tu.user_id order by $Mu.email $makeLim");
if ($result) $row = mysql_fetch_array($result); else $row=FALSE;
}

else $row=FALSE;

return $row;
}

?>