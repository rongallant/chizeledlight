<?
//RSGallery//
############################################
# RSGallery - A Mambo Gallery Component!   #
# Copyright (C) 2003  by  Ronald Smit      #
# Homepage   : mamboserver.homedns.org     #
# Version    : 1.1                         #
# License    : Released under GPL          #
############################################

include('../../configuration.php');
include('../../language/'.$lang.'/lang_com_gallery.php');
include("../../classes/database.php");
//--------------
function DB_connect()
{
global $db;
$db_server = localhost; //$host;
$db_name = dracula; //$db;
$db_user = dracula; //$user;
$db_pass = redbilbo; //$password;
$db = @mysql_connect($db_server,$db_user,$db_pass) or die("Can't connect to server, ".mysql_error());
@mysql_select_db($db_name, $db) or die("Can't select database ".mysql_error());
}
//--------------
?>
<HEAD>
<TITLE>RSGallery - <?echo $name;?></TITLE>
<link rel="stylesheet" href="rsgallery.css" type="text/css">

</HEAD>
<BODY>
<CENTER><a href="javascript:window.close()">Close</a><br><br>
<?
if ($name)
	{
	if ($xwidth > $ywidth)
		{
		if ($xwidth > 600)
			{
			?>
			<img src='../../images/gallery<?echo "/".$picdir."/".$name;?>' alt='' border='1' width='600'>	
			<?
			}
		else
			{
			?>
			<img src='../../images/gallery<?echo "/".$picdir."/".$name;?>' alt='' border='1'>
			<?
			}
		}
	else
		{
		if ($ywidth > 450)
			{
			?>
			<img src='../../images/gallery<?echo "/".$picdir."/".$name;?>' alt='' border='1' height='450'>	
			<?
			}
		else
			{
			?>
			<img src='../../images/gallery<?echo "/".$picdir."/".$name;?>' alt='' border='1'>
			<?
			}
		}
	DB_connect();
	$sql = "SELECT * FROM mos_galleryfiles WHERE id='$id'";
	$result = mysql_query($sql) or die(mysql_error());
	//$result = $database->openConnectionWithRetun($sql);
	$row = mysql_fetch_array($result);

	
	?>
	<center>
	<table width="300" border="0" class="view">
		<tr bgcolor="#808080">
			<td width="75"><strong><font color="#FFFFFF">Properties</font></strong></td><td>&nbsp;</td>
		</tr>
		<tr>
			<td width="75">Filename:</td><td width="250"><strong><?echo $name;?></strong></td>
		</tr>
		<tr>
			<td>Description:</td><td><?echo $row["descr"];?></td>
		</tr>
	</table>
	</center>
	<?
	}
?>
</CENTER>
