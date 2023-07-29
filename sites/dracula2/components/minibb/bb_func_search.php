<?php
if (!defined('INCLUDED776')) die ('Fatal error.');

function deSlice($lsTopics,$id){
global $mini_user_sort;
global $forum;
$mini_user_sort+=0;$i=0;$sPage=0;
if($lsTopics){
global $viewmaxtopic;
if($mini_user_sort==1){
$cols=DB_query(76,0);
do{$i++;if($id==$cols[0]) break;}
while($cols=DB_query(76,1));
}
else{
$cols=DB_query(77,0);
do{$i++;if($id==$cols[0]) break;}
while($cols=DB_query(77,1));
}
$sPage=intval(($i-1)/$viewmaxtopic);
}
else{
global $viewmaxreplys;
$cols=DB_query(78,0);
do{$i++;if($id==$cols[0]) break;}
while($cols=DB_query(78,1));
$sPage=intval(($i-1)/$viewmaxreplys);
}
return $sPage;
}

//--------------->

function matchGen($column,$i){
global $exploded, $exact;
if(!$exact) return "$column LIKE '%$exploded[$i]%'";
return "( $column LIKE '% $exploded[$i]' OR $column LIKE '$exploded[$i]' OR $column LIKE '$exploded[$i] %' OR $column LIKE '% $exploded[$i] %' )";
}

//--------------->

$searchWhere+=0;$searchHow+=0;$word=0;$min=2;$i=0;
$searchFor=textFilter($searchFor,100,$post_word_maxlength,0,1,0,0);

if($searchWhere==0) $whereGenAr=array("$Tp.post_text","$Tt.topic_title");
elseif($searchWhere==1) $whereGenAr=array('topic_title','');
elseif($searchWhere==2) $whereGenAr=array("$Tp.poster_name",'');

$days=substr($days,0,4)+0;
if($days<=0) $days=$defDays;

if((isset($exact)&&$exact) OR (isset($eMatch)&&$eMatch=='on')) {$exact=1;$eMatch='checked';} else {$exact=0;$eMatch='';}

$closedForums=getAccess($clForums, $clForumsUsers, $mini_user_id);
if ($closedForums!='n') $extra=1; else $extra=0;

$SHchk=array('','','');
$SHchk[$searchHow]='selected';
$SWchk=array('','','');
$SWchk[$searchWhere]='selected';

$exploded=explode(' ',$searchFor);
if($searchHow==0){
if(strlen($exploded[0])>$min) $word=1;
$searchString=matchGen($whereGenAr[0],$i);
$searchString2=matchGen($whereGenAr[1],$i);
for($i=1;$i<sizeof($exploded);$i++){
if(!$word&&strlen($exploded[$i])>$min) $word=1;
if($searchWhere==0){
$searchString.=' AND '.matchGen($whereGenAr[0],$i);
$searchString2.=' AND '.matchGen($whereGenAr[1],$i);
}
else $searchString.=' AND '.matchGen($whereGenAr[0],$i);
}
}
elseif($searchHow==1){
$word=1;
if(strlen($exploded[0])>$min){
$searchString=matchGen($whereGenAr[0],$i);
$searchString2=matchGen($whereGenAr[1],$i);
for($i=1;$i<sizeof($exploded);$i++){
if($word&&strlen($exploded[$i])<=$min) {$word=0; break;}
if($searchWhere==0){
$searchString.=' OR '.matchGen($whereGenAr[0],$i);
$searchString2.=' OR '.matchGen($whereGenAr[1],$i);
}
else $searchString.=' OR '.matchGen($whereGenAr[0],$i);
}
}
else $word=0;
}
else{
for ($i=0;$i<sizeof($exploded);$i++){
if (strlen($exploded[$i])>$min) {$word=1; break;}
}
$searchString=matchGen($whereGenAr[0],$i);
$searchString2=matchGen($whereGenAr[1],$i);
}
unset($exploded);
if($searchWhere!=0) unset($searchString2);

