<?php

function wrapText($wrap,$text){
$ft=0;
$exploded=explode(' ',$text);
for($i=0;$i<sizeof($exploded);$i++) {
$str=$exploded[$i];

if (substr_count($str, '<')>0 or substr_count($str, '>')>0 or substr_count($str, '&#')>0 or substr_count($str, '&quot;')>0 or
substr_count($str, '&amp;')>0 or substr_count($str, '&lt;')>0 or substr_count($str, '&gt;')>0) $ft=1; else $ft=0;

if (strlen($str)<$wrap and $ft!=0) $dT=TRUE;

if(strlen($str)>$wrap and $ft!=0) {

$sf=FALSE; $qf=0;
$chkPhr=''; $sym=0;
for ($a=0; $a<strlen($str); $a++) {
if ($qf==2) $qf=0;
if ($str[$a]=="\n") { $sym=0; }

if ($str[$a]=='<') { $qf=1; $ft=0; $dT=TRUE; }
elseif ($str[$a]=='>') { $qf=2; $ft=0; $dT=FALSE; }

if ($str[$a]=='&' and isset($str[$a+1]) and ($str[$a+1]=='#' or substr($str,$a+1,4)=='quot' or substr($str,$a+1,3)=='amp') or
substr($str,$a+1,2)=='lt' or substr($str,$a+1,2)=='gt') { $sf=TRUE; }
if ($sf and $str[$a]==';') { $sf=FALSE; }

if ($qf>=1 or $dT) {
$chkPhr.=$str[$a];
}
elseif($qf==0) { if(!$sf) $sym++; if ($sym<$wrap) $chkPhr.=$str[$a]; else {$chkPhr.=$str[$a].' '; $sym=0;} }
} //cycle

if (strlen($chkPhr)>0) $exploded[$i]=$chkPhr;
$sym=0; $qf=0; $chkPhr='';
}
elseif (strlen($str)>$wrap and !$dT) $exploded[$i]=chunk_split($exploded[$i],$wrap,' ');

} //i cycle

return implode(' ',$exploded);
}

//--------------->
function urlMaker($text,$wrap){
$text = str_replace("\n", " \n ", $text);

$words=explode(' ',$text);
for($i=0;$i<sizeof($words);$i++){

if (strlen($words[$i])>$wrap) $word=chunk_split($words[$i],$wrap,' '); else $word=$words[$i];
//Trim below is necessary is the tag is placed at the begin of string
$c=0;

if(strtolower(substr($words[$i],0,7))=='http://') {$c=1;$word='<a href=\"'.$words[$i].'\" target=\"_new\">'.$word.'</a>';}
elseif(strtolower(substr($words[$i],0,8))=='https://') {$c=1;$word='<a href=\"'.$words[$i].'\" target=\"_new\">'.$word.'</a>';}
elseif(strtolower(substr($words[$i],0,6))=='ftp://') {$c=1;$word='<a href=\"'.$words[$i].'\" target=\"_new\">'.$word.'</a>';}
elseif(strtolower(substr($words[$i],0,4))=='ftp.') {$c=1;$word='<a href=\"ftp://'.$words[$i].'\" target=\"_new\">'.$word.'</a>';}
elseif(strtolower(substr($words[$i],0,4))=='www.') {$c=1;$word='<a href="http://'.$words[$i].'\" target=\"_new\">'.$word.'</a>';}
elseif(strtolower(substr($words[$i],0,7))=='mailto:') {$c=1;$word='<a href=\"'.$words[$i].'\">'.$word.'</a>';}
if ($c==1) $words[$i]=$word;
//$words[$i] = str_replace ("\n ", "\n", $words[$i]);
}
$ret = str_replace (" \n ", "\n", implode(' ',$words));
return $ret;
}

//--------------->
function textFilter($text,$size,$wrap,$urls,$bbcodes,$eofs,$admin){
$text=trim(chop(htmlspecialchars($text,ENT_QUOTES)));
$text=str_replace('\&#039;', '&#039;', $text);
$text=str_replace('\&quot;', '&quot;', $text);
$text=str_replace(chr(92).chr(92).chr(92).chr(92), '&#92;&#92;', $text);
$text=str_replace(chr(92).chr(92), '&#92;', $text);
$text=str_replace('&amp;#', '&#', $text);
$text=str_replace('$', '&#036;', $text);
if($urls and !$bbcodes) {
$text=urlMaker($text,$wrap);
}
if (!$bbcodes) {
$text=enCodeBB($text, $admin);
$text=str_replace('><img src=','> <img src=',$text);
}
$text=wrapText($wrap,$text);
if($size) {
if(strlen($text)>$size) {
$text=substr($text,0,$size-3).'/">';
//Avoid special symbols extract
$tmpArr = explode ('&', $text);
$last = sizeof($tmpArr)-1;
if ($last>0) {
if (substr_count($tmpArr[$last], ';')==0) array_pop($tmpArr);
$text = implode ('&', $tmpArr);
}
}
}
if($eofs){
while (substr_count($text, "\r\n\r\n\r\n\r\n")>4) $text=str_replace("\r\n\r\n\r\n\r\n","\r\n",$text);
while (substr_count($text, "\n\n\n\n")>4) $text=str_replace("\n\n\n\n","\n",$text);
$text=str_replace("\n",'<br>',$text);
}
return $text;
}

?>