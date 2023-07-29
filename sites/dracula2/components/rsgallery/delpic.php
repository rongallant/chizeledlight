<?
//delpic.php
############################################
# RSGallery - A Mambo Gallery Component!   #
# Copyright (C) 2003  by  Ronald Smit      #
# Homepage   : mamboserver.homedns.org     #
# Version    : 1.1                         #
# License    : Released under GPL          #
############################################

if ($id)
	{
	//echo $id; 
	$sql = "SELECT * FROM ".$dbprefix."galleryfiles WHERE id='$id'";
	$result = $database->openConnectionWithReturn($sql);
	$row = mysql_fetch_object($result);
	$file1 = $imagepath.$imdir."/thumbs/".$row->name;
	$file2 = $imagepath.$imdir."/".$row->name;
	if (unlink($file2))
		{
		//If image is deleted, delete thumb
		unlink($file1);
		}
	else
		{
		?>
		<SCRIPT>
			alert("<?echo _GALLERY_ALERT_NODELPIC;?>");
			location = "index.php?option=com_gallery";
		</SCRIPT>
		<?
		break;
		}
	//Delete record from mos_galleryfiles
	$sql1 = "DELETE FROM  ".$dbprefix."galleryfiles WHERE id='$id'";
	$result1 = $database->openConnectionNoReturn($sql1);
	?>
	<SCRIPT>
		alert("<?echo _GALLERY_ALERT_DELPIC;?>");
		location = "index.php?option=com_gallery";
	</SCRIPT>
	<?
	}
else
	{
	?>
	<SCRIPT>
		location = "index.php?option=com_gallery";
	</SCRIPT>
	<?
	}
