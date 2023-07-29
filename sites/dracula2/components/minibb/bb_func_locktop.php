<?php
if (!defined('INCLUDED776')) die ('Fatal error.');

if(!isset($chstat)) die('Fatal error.'); else $status=$chstat;

if ($status==0){
if ($mini_userUnlock==1) $canLock=1; else $canLock=0;
}
else $canLock=1;

if ((DB_query(26,0)==TRUE and $canLock==1) or $logged_admin==1 or $isMod==1) {
if (DB_query(27,$status)>0) {
$errorMSG = ($status == 1?$l_topicLocked:$l_topicUnLocked);
}
else {
$errorMSG=$l_itseemserror;
}
$correctErr = "<a href=\"{$indexphp}action=vthread&amp;forum=$forum&amp;topic=$topic\">$l_back</a>";
}
else {
$errorMSG=$l_forbidden; $correctErr = "<a href=\"JavaScript:history.back(-1)\">$l_back</a>";
$title.=$l_forbidden;
echo load_header(); echo ParseTpl(makeUp('main_warning')); return;
}
$title.=$errorMSG;
echo load_header(); echo ParseTpl(makeUp('main_warning')); return;
?>