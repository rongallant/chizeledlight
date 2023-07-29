<?php
$cookieexptime = time() + $cookie_expires;
$version = '1.5';

if (isset($HTTP_COOKIE_VARS[$cookiename])) $minimalistBB=$HTTP_COOKIE_VARS[$cookiename]; else $minimalistBB='';

function user_logged_in ($mini_user, $cook, $db, $dbprefix) {

global $minimalistBB;
global $mini_user_usr, $mini_user_pwd;
global $admin_usr, $admin_pwd;
global $mini_username, $mini_userpassword;
global $cookiename, $cookieexptime, $cookiepath, $cookiedomain, $cookiesecure, $cookie_renew;

$returned = FALSE;
if ($mini_user == 'admin') {

	/* Get the visitor's UserType */
	$utype = "";
	if ($cook<>""){
		$cryptSessionID=md5($cook);
		$queryg = "SELECT usertype FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
		$resultg = mysql_db_query($db, $queryg) or die("Did not execute query");
		while ($rowg = mysql_fetch_object($resultg)){
			$utype = $rowg->usertype;
		}
	  if ($utype=="administrator" or $utype=="superadministrator"){
		  $returned = TRUE;
		}
	} else { 
	  $returned=FALSE; 
	}
} elseif ($mini_user == 'user' and $mini_user_usr !=$admin_usr) {

	/* Get the visitor's UserType */
	$utype = "";
	if ($cook<>""){
		$cryptSessionID=md5($cook);
		$queryg = "SELECT usertype FROM ".$dbprefix."session WHERE session_ID='$cryptSessionID'";
		$resultg = mysql_db_query($db, $queryg) or die("Did not execute query");
		while ($rowg = mysql_fetch_object($resultg)){
			$utype = $rowg->usertype;
		}
	  if ($utype=="user"){
		  $returned = TRUE;
		}
	} else { 
    $returned = FALSE;
	}
}

return $returned;
}

//--------------->
function makeUp($name) {
global $l_meta, $indexphp,$live_site;
if (substr($name, 0, 5)=='email') $ext = 'txt'; else $ext = 'html';
if (file_exists ('components/minibb/templates/'.$name.'.'.$ext)) { 
$fd = fopen ('components/minibb/templates/'.$name.'.'.$ext, 'r');
$tpl = fread ($fd, filesize ('components/minibb/templates/'.$name.'.'.$ext));
fclose ($fd);
}
else {print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('".$live_site."/".$indexphp."')\n"
		."-->"
		."</script>";}
return $tpl;
}

//--------------->
function ParseTpl($tpl){
$qs=array();
$qv=array();
$ex=explode ('{$',$tpl);
for ($i=0; $i<=sizeof($ex); $i++){
if (!empty($ex[$i]) and substr_count($ex[$i],'}')>0) {
$xx=explode('}',$ex[$i]);
if (substr_count($xx[0],'[')>0) {
$clr=explode ('[',$xx[0]); $sp=$clr[1]+0; $clr=$clr[0];
if (!in_array($clr,$qs)) {$qs[]=$clr; global ${$clr};}
$to=${$clr}[$sp];
}
else { if(!in_array($xx[0], $qv)) {$qv[]=$xx[0]; global ${$xx[0]};}
$to=${$xx[0]};
}
$tpl=str_replace('{$'.$xx[0].'}', $to, $tpl);
}
}
if ($tpl=='main_post_form'){echo "tpl=$tpl<br>";exit;}

return $tpl;
}

