<?php
//error_reporting(15);
/*
index.php : basic functions-calling file for miniBB.
Copyright (C) 2001-2002 miniBB.net.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function get_microtime() {
$mtime=microtime();
$mtime=explode(' ',$mtime);
$mtime=$mtime[1] + $mtime[0];
$time_is=$mtime;
return $time_is;
}

$starttime = get_microtime();

if (!get_cfg_var('register_globals')){
if (is_array($HTTP_POST_VARS) and count($HTTP_POST_VARS)>0) foreach($HTTP_POST_VARS as $key=>$ht) { $$key=$ht; }
if (is_array($HTTP_GET_VARS) and count($HTTP_GET_VARS)>0) foreach($HTTP_GET_VARS as $key=>$ht) { $$key=$ht; }
if (is_array($HTTP_COOKIE_VARS) and count($HTTP_COOKIE_VARS)>0) foreach($HTTP_COOKIE_VARS as $key=>$ht) { $$key=$ht; }
}

if(isset($logged_user)) unset($logged_user);
if(isset($logged_admin)) unset($logged_admin);
define ('INCLUDED776',1);

include ('components/minibb/setup_options.php');
if (isset($HTTP_COOKIE_VARS[$cookiename.'Language']) and $langCook=${$cookiename.'Language'}) { if (file_exists("components/minibb/lang/{$langCook}.php")) $lang=$langCook; }
include ('components/minibb/setup_'.$DB.'.php');
include ("components/minibb/skins/$skin.php");
include ('components/minibb/bb_codes.php');
include ('components/minibb/bb_functions.php');
include ('components/minibb/bb_specials.php');
include ('components/minibb/bb_plugins.php');
include ("components/minibb/lang/$lang.php");
if(!isset($GLOBALS['indexphp'])) $indexphp='index.php?option=com_minibb&'; else $indexphp=$GLOBALS['indexphp'];

//MAMBO - Set UserId in Forum Table
if($mini_user_id==0 && $HTTP_COOKIE_VARS["sessioncookie"]<>""){
  $uinfo=addToTable($HTTP_COOKIE_VARS["sessioncookie"], $db, $dbprefix, $Tu);
  $mini_user_id=$uinfo[0];
	$mini_user_usr=$uinfo[1];
}

/* Closed forums stuff */
if (!isset($allForums) and isset($HTTP_COOKIE_VARS[$cookiename.'allForumsPwd'])) { $allForums = $HTTP_COOKIE_VARS[$cookiename.'allForumsPwd']; $allForumsCook=1; }
else { if(!isset($allForums))$allForums=''; $allForums=md5($allForums); $allForumsCook=0; }

if ($protectWholeForum==1) {
if ($allForums != md5($protectWholeForumPwd)) {
$title = $sitename." :: ".$l_forumProtected;
echo ParseTpl(makeUp('protect_forums')); exit;
}
else {
if ($allForumsCook==0) {
print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('".$live_site."/".$indexphp."')\n"
		."-->"
		."</script>";
}
}
}

/* Banned IPs stuff */
$thisIp = getIP();
$cen = explode ('.', $thisIp);
$thisIpMask[0]=$cen[0].'.'.$cen[1].'.'.$cen[2].'.+';
$thisIpMask[1]=$cen[0].'.'.$cen[1].'.+';

if (DB_query(89,0)) {
$title = $sitename." :: ".$l_accessDenied;
echo ParseTpl(makeUp('main_access_denied')); exit;
}

/* Main stuff */
$logged = 0;
$loginError = 0;
$title = $sitename." :: ";

if (!isset($mini_user_id)) $mini_user_id=0;
if (!isset($page)) $page=0;

$forum+=0;
$mini_user_id+=0;
$topic+=0;
$page+=0;

$l_adminpanel_link = '';
$reqTxt=0;

/* Predefining variables */
$sortingTopics+=0;

if (isset($HTTP_POST_VARS['mode'])) $mode=$HTTP_POST_VARS['mode'];
elseif (isset($HTTP_GET_VARS['mode'])) $mode=$HTTP_GET_VARS['mode'];
else $mode='';
if (isset($HTTP_POST_VARS['action'])) $action=$HTTP_POST_VARS['action'];
elseif (isset($HTTP_GET_VARS['action'])) $action = $HTTP_GET_VARS['action'];
else $action='';
if (isset($HTTP_COOKIE_VARS[$cookiename])) $$cookiename=$HTTP_COOKIE_VARS[$cookiename]; else $$cookiename='';

if (isset($HTTP_GET_VARS['sortBy'])) {
$sortBy=$HTTP_GET_VARS['sortBy']; $sdef=1;
} else {
$sortBy=$sortingTopics; $sdef=0;
}

if (!($sortBy==1 or $sortBy==0)) $sortBy=$sortingTopics;

if (($action == 'deltopic' or $action == 'delmsg2' or $action == 'movetopic2') and $dy==2) $action = 'vthread';

