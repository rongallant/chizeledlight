<?
//RSGallery//
############################################
# RSGallery - A Mambo Gallery Component!   #
# Copyright (C) 2003  by  Ronald Smit      #
# Homepage   : mamboserver.homedns.org     #
# Version    : 1.1                         #
# License    : Released under GPL          #
############################################

if ($submit)
	{
	if (!$catdir)
		{
		?>
		<SCRIPT>
			alert("<?echo _GALLERY_NOCAT;?>");
			location = 'index.php?option=com_gallery&page=upload';
		</SCRIPT>
		<?
		break;
		}
	if ((!$thumb) AND ($conversiontype == 0))
		{
		?>
		<SCRIPT>
			alert("<?echo _GALLERY_ALERT_NOTHUMB;?>");
			location = 'index.php?option=com_gallery&page=upload';
		</SCRIPT>
		<?
		break;
		}
	if (($thumb_name != $image_name) AND ($conversiontype == 0))
		{
		?>
		<SCRIPT>
			alert("<?echo _GALLERY_ALERT_SAMENAME;?>");
			location = 'index.php?option=com_gallery&page=upload';
		</SCRIPT>
		<?
		break;
		}
	if ($image_name != "")
		{
		//Check for right format
		if (($image_type == "image/pjpeg") || ($image_type == "image/gif") || ($image_type == "image/png"))
			{
			if (move_uploaded_file("$image", "$imagepath$catdir/$image_name"))
				{
				//gallery_id bepalen mbv $catdir
				$sql2 = "SELECT * FROM ".$dbprefix."gallery WHERE catdir='$catdir'";
				$result2 = $database->openConnectionWithReturn($sql2);
				$row2 = mysql_fetch_array($result2);
				$xx = $row2['id'];
				//Naam opslaan in database
				$sql1 = "INSERT INTO ".$dbprefix."galleryfiles (name,descr,gallery_id) VALUES ('$image_name','$descr', '$xx')";
				$result1 = $database->openConnectionNoReturn($sql1);
				}
			else
				{
				//Terug naar uploadscherm
				?>
				<SCRIPT>
					alert("<?echo _GALLERY_ALERT_NOWRITE;?>");
					location = 'index.php?option=com_gallery&page=upload';
				</SCRIPT>
				<?
				}
			}
		else
			{
			//Not the right format, back to uploadscreen
			?>
			<SCRIPT>
				alert("<?echo _GALLERY_ALERT_WRONGFORMAT;?>");
				location = 'index.php?option=com_gallery&page=upload';
			</SCRIPT>
			<?
			}
		}
	else
		{
		?>
		<SCRIPT>
			alert("<?echo _GALLERY_ALERT_NOPICSELECTED;?>");
			location = 'index.php?option=com_gallery&page=upload';
		</SCRIPT>
		<?
		}
	//resizen to thumbnail
	switch ($conversiontype)
		{
		//No autothumb, upload thumbnail seperately
		case 0:
				move_uploaded_file("$thumb", "$imagepath$catdir/thumbs/$thumb_name");
				?>
				<SCRIPT>
					alert("<?echo _GALLERY_ALERT_UPLOADTHUMBOK;?>");
					location = 'index.php?option=com_gallery&page=upload';	
				</SCRIPT>
				<?
			break;
		//ImageMagick
		case 1:
			$file_in = $imagepath.$catdir."/".$image_name;
			$file_out = $imagepath.$catdir."/thumbs/".$image_name;
			$cmd = $IM_path."convert -resize $size $file_in $file_out";
			exec($cmd);
			?>
			<SCRIPT>
				alert("<?echo _GALLERY_ALERT_UPLOADOK;?>");
				location = 'index.php?option=com_gallery&page=upload';	
			</SCRIPT>
			<?
			break;
		//NETPBM
		case 2:
			$file 		= $imagepath.$catdir."/".$image_name;
			$desfile 	= $imagepath.$catdir."/thumbs/".$image_name;
			$maxsize 	= $size;
			$origname 	= $image_name;
			$quality 	= $JPEGquality;
			//echo $file."<BR>".$desfile."<BR>".$maxsize."<BR>".$origname."<BR>".$quality;
			CreateThumbNETPBM($file,$desfile,$maxsize,$origname,$quality);
			?>
			<SCRIPT>
				alert("<?echo _GALLERY_ALERT_UPLOADOK;?>");
				location = 'index.php?option=com_gallery&page=upload';	
			</SCRIPT>
			<?
			break;
		//GD2
		case 3:
			$file 		= $imagepath.$catdir."/".$image_name;
			$desfile 	= $imagepath.$catdir."/thumbs/".$image_name;
			$maxsize 	= $size;
			$quality 	= $JPEGquality;
			CreateThumbGD2($file, $desfile, $quality, $maxsize);
			?>
			<SCRIPT>
				alert("<?echo _GALLERY_ALERT_UPLOADOK;?>");
				location = 'index.php?option=com_gallery&page=upload';	
			</SCRIPT>
			<?
			break;
		}
	}
else
	{
	//Show upload screen
	$sql = "SELECT * FROM ".$dbprefix."gallery";
	$result = $database->openConnectionWithReturn($sql);
	//$result = mysql_query($sql);
	?>
	<form enctype="multipart/form-data" name="selection" method="POST" action="index.php?option=com_gallery&page=upload">
	<CENTER><br><br>
	<TABLE border="0">
	<TR>
		<TD colspan="2" align="center"><H3><?echo _GALLERY_HD_UPLOAD;?></H3></TD>
	</TR>
	<TR>
		<TD valign="top"><?echo _GALLERY_FORM_IMAGEFILE;?>:</TD><TD><input class="inputbox" type="file" name="image" size="30"><br><br></TD>
	</TR>
	<? if ($conversiontype == 0)
		{
		?>
		<tr>
			<TD valign="top">Thumbnail:</TD><td><input class="inputbox" type="file" name="thumb" size="30"><br>
			<font size="-3">(Thumb <font color="#FF0000"><strong>MUST</strong></font> have same name as original!!)</font><br></td>
		</tr>
		<?
		}
		?>
	<TR>
		<TD valign="top"><?echo _GALLERY_FORM_INGALLERY;?>:</TD>
		<TD>
			<select name="catdir">
			<OPTION value="">---&nbsp;<?echo _GALLERY_PICK;?>&nbsp;---</OPTION>
			<?
			while ($row = mysql_fetch_array($result))
				{
				$catid = $row['id'];
				$catdir = $row['catdir'];
				$catname = $row['catname'];
				?>
				<option value="<?echo $catdir;?>" <? if ($id == $catid) {echo " SELECTED";}?>><?echo $catname;?></option>
				<?
				}
			?>
			</SELECT><br><br>
		</TD>
	</TR>
	<TR>
		<TD valign="top"><?echo _GALLERY_DESCRIPTION;?></TD><TD><textarea class="inputbox" cols="25" rows="5" name="descr"></textarea></TD>
	</TR>
	<TR>
		<TD colspan="2" align="center"><br><br><input class="button" type="submit" name="submit" value="<?echo _GALLERY_BUTTON_UPLOAD;?>"></TD>
	</TR>
	</TABLE></form></CENTER>
	<?
	}
?>