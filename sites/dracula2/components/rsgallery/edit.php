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
	//Wijzigingen opslaan
	$sql1 = "UPDATE ".$dbprefix."gallery SET catname = '$catname' WHERE id=$catid";
	$result1 = $database->openConnectionNoReturn($sql1);
	?>
	<SCRIPT>
		alert('<?echo _GALLERY_ALERT_EDITOK;?>');
		location = "index.php?option=com_gallery";
	</SCRIPT>
	<?
	}
else
	{
	//Get galleryname from DB and show in form
	$sql = "SELECT * FROM ".$dbprefix."gallery WHERE id=$catid";
	$result = $database->openConnectionWithReturn($sql);
	$row = mysql_fetch_object($result);
	?>
	
	<CENTER>
	<FORM action="index.php?option=com_gallery&page=edit" method="post">
	<input type="hidden" name="catid" value="<?echo $row->id;?>">
	<TABLE BORDER="0">
		<TR>
			<TD COLSPAN="2" align="center"><h3><?echo _GALLERY_EDIT;?></h3></TD>
		</TR>
		<TR>
			<TD><?echo _GALLERY_FORMCREATE_NAME;?>:</TD><TD><input  class="inputbox" type="text"  size="30" name="catname" value="<?echo $row->catname;?>"></TD>
		</TR>
		<TR>
			<TD colspan="2" align="center"><br><br><input  class="button" type="submit" name="submit" value="<?echo _GALLERY_BUTTON_EDIT;?>"></TD>
		</TR>
	</TABLE>
	</FORM>
	</CENTER>
	<?
	}
?>