//--------------->
function load_header() {
//Because of loading page title, we need to load this template separately
global $title, $bgColor, $sitename, $tableParam, $l_meta, $l_menu, $l_sepr, $l_reply, $action, $logged, $errorMSG, $adminPanel, $mini_user_logging, $indexphp, $nTop, $live_site;

if(strlen($action)>0 or $adminPanel==1) $l_menu[0] = "$l_sepr <a href=\"{$live_site}/{$indexphp}\">$l_menu[0]</a> "; else $l_menu[0]='';
if($nTop==1){
if($action=='vtopic') $l_menu[7] = "$l_sepr <a href=\"#newtopic\">$l_menu[7]</a> ";
elseif($action=='vthread') $l_menu[7] = "$l_sepr <a href=\"#newreply\">$l_reply</a> ";
}
else $l_menu[7]='';
if($action!='stats') $l_menu[3] = "$l_sepr <a href=\"{$live_site}/{$indexphp}action=stats\">$l_menu[3]</a> "; else $l_menu[3]='';
if($action!='search') $l_menu[1] = "$l_sepr <a href=\"{$live_site}/{$indexphp}action=search\">$l_menu[1]</a> "; else $l_menu[1]='';
if($action!='manual') $l_menu[4] = "$l_sepr <a href=\"{$live_site}/{$indexphp}action=manual\">$l_menu[4]</a> "; else $l_menu[4]='';
if($action!='prefs'&&$logged == 1) $l_menu[5] = "$l_sepr <a href=\"{$live_site}/{$indexphp}action=prefs\">$l_menu[5]</a> "; else $l_menu[5]='';
if($action!='language') $l_menu[8] = "$l_sepr <a href=\"{$live_site}/{$indexphp}action=language\">$l_menu[8]</a> "; else $l_menu[8]='';
if($logged==1) $l_menu[6] = "$l_sepr <a href=\"{$live_site}/{$indexphp}mode=logout\">$l_menu[6]</a> "; else $l_menu[6]='';

if (!isset($title)) $title=$sitename;

return ParseTpl(makeUp('main_header'));
}

//--------------->
function getAccess($clForums, $clForumsUsers, $mini_user_id){
$forb=array();
$acc='n';
if ($mini_user_id!=1 and sizeof($clForums)>0){
foreach($clForums as $f){
if (isset($clForumsUsers[$f]) and !in_array($mini_user_id, $clForumsUsers[$f])){
$forb[]=$f; $acc='m';
}
}
}
if ($acc=='m') return $forb; else return $acc;
}

//--------------->
function getIP(){
$ip1=getenv('REMOTE_ADDR');$ip2=getenv('HTTP_X_FORWARDED_FOR');
if ($ip2!='' and ip2long($ip2)!=-1) $finalIP=$ip2; else $finalIP=$ip1;
$finalIP=substr($finalIP,0,15);
return $finalIP;
}

//--------------->
function convert_date ($dateR) {
global $l_months, $dateFormat;

$months = explode (':', $l_months);
if (sizeof($months)!=12) $dateR = 'N/A';
else {
list ($currentD, $currentT) = explode (' ', $dateR);
$cAll = explode ('-', $currentD);
if(substr($cAll[2],0,1)=='0') $cAll[2]=substr($cAll[2],1,strlen($cAll[2])-1);
$dateR = str_replace ('DD', $cAll[2], $dateFormat);
$dateR = str_replace ('YYYY', $cAll[0], $dateR);
$whichMonth = $cAll[1]-1;
$dateR = str_replace ('MM', $months[$whichMonth], $dateR);

if (substr_count($dateR,'US')>0) {
if ($currentT>='12:00:00' and $currentT<='23:59:59') {
$times=explode(':',$currentT);
$times[0]=$times[0]-12; if ($times[0]<10) $times[0]='0'.$times[0];
$currentT=implode(':',$times); $m='pm';
}
else $m='am';
$dateR = str_replace ('US', $m, $dateR);
}
}
$dateR = str_replace ('T', $currentT, $dateR);
return $dateR;
}

//--------------->
function pageChk($page,$numRows,$viewMax){
if($numRows>0 and ($page>0 or $page==-1)){
$max=$numRows/$viewMax;
if(intval($max)==$max) $max=intval($max)-1; else $max=intval($max);
if ($page==-1) return $max;
elseif($page>$max) return $max;
else return $page;
}
else return 0;
}

