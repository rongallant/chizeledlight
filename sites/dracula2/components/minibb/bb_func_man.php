<?php

if (!defined('INCLUDED776')) die ('Fatal error.');

$tpl = makeUp('faq');
$tplTmp=str_replace('{$manual}','<!--MANUAL-->',$tpl);
$tplTmp=ParseTpl($tplTmp);
$tplTmp=explode('<!--MANUAL-->',$tplTmp);

$title.=$l_menu[4]; 
echo load_header();
echo $tplTmp[0];
if(file_exists('components/minibb/templates/manual.html')) include('components/minibb/templates/manual.html');
echo $tplTmp[1];

?>