<?php
if (!defined('INCLUDED776')) die ('Fatal error.');

$mini_userData=array();
//DON'T CHANGE first index to 0
$mini_userData['username'] = trim($login);
$mini_userData['email'] = trim($email);
$mini_userData['user_icq'] = trim($icq);
$mini_userData['user_website'] = trim($website);
$mini_userData['user_occ'] = htmlspecialchars(trim($occupation));
$mini_userData['user_from'] = htmlspecialchars(trim($from));
$mini_userData['user_interest'] = htmlspecialchars(trim($interest));
$mini_userData['user_viewemail'] = $showemail;
$mini_userData['user_sorttopics'] = $sorttopics;

if(isset($HTTP_POST_VARS) and count($HTTP_POST_VARS)>0) foreach($HTTP_POST_VARS as $k=>$v) $$k=htmlspecialchars(stripslashes($v));

?>