//--------------->
function pageNav($page,$numRows,$url,$viewMax,$navCell){
global $viewpagelim;
if($viewpagelim>=1) $viewpagelim-=1;
$pageNav='';
$page=pageChk($page,$numRows,$viewMax);
$iVal=intval(($numRows-1)/$viewMax);
if($iVal>$viewpagelim) $iVal=$viewpagelim;
if($numRows>0&&$iVal>0&&$numRows<>$viewMax){
$end=$iVal;
if(!$navCell) $start=0; else $start=1;
if($page>0&&!$navCell) $pageNav=' <a href="'.$url.($page-1).'">&lt;&lt;</a>';
if($navCell&&$end>4){ $end=3;$pageNav.=' . '; }
elseif($page<9&&$end>9){ $end=9;$pageNav.=' . '; }
elseif($page>=9&&$end>9){
$start=intval($page/9)*9-1;$end=$start+10;
if($end>$iVal) $end=$iVal;
$pageNav.=' <a href="'.$url.'0">1</a> ...';
}
else $pageNav.=' . ';
for($i=$start;$i<=$end;$i++){
if($i==$page&&!$navCell) $pageNav.=' <b>'.($i+1).'</b> .';
else $pageNav.=' <a href="'.$url.$i.'">'.($i+1).'</a> .';
}
if((($navCell&&$iVal>4)||($iVal>9&&$start<$iVal-10))){
if($navCell&&$iVal<6); else $pageNav.='..';
for($n=$iVal-1;$n<=$iVal;$n++){
if($n>=$i) $pageNav.=' <a href="'.$url.$n.'">'.($n+1).'</a> .';
}
}
if($page<$iVal&&!$navCell) $pageNav.=' <a href="'.$url.($page+1).'">&gt;&gt;</a>';
return $pageNav;
}
}

//--------------->
function makeLim($page,$numRows,$viewMax){
$page=pageChk($page,$numRows,$viewMax);
if(intval($numRows/$viewMax)!=0&&$numRows>0){
if ($page>0) return ' LIMIT '.($page*$viewMax).','.$viewMax;
else return ' LIMIT '.$viewMax;
}
else return '';
}

//---------------------->
function sendMail($email, $subject, $msg, $from_email, $errors_email) {
global $genEmailDisable;
// Function sends mail with return-path (if incorrect email TO specifed. Reply-To: and Errors-To: need contain equal addresses!
if (!isset($genEmailDisable) or $genEmailDisable!=1){
$msg=str_replace("\r\n", "\n", $msg);
$php_version = phpversion();
$from_email = "From: $from_email\nReply-To: $errors_email\nErrors-To: $errors_email\nX-Mailer: PHP ver. $php_version";
mail($email, $subject, $msg, $from_email);
}
}

//---------------------->
function emailCheckBox() {
global $l_emailNotify, $l_unsubscribe, $indexphp;
global $genEmailDisable, $emailadmposts, $emailusers, $mini_user_id, $forum, $topic, $action, $logged;

$checkEmail='';
if($genEmailDisable!=1){

$isInDb = DB_query(80,0);

$true0 = ($emailusers==1);
$true1 = ($logged==1);
$true2 = ($action=='vtopic' or $action == 'vthread' or $action=='ptopic' or $action=='pthread');
$true3a = ($mini_user_id==1 and (!isset($emailadmposts) or $emailadmposts==0) and !$isInDb);
$true3b = ($mini_user_id!=1 and !$isInDb);
$true3 = ($true3a or $true3b);

if ($true0 and $true1 and $true2 and $true3) {
$checkEmail = "<input type=checkbox name=CheckSendMail> <a href=\"{$indexphp}action=manual#emailNotifications\">$l_emailNotify</a>";
}
elseif($isInDb) $checkEmail="<!--U--><a href=\"{$indexphp}action=unsubscribe&topic={$topic}&usrid={$mini_user_id}\">$l_unsubscribe</a>";
}
return $checkEmail;
}
?>