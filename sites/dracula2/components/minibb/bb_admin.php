<?php
/*
bb_admin.php : administration file for miniBB.
Copyright (C) 2001-2002 miniBB.net.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
function get_microtime() {
$mtime=explode(' ',microtime());
return $mtime[1]+$mtime[0];
}

$starttime = get_microtime();

if (!get_cfg_var('register_globals')){
if (is_array($HTTP_POST_VARS) and count($HTTP_POST_VARS)>0) foreach($HTTP_POST_VARS as $key=>$ht) { $$key=$ht; }
if (is_array($HTTP_GET_VARS) and count($HTTP_GET_VARS)>0) foreach($HTTP_GET_VARS as $key=>$ht) { $$key=$ht; }
if (is_array($HTTP_COOKIE_VARS) and count($HTTP_COOKIE_VARS)>0) foreach($HTTP_COOKIE_VARS as $key=>$ht) { $$key=$ht; }
}

include ("components/minibb/setup_options.php");
if ($langCook=${$cookiename.'Language'}) { if (file_exists("components/minibb/lang/{$langCook}.php")) $lang=$langCook; }
include ("components/minibb/setup_$DB.php");
include ("components/minibb/skins/$skin.php");
include ("components/minibb/bb_functions.php");
include ("components/minibb/lang/$lang.php");
if(!isset($GLOBALS['indexphp'])) $indexphp='index.php?option=com_minibb&'; else $indexphp=$GLOBALS['indexphp'];

$mode = $HTTP_POST_VARS["mode"];
if ($mode == "") $mode = $HTTP_GET_VARS["mode"];
$action = $HTTP_POST_VARS["action"];
if ($action == "") $action = $HTTP_GET_VARS["action"];

$l_adminpanel_link='';
$warning='';

$adminPanel = 1;

//---------------------------------------
function get_template_forum_orders($resultVal, $count, $forumID, $l_mysql_error) {
// Get forumorder options
for ($i=0; $i<=$count; $i++) {
$a = $i+1;
$forumorder.="<option value=\"".$a."\"";
if ($forumID == $resultVal["forum_id"][$i]) $forumorder.=" selected";
$forumorder.=">".$a."</option>";
}
return $forumorder;
}

//---------------------------------------
function getForumIcons() {
global $l_forumIcon, $l_accessDenied, $live_site;
$iconList='';
$handle=@opendir('components/minibb/img/forum_icons');
if ($handle) {
$ss = 0;
while (($file = readdir($handle))!==false) {
if ($file != "." && $file != "..") {
$iconList.="<a href=\"JavaScript:paste_strinL('{$file}')\" onMouseOver=\"window.status='{$l_forumIcon}: {$file}'; return true\"><img src=\"{$live_site}/components/minibb/img/forum_icons/{$file}\" width=16 height=16 border=0 alt=\"{$file}\"></a>&nbsp;&nbsp;";
$ss++;
if ($ss==5) {
$ss = 0;
$iconList.="<br>\n";
}
}
}
closedir($handle);
if ($iconList=='') $iconList=$l_accessDenied;
}
else {
$iconList=$l_accessDenied;
}

return $iconList;
}

//---------------------------------------
function get_forums_fast_preview ($resultVal, $count, $l_mysql_error) {
global $viewTopicsIfOnlyOneForum, $l_topicsWillBeDisplayed, $bb_admin, $live_site;
// Get forums fast order preview in admin panel
$fast='';
for ($i=0; $i<=$count; $i++) {
$fast.="<img src=\"".$live_site."/components/minibb/img/forum_icons/".$resultVal["forum_icon"][$i]."\" width=16 height=16 border=0 alt=\"Forum icon\">&nbsp;<b><a href=$bb_admin&action=editforum2&amp;forumID=".$resultVal["forum_id"][$i].">".$resultVal["forum_name"][$i]."</a></b> [ORDER: ".$resultVal["forum_order"][$i]."] - <i><small>".$resultVal["forum_desc"][$i]."</small></i><br>";
}
if ($count < 1 and $viewTopicsIfOnlyOneForum == "1") $fast.="<br>".$l_topicsWillBeDisplayed;
return $fast;
}

//---------------------------------------

switch ($mode) {
case 'logout':
//setcookie($cookiename,'',(time() - 2592000),$cookiepath,$cookiedomain,$cookiesecure);
minibblogout($database, $dbprefix, $HTTP_COOKIE_VARS["sessioncookie"]);

case "login":
if ($mode == "login") {

//checkAdminLogin($adminusr,$adminpwd, $database, $dbprefix,$HTTP_COOKIE_VARS);

//MAMBO - Set UserId in Forum Table
/*if($mini_user_id==0 && $HTTP_COOKIE_VARS["sessioncookie"]<>""){
  $uinfo=addToTable($HTTP_COOKIE_VARS["sessioncookie"], $db, $dbprefix, $Tu);
  $mini_user_id=$uinfo[0];
	$mini_user_usr=$uinfo[1];
}*/
}
default:
if (user_logged_in("admin", $HTTP_COOKIE_VARS["sessioncookie"], $db, $dbprefix))
{
$l_adminpanel_link = "<p><a href=\"$bb_admin\">".$l_adminpanel."</a><br><br>";

switch ($action) {
case "addforum1":
if (!isset($forumicon)) $forumicon='default.gif';
if (!isset($forumname)) $forumname='';
if (!isset($forumdesc)) $forumdesc='';
$iconList = getForumIcons();
$text2=ParseTpl(makeUp('admin_addforum1'));
break;

case "addforum2":
$iconList = getForumIcons();
if ($forumname) {

if ($forumicon == "") $forumicon="default.gif";

if (file_exists("components/minibb/img/forum_icons/{$forumicon}")) {

$forumname=trim(str_replace("'",'&#039;',$forumname));
$forumdesc=trim(str_replace("'",'&#039;',$forumdesc));
$forumname=str_replace('"','&quot;',$forumname);
$forumdesc=str_replace('"','&quot;',$forumdesc);

$used_id = DB_query(30,0);
if ($used_id >0) $warning = $l_forum_added; else $warning = $l_itseemserror;
$text2=ParseTpl(makeUp('admin_panel'));
}
else {
$warning = $l_error_addforumicon."'".$forumicon."'";
$text2=ParseTpl(makeUp('admin_addforum1'));
}
}
else {
$warning = $l_error_addforum;
$text2=ParseTpl(makeUp('admin_addforum1'));
}
break;

case "editforum1":
$forums_to_edit='';

if ($row = DB_query(16,0)) {
do {
$forums_to_edit.="<option value=\"".$row[0]."\">".$row[1]."</option>";
}
while ($row = DB_query(16,1));

$text2=ParseTpl(makeUp('admin_editforum1'));
}
else {
$warning = $l_noforums;

$text2=ParseTpl(makeUp('admin_panel'));
}
break;

case "editforum2":
if ($forumID) {
if ($row = DB_query(32,0)) {
$a = 0;
do {
$resultVal["forum_name"][$a] = $row["forum_name"];
$resultVal["forum_desc"][$a] = $row["forum_desc"];
$resultVal["forum_order"][$a] = $row["forum_order"];
$resultVal["forum_id"][$a] = $row["forum_id"];
$resultVal["forum_icon"][$a] = $row["forum_icon"];
$a++;
}
while($row = DB_query(32,1));

$forumorder = get_template_forum_orders($resultVal, $a-1, $forumID, $l_mysql_error);
$forumsPreview = get_forums_fast_preview($resultVal, $a-1, $l_mysql_error);
unset($resultVal);
}

if ($row = DB_query(33,0)) {

$forumname = $row["forum_name"];
$forumdesc = $row["forum_desc"];
$forumicon = $row["forum_icon"];
$iconList = getForumIcons();

$text2=ParseTpl(makeUp('admin_editforum2'));
}
else {
$warning = $l_noforums;
$text2=ParseTpl(makeUp('admin_panel'));
}
}
else {
$warning = $l_noforums;
$text2=ParseTpl(makeUp('admin_panel'));
}
break;

case "editforum3":
$forumname=trim(str_replace("'",'&#039;',$forumname));
$forumdesc=trim(str_replace("'",'&#039;',$forumdesc));
$forumname=str_replace('"','&quot;',$forumname);
$forumdesc=str_replace('"','&quot;',$forumdesc);
$forumname=str_replace('\&quot;','&quot;',$forumname);
$forumdesc=str_replace('\&quot;','&quot;',$forumdesc);
$forumname=str_replace('\&#039;','&#039;',$forumname);
$forumdesc=str_replace('\&#039;','&#039;',$forumdesc);

if (!$deleteforum) {
if ($forumname != "") {

if ($forumicon == "") $forumicon="default.gif";

if (!file_exists("components/minibb/img/forum_icons/{$forumicon}")) {
$warning = $l_error_addforumicon."'".$forumicon."'";
}
else {

$row = DB_query(34,0);
if ($row >0) $warning = $l_forumUpdated; else $warning = $l_prefsNotUpdated;
}
} // if forum name is set
else {
$warning = $l_error_addforum;
}
if ($row = DB_query(32,0)) {
$a = 0;
do {
$resultVal["forum_name"][$a] = $row["forum_name"];
$resultVal["forum_desc"][$a] = $row["forum_desc"];
$resultVal["forum_order"][$a] = $row["forum_order"];
$resultVal["forum_id"][$a] = $row["forum_id"];
$resultVal["forum_icon"][$a] = $row["forum_icon"];
if ($row["forum_id"] == $forumID) { $forumname = $row["forum_name"]; $forumdesc = $row["forum_desc"]; }
$a++;
}
while($row = DB_query(32,1));

$forumorder = get_template_forum_orders($resultVal, $a-1, $forumID, $l_mysql_error);
$forumsPreview = get_forums_fast_preview($resultVal, $a-1, $l_mysql_error);
unset($resultVal);

$iconList = getForumIcons();

}
$text2=ParseTpl(makeUp('admin_editforum2'));
}
else {
$row = DB_query (35,0);
if ($row>0) $warning = $l_forumdeleted." (\"$forumname\") - $l_del $row $l_rows"; else $warning = $l_itseemserror;
$text2=ParseTpl(makeUp('admin_panel'));
}
break;

case ("removeuser1"):
$text2=ParseTpl(makeUp('admin_removeuser1'));
break;

case ("removeuser2"):
if (!$mini_userID or !DB_query(63,$mini_userID) or $mini_userID==1 or $mini_userID==0) $warning = $l_cantDeleteUser;
else {
if (DB_query(64,$mini_userID)) $warning = $l_userDeleted." (".$mini_userID.")"; else $warning = $l_userNotDeleted." (".$mini_userID.")";
if ($removemessages) {
if (DB_query(65,$mini_userID)) $warning.="<br>".$l_userMsgsDeleted; else $warning.="<br>".$l_userMsgsNotDeleted;
}
else {
if (DB_query(66,$mini_userID)) $warning.="<br>".$l_userUpdated0; else $warning.="<br>".$l_userNotUpdated0;
}

}

$text2=ParseTpl(makeUp('admin_panel'));
break;

case 'delsendmails1':
if (!isset($warning)) $warning = '';
if (!isset($delemail)) $delemail = '';
$text2=ParseTpl(makeUp('admin_sendmails1'));
break;

case 'delsendmails2':
$row = DB_query(82,0);
if ($row<0) $row=0;
if ($delemail=='') $row='ALL';
$warning = $l_completed." ($row)";
$text2=ParseTpl(makeUp('admin_panel'));
break;

case 'banUsr1':
if (!isset($warning)) $warning = '';
if (!isset($banip)) $banip = '';
$text2=ParseTpl(makeUp('admin_banusr1'));
break;

case 'banUsr2':
if (!isset($warning)) $warning = '';
if (!isset($banip)) $banip = '';

if (preg_match("/^[1-9][0-9]?[0-9]?\.[1-9]?[0-9][0-9]?\.([1-9]?[0-9][0-9]?|\+)(\.([1-9]?[0-9][0-9]?|\+))?$/", $banip)) {
$thisIp=$banip; $thisIpMask=array($banip,$banip);
$row = DB_query(89,0);
if ($row) $warning = $l_IpExists; else {
$row = DB_query(86,0);
if ($row>0) $warning = $l_IpBanned; else $warning=$l_mysql_error;
}
$text2 = makeUp('admin_panel');
}
else {
$warning = $l_incorrectIp;
$text2 = makeUp('admin_banusr1');
}
$text2=ParseTpl($text2);
break;

case 'deleteban1':
if (!isset($warning)) $warning = '';
if (!isset($banipID)) $banipID = '';

$banned = DB_query(87,0);
$bannedIPs='';
if ($banned) {
do {
$bannedIPs.='<input type=checkbox name=banip['.$banned[0].']>&nbsp;&nbsp;'.$banned[1]."<br>\n";
}
while ($banned=DB_query(87,1));

$text2 = makeUp('admin_deleteban1');
}
else {
$warning = $l_noBans;
$text2 = makeUp('admin_panel');
}

$text2=ParseTpl($text2);
break;

case 'deleteban2':
$bannedIPs='';
$i=0;

if (sizeof($banip)>0) {
while (list ($key) = each ($banip)) {
$delban[$i]=$key;
$i++;
}

$row = DB_query(88, $delban);
}
else {
$row=0;
}

$warning = $l_completed.' ('.$row.')';

$text2=ParseTpl(makeUp('admin_panel'));
break;

case 'exportemails':
if (DB_query(201,0)) { $text2 = makeUp('admin_export_emails'); }
else { $warning = $l_accessDenied; $text2 = makeUp('admin_panel'); }
$text2=ParseTpl($text2);
break;

case 'exportemails2':
if ($row=DB_query(201,0)) {
if (isset($expEmail) and $expEmail!='') { $wh['email']='user_email'; }
if (isset($expLogin) and $expLogin!='') { $wh['username']='username'; }
$cont='';

do {
if (isset($expEmail) and $expEmail!='') {
$cont.=$row[0];
if (isset($expLogin) and $expLogin!='') {
if ($separate == 'comma') $sep=','; else $sep=chr(9);
$cont.=$sep.$row[1];
}

if ($screen==1) $cont.='<br>'; else $cont.="\n";
}

}
while ($row=DB_query(201,1));

if ($screen==1) { echo $cont;}
}
break;

case 'searchusers':
$ci='checked';
$warning = '';
$text2=ParseTpl(makeUp('admin_searchusers'));
break;

case 'searchusers2':
$tR=makeUp('admin_searchusersres');

if ($whatus=='' and $searchus!='inactive' and $searchus!='registr'){
$numUsers=DB_query(36,0); $numUsers+=1;
$page+=0;
$makeLim=makeLim($page,$numUsers,$viewmaxsearch);
$pageNav=pageNav($page,$numUsers,"{$bb_admin}&action=searchusers2&amp;whatus=&amp;page=",$viewmaxsearch,FALSE);

if ($row=DB_query(92,0)){
do {
if ($lRepl=DB_query(97,$row[0])) $lReplies=str_replace('<br>',' ',convert_date($lRepl)); else $lReplies='<u>???</u>';
$Rest=$tR;
$rDate=str_replace('<br>','&nbsp;',convert_date($row[2]));
$Results.=ParseTpl($Rest);
}
while ($row=DB_query(92,1));
}
$warning=$l_recordsFound.' '.$numUsers;
}

elseif ($searchus=='inactive'){
$ca='checked';
/* Determine all inactive users */
$extra=1;
if ($numUsers=DB_query(98,0)) $numUsers=$numUsers[0];
$numUsers+=0;
$page+=0;
$makeLim=makeLim($page,$numUsers,$viewmaxsearch);
$pageNav=pageNav($page,$numUsers,"{$bb_admin}&action=searchusers2&amp;whatus={$whatus}&amp;searchus=inactive&amp;page=",$viewmaxsearch,FALSE);

$extra=2;
if ($row=DB_query(98,0)){
do {
$Rest=$tR;
$lReplies='---';
$rDate=str_replace('<br>','&nbsp;',convert_date($row[2]));
$Results.=ParseTpl($Rest);
$tot++;
}
while($row=DB_query(98,1));
}
$warning=$l_recordsFound.' '.$numUsers;
}

elseif ($searchus=='registr') {
$cr='checked';
if (!preg_match("/^[12][019][0-9][0-9]-[01][0-9]-[0123][0-9]$/", $whatus)) $warning=$l_wrongData;
else{
$less=$whatus.' 00:00:00';
$extra=1;
$numUsers=DB_query(99,0)+0;
$page+=0;
$makeLim=makeLim($page,$numUsers,$viewmaxsearch);
$pageNav=pageNav($page,$numUsers,"{$bb_admin}&action=searchusers2&amp;whatus={$whatus}&amp;searchus=registr&amp;page=",$viewmaxsearch,FALSE);

$extra=2;
if ($row=DB_query(99,0)){
do{
$Rest=$tR;
$rDate=str_replace('<br>','&nbsp;',convert_date($row[2]));
$lReplies=$row[5];
$Results.=ParseTpl($Rest);
}
while($row=DB_query(99,1));
}
$warning=$l_recordsFound.' '.$numUsers;
}
}

elseif ($searchus=='email'){
$ce='checked';
$tot=0;
$mini_userData[1]=$whatus; $mini_userData[4]=$whatus;
if ($row=DB_query(62,0)){
do {
$mini_user=$row[0];
if ($lRepl=DB_query(97,$row[0])) $lReplies=str_replace('<br>',' ',convert_date($lRepl)); else $lReplies='<u>???</u>';
$Rest=$tR;
$rDate=str_replace('<br>','&nbsp;',convert_date($row[2]));
$Results.=ParseTpl($Rest);
$tot++;
}
while ($row=DB_query(62,1));
}
$warning=$l_recordsFound.' '.$tot;
}

else{
$ci='checked';
$tot=0;
if ($row=DB_query(63,$whatus)){
$Results=makeUp('admin_searchusersres');
$rDate=str_replace('<br>','&nbsp;',convert_date($row[2]));
if ($lRepl=DB_query(97,$row[0])) $lReplies=str_replace('<br>',' ',convert_date($lRepl)); else $lReplies='<u>???</u>';
$tot++;
$Results=ParseTpl($Results);
}
$warning=$l_recordsFound.' '.$tot;
}

$text2=ParseTpl(makeUp('admin_searchusers'));
break;

case 'viewsubs':
$topicTitle=DB_query(5,0); $topicTitle=$topicTitle[0];
$listSubs='';

if ($row=DB_query(100,0)){
$listSubs="<form action=\"$bb_admin\" method=post class=formStyle>
<input type=hidden name=action value=\"viewsubs2\">
<input type=hidden name=topic value=\"$topic\">";
do {
$listSubs.="<br><input type=checkbox name=selsub[] value={$row[0]}><small><a href=\"{$indexphp}action=userinfo&user={$row[1]}\">{$row[2]}</a> (<a href=\"mailto:{$row[3]}\">{$row[3]}</a>)</small>\n";
}
while ($row=DB_query(100,1));
$listSubs.="<p><input type=submit value=\"$l_deletePost\" class=inputButton></form>\n";
}

$text2=ParseTpl(makeUp('admin_viewsubs'));
break;

case 'viewsubs2':
$closedForums=$selsub;
$totalDel=0;
if (sizeof($closedForums)>0){
$totalDel=DB_query(101,0);
}
$errorMSG=$l_subscriptions.': '.$l_del.' '.$totalDel.' '.$l_rows;
$correctErr="<a href=\"{$bb_admin}&action=viewsubs&topic=$topic\">$l_back</a>";
$text2=ParseTpl(makeUp('main_warning'));
break;

default:
$warning = '';
$text2=ParseTpl(makeUp('admin_panel'));
} // end of switch
}
else {
//if (!$warning) $warning = $l_enter_admin_login;
//$text2=ParseTpl(makeUp('admin_login'));
}

} // end of switch

echo $text2;

$endtime = get_microtime();
$totaltime = sprintf ("%01.3f", ($endtime - $starttime));
echo ParseTpl(makeUp('main_footer'));

?>