if ($mode == 'login') {
$mini_user_usr=trim($mini_user_usr);

if ($mini_user_usr == $admin_usr) {
if ($mini_user_pwd == $admin_pwd) {
$logged_admin = 1;
$cook = $mini_user_usr."|".md5($mini_user_pwd)."|".$cookieexptime;
if ($action=='') { print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('".$live_site."/".$indexphp."')\n"
		."-->"
		."</script>"; }
}
else {
$errorMSG = $l_loginpasswordincorrect; $correctErr = "<a href=\"JavaScript:history.back(-1)\">$l_correctLoginpassword</a>";
$loginError=1;
echo load_header(); echo ParseTpl(makeUp('main_warning'));
}
// if this is not admin, this is anonymous or registered user; check registered first
}
else {
if ($row = DB_query(1,0)) 
{
// It means that username exists in database; so let's check a password
$mini_username = $row[0]; $mini_userpassword = $row[1];
if ($mini_username == $mini_user_usr and $mini_userpassword == md5($mini_user_pwd)) 
{
$logged_user = 1;
$cook = $mini_user_usr."|".md5($mini_user_pwd)."|".$cookieexptime;
if ($action=='') { print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('".$live_site."/".$indexphp."')\n"
		."-->"
		."</script>"; }
}
else {
$errorMSG = $l_loginpasswordincorrect; $correctErr = "<a href=\"JavaScript:history.back(-1)\">$l_correctLoginpassword</a>";
$loginError = 1;
echo load_header(); echo ParseTpl(makeUp('main_warning'));
}
}
else {
// There are now rows - this is Anonymous
require('components/minibb/bb_func_txt.php');$reqTxt=1;
$mini_user_usr=textFilter($mini_user_usr,40,20,0,0,0,0);
$mini_user_usr=str_replace('|', '', $mini_user_usr);
if ($minimalistBB != FALSE) {
$cookievalue = explode ("|", $minimalistBB);
$mini_user_usrOLD = $cookievalue[0];
} else { $mini_user_usrOLD = ""; }
if ($mini_user_usr != $mini_user_usrOLD) {
// We don't need to set a cookie if the same 'anonymous name' specified
$cook = $mini_user_usr."||".$cookieexptime;
}
}
}
}

