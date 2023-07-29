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
$i = 0;
?>
<script type="text/javascript">
function checkUncheckAll(oCheckbox)
	{
	var el, i = 0, bWhich = oCheckbox.checked, oForm = oCheckbox.form;
	while (el = oForm[i++]) 
		if (el.type == 'checkbox') el.checked = bWhich;
	}
</script>
<?
if ($submit)
	{
	if ($catid != "")
		{
		foreach($catid as $cid)
			{
			//Fetch directoryname
			$sql = "SELECT * FROM ".$dbprefix."gallery WHERE id=$cid";
			$result = $database->openConnectionWithReturn($sql);
			$row = mysql_fetch_object($result);
			$dir = $row->catdir;
			$gallery = $row->catname;
			$dir = $imagepath.$dir;
			
			//Empty and delete directory
			deldir($dir);
			//Delete from database
			$sql1 = "DELETE FROM ".$dbprefix."gallery WHERE id=$cid";
			$result = $database->openConnectionNoReturn($sql1);
			}
			?>
		<SCRIPT>
			alert("<?echo _GALLERY_ALERT_DEL;?>");
			location = "index.php?option=com_gallery&page=delete";
		</SCRIPT>
		<?
		}
	else
		{
		//No checkbox selected, back to delete screen
		?>
		<SCRIPT>
			alert("<?echo _GALLERY_ALERT_NOCHECKBOX;?>");
			location = "index.php?option=com_gallery&page=delete";
		</SCRIPT>
		<?
		}
	}
else
	{
	//Lijst met gallerijen laten zien
	$sql = "SELECT * FROM ".$dbprefix."gallery";
	$result = $database->openConnectionWithReturn($sql);
	$result = mysql_query($sql);
	?><br><br>
	<CENTER>
	<FORM  name="delete_cat" ACTION="index.php?option=com_gallery&page=delete" METHOD="POST">
	<TABLE width="300" border="0" cellspacing='1' cellpadding='4'>
		<TR>
			<TD  height='20' colspan="2" align="center"><h3><?echo _GALLERY_DEL;?></h3>
		</TR>
		<TR>
			<TD  height='20' width="50" class="sectiontableheader"><?echo _GALLERY_HD_CHECK;?></TD>
			<TD width="250" class="sectiontableheader"><?echo _GALLERY_HD_NAME;?></TD>
		</TR>
	<?
	while ($row = mysql_fetch_array($result))
				{
				$i++;
				$id = $row['id'];
				$catname = $row['catname'];
				$bgcolor = ($i & 1) ? '#EBEBEB' : '#ffffff';
				?>
				<TR bgcolor="<?echo $bgcolor;?>">
					<TD><input type="checkbox" name="catid[]" value="<?echo $id;?>"></TD>
					<TD><?echo $catname;?></TD>
				</TR>
				<?
				}
				?>
				<TR>
					<TD  height="20" class="sectiontableheader"><input type="checkbox" name="checkall" onclick="checkUncheckAll(this);"></TD>
					<TD  height="20" class="sectiontableheader"><strong>Check/Uncheck All</strong></TD>
				</TR>
				<TR>
					<TD colspan="2" align="center"><input class="button" type="submit" value="<?echo _GALLERY_DELETE;?>" name="submit"></TD>
				</TR>
				</TABLE></FORM>
				<?
	}
?>