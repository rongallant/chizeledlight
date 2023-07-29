<?php

/* Options */
$dirname = 'smilies';
$root_path = '';
if (isset($_POST['absolute_path']) or isset($_GET['absolute_path'])) {
 return;
}

/* Code */
if ($hackSmilies) {
$smilycode="<small><a href='javascript:PopUp(\"{$live_site}/components/minibb/hack_smilies.php?p=display\",150,400,1)'><img src='{$live_site}/components/minibb/img/smilies/grin.gif' border=0 align=absmiddle></a></small>&nbsp;\n";
} else {
$smilycode='';
}

function getSmilies ($root_path) {
global $dirname, $smile, $url, $s;

if ($root_path==''){
  $spath='.';
} else {
  $spath=$root_path.'/components/minibb';
}
$ff=fopen("$spath/img/$dirname/smdesc.php", 'r');
$cont=fread($ff, filesize("$spath/img/$dirname/smdesc.php"));
fclose($ff);
$sm=explode("\n", trim($cont));

$s=0;
for ($i=1; $i<sizeof($sm); $i=$i+2) {
$smile[$s]=trim($sm[$i]);
$url[$s]=trim($sm[$i+1]);
$s++;
}

return;
}
if ($hackSmilies){
function smileThis($aPost, $aEdit, $postText) {
global $main_url, $dirname, $smile, $url, $s, $max_smilies, $absolute_path;

$diff=0;

getSmilies($absolute_path);

if ($aPost) {
  for ($i=0; $i<($s-1); $i++) {
		$diff = substr_count($postText, $smile[$i]) + $diff;
		if ($diff<=$max_smilies){
      $postText=str_replace($smile[$i], "[img]{$main_url}/img/{$dirname}/{$url[$i]}[/img]", $postText);
		} else {
		  $postText=str_replace($smile[$i], "*", $postText);
		}
  }
} elseif ($aEdit) {
  for ($i=0; $i<($s-1); $i++) {
    $postText=str_replace("[img]{$main_url}/img/{$dirname}/{$url[$i]}[/img]", $smile[$i], $postText);
  }
}
return $postText;
}
}
$aPost = ($action=='ptopic' or $action=='pthread' or $action=='editmsg2');

if($aPost and !$disbbcode) {
getSmilies($absolute_path);
if ($hackSmilies) $postText=smileThis($aPost, $aEdit, $postText);
}
elseif ($p=='display') {
getSmilies($absolute_path);
include ('./setup_options.php');
include ("./skins/$skin.php");

?>

<html><head><title>MiniBB Smilies</title></head>
<body>
<table width="0%" border=<?php echo $tableParam[5]; ?> cellspacing=<?php echo $tableParam[7]; ?> cellpadding=<?php echo $tableParam[6]; ?>>

<?
for ($i=0; $i<($s-1); $i++) {
echo "<tr bgcolor=\"$tableParam[4]\"><td><a href=\"#\" onClick=\"window.opener.paste_strinL('{$smile[$i]}',0); return true;\"><img src=\"./img/{$dirname}/{$url[$i]}\" border=0></a></td><td>{$smile[$i]}</td></tr>\n";
}
?>

</table>
</body></html>

<?
}
?>