if ($loginError == 0) {

if($mode == 'logout') {
minibblogout($database, $dbprefix, $HTTP_COOKIE_VARS["sessioncookie"]);
}

if ($minimalistBB != FALSE and !$mode) {
$cookievalue = explode ("|", $minimalistBB);
$mini_user_usr = $cookievalue[0]; $mini_user_pwd = $cookievalue[1];
}

if (!isset($logged_admin)) $logged_admin = (user_logged_in("admin", $HTTP_COOKIE_VARS["sessioncookie"], $db, $dbprefix)?1:0);
if (!isset($logged_user)) $logged_user = (user_logged_in("user", $HTTP_COOKIE_VARS["sessioncookie"], $db, $dbprefix)?1:0);

if ($logged_user==1 or $logged_admin==1) $logged = 1;

if ($logged==1) {
$loginLogout = ParseTpl(makeUp('user_logged_in'));
$mini_user_logging = $loginLogout;

//Getting user sort and ID
$row = DB_query(2,0);
if ($row == TRUE) $mini_user_data=array ($row[0],$row[1]); else $mini_user_data=array(0,0);

$mini_user_id=$mini_user_data[0];
if ($sdef==0) $mini_user_sort=$mini_user_data[1]; else $mini_user_sort=$sortBy;
if ($mini_user_sort == 1) { $sortByNew = 0; $sortedByT = $l_newTopics; $sortByT = $l_newAnswers; }
if ($mini_user_sort == 0) { $sortByNew = 1; $sortedByT = $l_newAnswers; $sortByT = $l_newTopics; }
}
else {
if ($sdef==0) $mini_user_sort=$sortingTopics; else $mini_user_sort = $sortBy;
if ($mini_user_sort == 1) { $sortByNew = 0; $sortedByT = $l_newTopics; $sortByT = $l_newAnswers; }
if ($mini_user_sort == 0) { $sortByNew = 1; $sortedByT = $l_newAnswers; $sortByT = $l_newTopics; }

}

if ($mini_user_sort==0) $l_author=$l_lastAuthor;

if ($logged_admin==1) {
$l_adminpanel_link = "<p><a href=\"$bb_admin\">".$l_adminpanel."</a><br><br>";
}
else {
$l_adminpanel_link = '';
}

$isMod=(isset($mods) and in_array($mini_user_id,$mods) and !(isset($modsOut) and in_array($mini_user_id.'>'.$forum,$modsOut)))?1:0;

/* Private, archive and post-only forums stuff */
$forb=0;

if ($mini_user_id!=1 and $forum!=0) {
if (isset($clForums) and in_array($forum, $clForums)) {
if (isset($clForumsUsers[$forum]) and !in_array($mini_user_id,$clForumsUsers[$forum])) $forb=1;
}
if (isset($roForums) and in_array($forum, $roForums)) {
$disallowAction=array('pthread', 'ptopic', 'editmsg', 'editmsg2', 'delmsg', 'delmsg2', 'locktopic', 'unlocktopic', 'deltopic', 'movetopic', 'movetopic2');
if (in_array($action, $disallowAction)) $forb=1;
}
if (isset($poForums) and in_array($forum, $poForums) and $isMod!=1){
$allowAction=array('vthread', 'vtopic', 'pthread', 'editmsg', 'editmsg2');
if (!in_array($action,$allowAction)) $forb=1;
}
}

if ($forb==1) {
$title.=$l_accessDenied;
echo load_header();
$errorMSG = $l_privateForum; $l_returntoforums = ""; $correctErr="";

echo ParseTpl(makeUp('main_warning'));
$l_loadingtime='';

echo ParseTpl(makeUp('main_footer'));
exit;
}
/* End stuff */

if($action=='pthread') {if($reqTxt!=1)require('components/minibb/bb_func_txt.php');require('components/minibb/bb_func_pthread.php');}
elseif($action=='ptopic') {if($reqTxt!=1)require('components/minibb/bb_func_txt.php');require('components/minibb/bb_func_ptopic.php');}


if($action=='pthread') {
  $page=-1;
  if (!isset($errorMSG)) {
  print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('".$live_site."/".$indexphp."action=vthread&forum=$forum&topic=$topic&page=$page#$anchor')\n"
		."-->"
		."</script>";
  }
} elseif($action=='vthread') require('components/minibb/bb_func_vthread.php');

elseif($action=='vtopic') {
require('components/minibb/bb_func_vtopic.php');
}

elseif($action=='ptopic') {
$page=0;
if (!isset($errorMSG)){echo"location.replace('".$live_site."/".$indexphp."action=vthread&forum=$forum&topic=$topic')\n";
print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('".$live_site."/".$indexphp."action=vthread&forum=$forum&topic=$topic')\n"
		."-->"
		."</script>";
}
}

elseif($action=='search') {if($reqTxt!=1)require('components/minibb/bb_func_txt.php');require('components/minibb/bb_func_search.php');}

elseif($action=='deltopic') require('components/minibb/bb_func_deltopic.php');

elseif($action=='locktopic') require('components/minibb/bb_func_locktop.php');

elseif($action=='editmsg') {$step=0;require('components/minibb/bb_func_editmsg.php');}

elseif($action=='editmsg2') {require('components/minibb/bb_func_txt.php');$step=1;require('components/minibb/bb_func_editmsg.php');}

elseif($action=='delmsg') {$step=0;require('components/minibb/bb_func_delmsg.php');}

elseif($action=='delmsg2') {$step=1;require('components/minibb/bb_func_delmsg.php');}

elseif($action=='movetopic') {$step=0;require('components/minibb/bb_func_movetpc.php');}

elseif($action=='movetopic2') {$step=1;require('components/minibb/bb_func_movetpc.php');}

elseif($action=='userinfo') require('components/minibb/bb_func_usernfo.php');

elseif($action=='stats') require('components/minibb/bb_func_stats.php');

elseif($action=='prefs') {$step=0;require('components/minibb/bb_func_editprf.php');}

elseif($action=='editprefs') {$step=1;require('components/minibb/bb_func_editprf.php');}

elseif($action=='unsubscribe') require('components/minibb/bb_func_unsub.php');

elseif($action=='sticky') {$status=9;require('components/minibb/bb_func_sticky.php');}

elseif($action=='unsticky') {$status=0;require('components/minibb/bb_func_sticky.php');}

elseif($action=='viewipuser') {require('components/minibb/bb_func_viewip.php');}

elseif($action=='tpl') {
if (isset($tplName) and $tplName!='' and file_exists ('components/minibb/templates/'.$tplName.'.html')){
echo load_header(); echo ParseTpl(makeUp($tplName));
}
else {
print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('".$live_site."/".$indexphp."')\n"
		."-->"
		."</script>";
}
}

elseif(DB_query(28,0)>=1){
if ($viewTopicsIfOnlyOneForum!=1) {
require('components/minibb/bb_func_vforum.php');
if (DB_query(38,0) and $viewlastdiscussions!=0) {
require('components/minibb/bb_func_ldisc.php');
$listTopics=$list_topics;
if($list_topics!='') echo ParseTpl(makeUp('main_last_discussions'));
}
}
else require('components/minibb/bb_func_vtopic.php');
}
else{
$errorMSG = $l_stillNoForums; $l_returntoforums = ""; $correctErr="";
echo load_header(); echo ParseTpl(makeUp('main_warning'));
}
}

//Loading footer
$endtime = get_microtime();
$totaltime = sprintf ("%01.3f", ($endtime - $starttime));
echo ParseTpl(makeUp('main_footer'));

?>