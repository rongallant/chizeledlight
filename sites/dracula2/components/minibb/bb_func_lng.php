<?php
if (!defined('INCLUDED776')) die ('Fatal error.');
$menuTitle=$l_menu[8];

if ($step==0) {

$langList='';
$ss=0;
$glang=array();
$handle=@opendir('components/minibb/lang');
if ($handle) {

while (($file = readdir($handle))!=false) {
if ($file != "." && $file != ".." && substr($file, -4)=='.php') {

$fd = fopen('components/minibb/lang/'.$file, 'r'); 
$getLang = fread ($fd, filesize ('components/minibb/lang/'.$file));
fclose($fd);

$key=substr($file,0,3);
$getLang=explode('$Lang:',$getLang); $getLang=explode(':$', $getLang[1]); $glang[$key]=$getLang[0];
}
}
closedir($handle);

asort($glang);

foreach($glang as $k=>$getLang){
$langList.='<input type=radio name=selLang value="'.$k.'"';
if ($k==$lang) $langList.=' checked';
$langList.='>'.$getLang.'</option><br>'."\n";
$ss++;
}


?>