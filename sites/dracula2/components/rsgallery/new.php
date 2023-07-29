<?
//RSGallery//
############################################
# RSGallery - A Mambo Gallery Component!   #
# Copyright (C) 2003  by  Ronald Smit      #
# Homepage   : mamboserver.homedns.org     #
# Version    : 1.1                         #
# License    : Released under GPL          #
############################################

include('./configuration.php');
include('language/'.$lang.'/lang_com_gallery.php');

if ($submit)
	{
	if (trim($catname))
		{
		//Maak directory
		$mkdir = newdir();
		if (mkdir($imagepath.$mkdir, 0777))
			{
			mkdir($imagepath.$mkdir."/thumbs", 0777);
			//Sla gegevens op in database
			$sql = "INSERT INTO ".$dbprefix."gallery (catname,catdir) VALUES ('$catname','$mkdir')";
			$result = $database->openConnectionNoReturn($sql);
			?>
			<SCRIPT>
				alert('<?echo _GALLERY_ALERT_NEWGALLERY;?>');
				location = "index.php?option=com_gallery&page=new";
			</SCRIPT>
			<?
			}
		else
			{
			?>
			<SCRIPT>
				alert('<?echo _GALLERY_ALERT_NONEWGALLERY;?>');
				location = "index.php?option=com_gallery&page=new";
			</SCRIPT>
			<?
			}
		}
	else
		{
		//Terug naar nieuwe gallerij
		?>
		<SCRIPT>
			alert("<?echo _GALLERY_NONAME;?>");
			location = "index.php?option=com_gallery&page=new";
		</SCRIPT>
		<?
		}
	}
else
	{
	//Laat formulier zien
	?><br><br>
	<CENTER>
	<FORM METHOD="POST" ACTION="index.php?option=com_gallery&page=new">
	<table border="0" width="300">
		<tr>
			<td colspan="2" align="center"><h3><? echo _GALLERY_HD_NEW;?></h3></td>
		</tr>
		<tr>
			<td><?echo _GALLERY_FORMCREATE_NAME;?>:</td><td><input class="inputbox" type="text" name="catname" value=""></td>
		</tr>
		<tr>
			<td colspan="2" align="center">&nbsp;&nbsp;<input class="button" type="submit" name="submit" value="<?echo _GALLERY_BUTTON_CREATE;?>"></td>
		</tr>
	</table>
	</FORM>
	</CENTER>
	<?
	}
?>