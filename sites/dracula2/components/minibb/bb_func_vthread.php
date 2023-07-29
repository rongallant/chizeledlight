<?php
if (!defined('INCLUDED776')) die ('Fatal error.');

$listPosts=''; $deleteTopic='';
if(!$page) $query=DB_query(3,0);

$row=DB_query(8,0);
if(!$row){
$errorMSG=$l_forumnotexists; $correctErr = "<a href=\"JavaScript:history.back(-1)\">$l_back</a>";
$title = $title.$l_forumnotexists;

echo load_header(); echo ParseTpl(makeUp('main_warning')); return;
}

$forumName=$row[0]; $forumIcon=$row[2];

$topicData=DB_query(5,0);
if($topicData and $topicData[4]==$forum){
$topicName = $topicData[0];
if ($topicName=='') $topicName=$l_emptyTopic;
$topicStatus = $topicData[1];
$topicPoster = $topicData[2];
$topicPosterName = $topicData[3];
}
else {
$errorMSG=$l_topicnotexists; $correctErr = "<a href=\"JavaScript:history.back(-1)\">$l_back</a>";
$title = $title.$l_topicnotexists;

echo load_header(); echo ParseTpl(makeUp('main_warning')); return;
}
$numRows=DB_query(6,0);

if ($page==-1) $page=pageChk($page,$numRows,$viewmaxreplys);

$pageNav=pageNav($page,$numRows,"{$indexphp}action=vthread&forum=$forum&topic=$topic&page=",$viewmaxreplys,FALSE);
$makeLim=makeLim($page,$numRows,$viewmaxreplys);

$anchor = 1;
$i=0;
$cols = DB_query(7,0);

$tpl = makeUp('main_posts_cell');

do{
if($i%2==0) $bg=sectiontableentry1;
elseif($i%2==1) $bg=sectiontableentry2;
$postDate = str_replace ('<br>',' ',convert_date($cols[2]));

$allowedEdit="<a href=\"{$indexphp}action=editmsg&amp;topic=$topic&amp;forum=$forum&amp;post={$cols[6]}&amp;page=$page&amp;anchor=$anchor\">$l_edit</a>";

if ($logged_admin==1 or $isMod==1) { 
$viewIP = ' '.$l_sepr.' IP: '.'<a href="'.$indexphp.'action=viewipuser&amp;postip='.$cols[4].'">'.$cols[4].'</a>';
if($i!=0)$deleteM="<a href=\"{$indexphp}action=delmsg&amp;topic=$topic&amp;forum=$forum&amp;post={$cols[6]}&amp;page=$page\">$l_deletePost</a>"; else $deleteM='';
$allowed = $allowedEdit." ".$deleteM;
} 
else {
$cols[4]='';
if ($mini_user_id==$cols[0] and $mini_user_id !=0 and $cols[5]!=2 and $cols[5]!=3) {
$allowed = $allowedEdit;
}
else {
$allowed='';
}
}
# post_status: 0-clear (available for edit), 1-edited by author, 2-edited by admin (available only for admin), 3 - edited by mod
if ($cols[5]==0) {
$editedBy='';
}
else {
$editedBy=" $l_sepr $l_editedBy";
if($cols[5]==2) $we="{$l_admin}";
elseif($cols[5]==1) $we=$cols[1];
elseif($cols[5]==3) $we="<a href=\"{$indexphp}action=stats#mods\">{$l_moderator}</a>";
else $we='N/A';
$editedBy.=$we;
}

if ($cols[0]!=0) {
$cc=$cols[0];
if (isset($mini_userRanks[$cc])) $ins=$mini_userRanks[$cc];
elseif (isset($mods) and in_array($cc,$mods)) $ins=$l_moderator;
else { $ins=($cc==1?$l_admin:$l_member); }
$viewReg="<a href=\"{$indexphp}action=userinfo&amp;mini_user={$cc}\">$ins</a>";
}
else $viewReg='';

$posterName=$cols[1];
$posterText=$cols[3];

$listPosts.=ParseTpl($tpl);

$i++;
$anchor++;
}
while($cols=DB_query(7,1));
$l_messageABC=$l_sub_answer;
if ($topicStatus!=1 and $topicStatus!=8) {
$emailCheckBox = emailCheckBox();
if (((isset($roForums) and in_array($forum, $roForums)) OR (isset($regUsrForums) and in_array($forum, $regUsrForums) and $mini_user_id==0)) and $mini_user_id!=1 and $isMod!=1){
$mainPostForm='';$mainPostArea='<DIV align=center><B>You must login to post.</B></DIV>';
$nTop=0;
}else{
$mainPostForm = ParseTpl(makeUp('main_post_form'));
$mainPostArea = makeUp('main_post_area');
$nTop=1;
}
}
else {
$mainPostArea = makeUp('main_post_closed'); 
}
$mainPostArea=ParseTpl($mainPostArea);
if ($logged_admin==1 or $isMod==1) {
$deleteTopic = "$l_sepr <a href=\"{$indexphp}action=deltopic&amp;forum=$forum&amp;topic=$topic\">$l_deleteTopic</a>";
$moveTopic = "$l_sepr <a href=\"{$indexphp}action=movetopic&amp;forum=$forum&amp;topic=$topic&amp;page=$page\">$l_moveTopic</a>";

if ($topicStatus==0 or $topicStatus==9) {
$chstat=($topicStatus==0)?1:8;
$closeTopic = "<a href=\"{$indexphp}action=locktopic&amp;forum=$forum&amp;topic=$topic&amp;chstat=$chstat\">$l_closeTopic</a>";
}

if ($topicStatus==1 or $topicStatus==8) {
$chstat=($topicStatus==1)?0:9;
$closeTopic = "<a href=\"{$indexphp}action=locktopic&amp;forum=$forum&amp;topic=$topic&amp;chstat=$chstat\">$l_unlockTopic</a>";
}

if ($topicStatus==9 or $topicStatus==8) {
$chstat=($topicStatus==9)?0:1;
$stickyTopic="$l_sepr <a href=\"{$indexphp}action=unsticky&amp;forum=$forum&amp;topic=$topic&amp;chstat=$chstat\">$l_makeUnsticky</a>";
}
else {
$chstat=($topicStatus==1)?8:9;
$stickyTopic="$l_sepr <a href=\"{$indexphp}action=sticky&amp;forum=$forum&amp;topic=$topic&amp;chstat=$chstat\">$l_makeSticky</a>";
}

$extra=1;
if (DB_query(80,0) and $logged_admin==1) $subsTopic="$l_sepr <a href=\"{$bb_admin}?action=viewsubs&amp;topic=$topic\">$l_subscriptions</a>"; else $subsTopic='';
}

$title = $title.$topicName;

$st=0; $frm=$forum;

include ('components/minibb/bb_func_forums.php');

echo load_header(); echo ParseTpl(makeUp('main_posts'));
?>