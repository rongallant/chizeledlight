<?php
if (!defined('INCLUDED776')) die ('Fatal error.');

function getModeratorsList($mods){
global $modIds, $indexphp;
$modIds=$mods; if(!in_array(1,$modIds)) $modIds[]=1;
$c='';
if ($row=DB_query(102,0)){
do { $c.="<a href=\"{$indexphp}action=userinfo&amp;mini_user={$row[1]}\">{$row[0]}</a>, "; }
while ($row=DB_query(102,1));
}
return substr($c,0,strlen($c)-2);
}

//----------------------->

$days=substr($days,0,4)+0;
if($days<=0) $days=$defDays;

$closedForums=getAccess($clForums, $clForumsUsers, $mini_user_id);
if ($closedForums!='n') $extra=1; else $extra=0;

if (isset($topStats) and in_array($topStats,array(1,2,3,4))) $tKey=$topStats; else $tKey=4;

$top+=0;$key2='';
if ($top+1>$tKey) $top=$tKey-1;
function fTopa($top){
if($top==0) $topa=5;
elseif($top==1) $topa=10;
elseif($top==2) $topa=20;
else $topa=40;
return $topa;
}
$statsTop=' . ';
for($i=0;$i<$tKey;$i++){
if($i<>$top) $statsTop.='<a href="'.$indexphp.'action=stats&amp;top='.$i.'&amp;days='.$days.'">'.$l_stats_top.' '.fTopa($i).'</a> . ';
else $statsTop.=$l_stats_top.' '.fTopa($i).' . ';
}

$makeLim='LIMIT '.fTopa($top);

$tpl=makeUp('stats_bar');

if($cols=DB_query(39,0)){
do{
if($cols[3]){
$val=$cols[3]-1;
if(!isset($vMax)) $vMax=$val;
if ($vMax!=0) $stats_barWidth=round(100*($val/$vMax));
if($stats_barWidth>$stats_barWidthLim) $key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[2].'&amp;topic='.$cols[0].'">'.$cols[1].'</a>';
else{
$key2='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[2].'&amp;topic='.$cols[0].'">'.$cols[1].'</a>';
$key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[2].'&amp;topic='.$cols[0].'">...</a>';
}
$list_stats_popular.=ParseTpl($tpl);
}
else break;
}
while($cols=DB_query(39,1));
unset($vMax);$key2='';
}

if($cols=DB_query(12,0)){
do{
if($cols[1]){
if(!isset($vMax)) $vMax=$cols[1];
$val=$cols[1];
$stats_barWidth=round(100*($val/$vMax));
if($stats_barWidth>$stats_barWidthLim) $key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[3].'&amp;topic='.$cols[0].'">'.$cols[2].'</a>';
else{
$key2='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[3].'&amp;topic='.$cols[0].'">'.$cols[2].'</a>';
$key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[3].'&amp;topic='.$cols[0].'">...</a>';
}
$list_stats_viewed.=ParseTpl($tpl);
}
else break;
}
while($cols=DB_query(12,1));
unset($vMax);$key2='';
}

if($cols=DB_query(55,0)){
do{
if($cols[2]){
$val=$cols[2];
if(!isset($vMax)) $vMax=$val;
$stats_barWidth=round(100*($val/$vMax));
if($stats_barWidth>$stats_barWidthLim) $key='<a href="'.$indexphp.'action=userinfo&amp;mini_user='.$cols[0].'">'.$cols[1].'</a>';
else{
$key2='<a href="'.$indexphp.'action=userinfo&amp;mini_user='.$cols[0].'">'.$cols[1].'</a>';
$key='<a href="'.$indexphp.'action=userinfo&amp;mini_user='.$cols[0].'">...</a>';
}
$list_stats_aUsers.=ParseTpl($tpl);
}
else break;
}
while($cols=DB_query(55,1));
unset($cols);
}
$numUsers=DB_query(36,0);
$numTopics=DB_query(37,0);
$numPosts=DB_query(38,0);
$adminInf=DB_query(75,0);
if (isset($mods) and count($mods)>0) $moderatorsList=getModeratorsList($mods);
else $moderatorsList="<a href=\"{$indexphp}action=userinfo&amp;mini_user=1\">{$adminInf}</a>";
$lastRegUsr=DB_query(74,0);
echo load_header(); echo ParseTpl(makeUp('stats'));
?>