if(!$word||strlen($searchFor)>100) {
$title=$title.$l_searchSite;$searchResults='<small>'.$l_search[10].'</small>';
}
else {
$i=$viewmaxsearch*$page;
if($searchWhere==0){
$numRows=DB_query(53,0);
$pageNav=pageNav($page,$numRows,"{$indexphp}action=search&amp;searchFor=$searchFor&amp;searchWhere=$searchWhere&amp;searchHow=$searchHow&amp;days=$days&amp;exact=$exact&amp;page=",$viewmaxsearch,FALSE);
$makeLim=makeLim($page,$numRows,$viewmaxsearch);
if($numRows){
$cols=DB_query(4,0);
do{
$i++;
$searchResults.='<b>'.$i.'. </b><small>posted :: '.$cols[4].'</small> - <a href="'.$indexphp.'action=vtopic&amp;forum='.$cols[1].'&amp;page='.deSlice(TRUE,$cols[2]).'">'.$cols[6].'</a> <b>&#8212;&#8250;</b> <a href="'.$indexphp.'action=vthread&amp;forum='.$cols[1].'&amp;topic='.$cols[2].'">'.$cols[5].'</a><br>'."\n".'
&nbsp;&nbsp;&nbsp; <small><a href="'.$indexphp.'action=vthread&amp;forum='.$cols[1].'&amp;topic='.$cols[2].'&amp;page='.deSlice(FALSE,$cols[0]).'">'.substr(strip_tags($cols[3]),0,81).'...</a></small><br><br>'."\n";
}
while($cols=DB_query(4,1));
}
}
elseif($searchWhere==1){
$numRows=DB_query(54,0);
$pageNav=pageNav($page,$numRows,"{$indexphp}action=search&amp;searchFor=$searchFor&amp;searchWhere=$searchWhere&amp;searchHow=$searchHow&amp;days=$days&amp;exact=$exact&amp;page=",$viewmaxsearch,FALSE);
$makeLim=makeLim($page,$numRows,$viewmaxsearch);
if($numRows){
$cols=DB_query(52,0);
do{
$i++;
$searchResults.='<b>'.$i.'. </b><small>posted :: '.$cols[3].'</small> - <a href="'.$indexphp.'action=vtopic&forum='.$cols[1].'&amp;page='.deSlice(TRUE,$cols[0]).'">'.$cols[4].'</a> <b>&#8212;&#8250;</b> <a href="'.$indexphp.'action=vthread&amp;forum='.$cols[1].'&amp;topic='.$cols[0].'">'.$cols[2].'</a><br><br>'."\n";
}
while($cols=DB_query(52,1));
}
}
elseif($searchWhere==2){
$numRows=DB_query(58,0);
$pageNav=pageNav($page,$numRows,"{$indexphp}action=search&amp;searchFor=$searchFor&amp;searchWhere=$searchWhere&amp;searchHow=$searchHow&amp;days=$days&amp;exact=$exact&amp;page=",$viewmaxsearch,FALSE);
$makeLim=makeLim($page,$numRows,$viewmaxsearch);
if($numRows){
$cols=DB_query(57,0);
do{
$i++;
$searchResults.='<b>'.$i.'. </b><small>posted :: '.$cols[4].'</small> - <a href="'.$indexphp.'action=vtopic&amp;forum='.$cols[1].'&amp;page='.deSlice(TRUE,$cols[2]).'">'.$cols[6].'</a> <b>&#8212;&#8250;</b> <a href="'.$indexphp.'action=vthread&amp;forum='.$cols[1].'&amp;topic='.$cols[2].'">'.$cols[5].'</a><br>'."\n".'&nbsp;&nbsp;&nbsp; <small><a href="'.$indexphp.'action=vthread&amp;forum='.$cols[1].'&amp;topic='.$cols[2].'&amp;page='.deSlice(FALSE,$cols[0]).'">'.substr(strip_tags($cols[3]),0,81).'...</a></small><br><br>'."\n";
}
while($cols=DB_query(57,1));
}
}
$title = $title.$l_searchSite;
}
echo load_header(); echo ParseTpl(makeUp('search'));
?>