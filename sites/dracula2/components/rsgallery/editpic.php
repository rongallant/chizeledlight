<?
//editpic.php
############################################
# RSGallery - A Mambo Gallery Component!   #
# Copyright (C) 2003  by  Ronald Smit      #
# Homepage   : mamboserver.homedns.org     #
# Version    : 1.1                         #
# License    : Released under GPL          #
############################################

if ($submit)
	{
	//Save in database
	$sql = "UPDATE ".$dbprefix."galleryfiles SET descr = '$descr' WHERE id='$id'";
	$result = $database->openConnectionNoReturn($sql);
	?>
		<SCRIPT>
			alert("<?echo _GALLERY_EDITPIC_OK;?>");
			location = "index.php?option=com_gallery";
		</SCRIPT>
	<?
	}
else
	{
	if ($id)
		{
		//Laat scherm zien met beschrijving van afbeelding
		$sql = "SELECT * FROM ".$dbprefix."galleryfiles WHERE id='$id'";
		$result = $database->openConnectionWithReturn($sql);
		$row = mysql_fetch_object($result);
		//$database->setQuery("SELECT * FROM #__galleryfiles WHERE id='$id'");
		//$rows = $database->loadresult();
		$name = $row->name;
		$descr = $row->descr;
		$id = $row->id;
		?>
		<CENTER>
		<FORM METHOD="POST" ACTION="index.php?option=com_gallery&page=editpic">
		<input type="hidden" name="id" value="<?echo $id;?>">
		<TABLE border="0" width="300">
			<TR>
				<TD><br>
				<a href="index.php?option=com_gallery">
				<img src="components/rsgallery/home.gif" alt="<?echo _GALLERY_BACK;?>" border="0">&nbsp;&nbsp;<?echo _GALLERY_BACK;?>
				</a><br><br>
				</TD>
				<TD>&nbsp;</TD>
			</TR>
			<TR>
				<TD colspan="2" align="center"><h3>Edit picture</h3></TD>
			</TR>
			<TR>
				<TD colspan="2" align="right">
					<img src="<? echo $imagepath.$imdir."/thumbs/".$row->name;?>" alt="" border="1" width="75">
				</TD>
			</TR>
			<TR>
				<TD>Name:</TD>
				<TD><strong><?echo $name;?></strong></TD>
			</TR>
			<TR>
				<TD valign="top">Description:</TD>
				<TD valign="top"><textarea cols="25" rows="5" name="descr"><?echo $descr;?></textarea></TD>
			</TR>
			<TR>
				<TD colspan="2" align="center"><input class="button" type="submit" name="submit" value="Opslaan"></TD>
			</TR>
		</TABLE></CENTER></FORM>
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
	}
