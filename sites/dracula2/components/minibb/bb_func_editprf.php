<?php
if (!defined('INCLUDED776')) die ('Fatal error.');

if ($logged==1) {

if (!isset($warning)) $warning='';
$l_fillRegisterForm ='';
$editable = 'disabled';
$mini_userTitle=$l_editPrefs;
$l_passOnceAgain.=' (<small>'.$l_onlyIfChangePwd.')</small>';
$actionName='editprefs';
$mini_userData = DB_query(63,$mini_user_id);
if ($mini_userData) {

if ($step==1) {
$login = $mini_userData['username'];
require('components/minibb/bb_func_usrdat.php');

$showEmailYes = ($mini_userData['user_viewemail']==1)?'checked':'';
$showEmailNo = ($showEmailYes=='checked')?'':'checked';
$sortTopics1 = ($mini_userData['user_sorttopics']==1)?'checked':'';
$sortTopics0 = ($sortTopics1=='checked')?'':'checked';

require('components/minibb/bb_func_checkusr.php');
$correct = checkUserData($mini_userData, 'upd');
$email1 = $mini_userData['email'];
if (DB_query(71,0)==1 or ($email1==$admin_email and $mini_user_id!=1)) $correct=4;

if ($correct=='ok') {
//Update db
$upd = DB_query(70,$mini_userData);
if ($upd) {
$title.=$l_prefsUpdated;
$warning=$l_prefsUpdated;
if ($mini_userData['user_regdate']!='') $warning.=', '.$l_prefsPassUpdated;
}
else {
$title.=$l_editPrefs;
$warning=$l_prefsNotUpdated;
}

}
else {
if ($l_userErrors[$correct] == '') $l_userErrors[$correct]=$l_undefined;
$warning = $l_errorUserData.": <font color=red><b>{$l_userErrors[$correct]}</b></font>";
$title.=$l_errorUserData;
}

$tpl=makeUp('user_dataform');
if($mini_user_id==1) $tpl=preg_replace("#<!--PASSWORD-->(.*?)<!--/PASSWORD-->#is",'',$tpl);
echo load_header(); echo ParseTpl($tpl); return;
}

else {
$step=0;
$email=$mini_userData['email'];
$icq=$mini_userData['user_icq'];
$website=$mini_userData['user_website'];
$occupation=$mini_userData['user_occ'];
$from=$mini_userData['user_from'];
$interest=$mini_userData['user_interest'];

$showEmailYes = ($mini_userData['user_viewemail']==1)?'checked':'';
$showEmailNo = ($showEmailYes=='checked')?'':'checked';
$sortTopics1 = ($mini_userData['user_sorttopics']==1)?'checked':'';
$sortTopics0 = ($sortTopics1=='checked')?'':'checked';

$title.=$l_editPrefs;
$tpl=makeUp('user_dataform');
if($mini_user_id==1) $tpl=preg_replace("#<!--PASSWORD-->(.*?)<!--/PASSWORD-->#is",'',$tpl);
echo load_header(); echo ParseTpl($tpl); return;
}

}
else {
$title.=$l_mysql_error; $errorMSG=$l_mysql_error; $correctErr = '';
$tpl = makeUp('main_warning'); 
}
}
else {
$title.=$l_forbidden; $errorMSG=$l_forbidden; $correctErr='';
$tpl = makeUp('main_warning');
}

echo load_header(); echo ParseTpl($tpl); return;
?>