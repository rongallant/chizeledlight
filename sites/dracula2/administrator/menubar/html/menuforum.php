<?php 
/**
*	Mambo Open Source Version 4.0.12
*	Dynamic portal server and Content managment engine
*	20-01-2003
*
*	Copyright (C) 2000 - 2003 Miro International Pty. Limited
*	Distributed under the terms of the GNU General Public License
*	This software may be used without warranty provided these statements are left
*	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*	This code is Available at http://sourceforge.net/projects/mambo
*
*	Site Name: Mambo Open Source Version 4.0.12
*	File Name: menuforum.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 20-01-2003
* 	Version #: 4.0.12
*	Comments:
*


class menuforum {
		function NEW_MENU_Forum($option){ ?>
			<TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
			<TR>
				<TD WIDTH="47%" VALIGN="top"><?php include ("menubar/mainmenu.php"); ?></TD>
				<TD VALIGN="top" ROWSPAN="3" WIDTH="32" ALIGN="right"><img name="endcap" src="../images/admin/endcap.gif" width="32" height="63" border="0" VSPACE="0" HSPACE="0"></TD>
				<TD VALIGN="bottom" BGCOLOR="#999999" WIDTH="51%">
					<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="99%" BGCOLOR="#999999">
					<TR>
						<TD WIDTH="50" ALIGN='center'><A HREF="javascript:submitbutton('savenew', 'Forums');" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('save','','../images/admin/save_f2.gif',1);"><IMG SRC="../images/admin/save.gif" ALT="Save" WIDTH="36" HEIGHT="47" BORDER="0" NAME="save" HSPACE="10" VSPACE="0"></A></TD>
						<TD WIDTH="50" ALIGN='center'><A HREF="javascript:window.history.go(-1);" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('cancel','','../images/admin/cancel_f2.gif',1);"><IMG SRC="../images/admin/cancel.gif" ALT="Cancel" WIDTH="34" HEIGHT="47" BORDER="0" NAME="cancel" HSPACE="10" VSPACE="0"></A></TD>
						<TD WIDTH="470">&nbsp;</TD>
					</TR>
					</TABLE>
				</TD>
			</TR>
			<TR>
				<TD WIDTH="370">&nbsp;</TD>
				<TD VALIGN="bottom" ALIGN="left" BGCOLOR="#999999"><img name="shadow" src="../images/admin/shadow.gif" width="100%" height="10" border="0" VSPACE="0" HSPACE="0"></TD>
			</TR>
			</TABLE>
		<?php 	}
		
		function EDIT_MENU_Forum($option, $comcid, $publish){ ?>
			<TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
			<TR>
				<TD WIDTH="47%" VALIGN="top"><?php include ("menubar/mainmenu.php"); ?></TD>
				<TD VALIGN="top" ROWSPAN="3" WIDTH="32" ALIGN="right"><img name="endcap" src="../images/admin/endcap.gif" width="32" height="63" border="0" VSPACE="0" HSPACE="0"></TD>
				<TD VALIGN="bottom" BGCOLOR="#999999" WIDTH="51%">
					<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="99%" BGCOLOR="#999999">
					<TR>
					<?php 	if ($publish == 0){?>
							<td width="50" BGCOLOR="#999999" VALIGN="bottom" ALIGN="center"><a href="javascript:submitbutton('publish', 'Forums');" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('publish','','../images/admin/publish_f2.gif',1);"><img name="publish" src="../images/admin/publish.gif" width="32" HEIGHT="47" border="0" HSPACE="10" VSPACE="0"></a></td>
					<?php 		}
						else {?>
							<td width="50" BGCOLOR="#999999" VALIGN="bottom" ALIGN="center"><a href="javascript:submitbutton('unpublish', 'Forums');" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('Unpublish','','../images/admin/Unpublish_f2.gif',1);" ><img name="Unpublish" src="../images/admin/Unpublish.gif" width="45" HEIGHT="47" border="0" HSPACE="10" VSPACE="0"></a></td>
					<?php 		}?>
						<TD WIDTH="50" ALIGN='center'><A HREF="javascript:submitbutton('saveedit', 'Forums');" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('save','','../images/admin/save_f2.gif',1);"><IMG SRC="../images/admin/save.gif" ALT="Save" WIDTH="36" HEIGHT="47" BORDER="0" NAME="save" HSPACE="10" VSPACE="0"></A></TD>
						<TD WIDTH="50" ALIGN='center'><A HREF="javascript:document.location.href='menubar/cancel.php?option=<?php echo $option; ?>&id=<?php echo $comcid; ?>'" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('cancel','','../images/admin/cancel_f2.gif',1);"><IMG SRC="../images/admin/cancel.gif" ALT="Cancel" WIDTH="34" HEIGHT="47" BORDER="0" NAME="cancel" HSPACE="10" VSPACE="0"></A></TD>
						<TD WIDTH="470">&nbsp;</TD>
					</TR>
					</TABLE>
				</TD>
			</TR>
			<TR>
				<TD WIDTH="370">&nbsp;</TD>
				<TD VALIGN="bottom" ALIGN="left" BGCOLOR="#999999"><img name="shadow" src="../images/admin/shadow.gif" width="100%" height="10" border="0" VSPACE="0" HSPACE="0"></TD>
			</TR>
			</TABLE>
		<?php 	}
		
		function DEFAULT_MENU_Forum(){?>
			<TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
			<TR>
				<TD WIDTH="47%" VALIGN="top"><?php include ("menubar/mainmenu.php"); ?></TD>
				<TD VALIGN="top" ROWSPAN="3" WIDTH="32" ALIGN="right"><img name="endcap" src="../images/admin/endcap.gif" width="32" height="63" border="0" VSPACE="0" HSPACE="0"></TD>
				<TD VALIGN="bottom" BGCOLOR="#999999" WIDTH="51%">
					<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="99%" BGCOLOR="#999999">
					<TR>
    					<td width="50" BGCOLOR="#999999" VALIGN="bottom" ALIGN="center"><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select a forum to publish'); } else {submitbutton('publish', '');}" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('publish','','../images/admin/publish_f2.gif',1);"><img name="publish" src="../images/admin/publish.gif" width="32" HEIGHT="47" border="0" HSPACE="10" VSPACE="0"></a></td>
						<td width="50" BGCOLOR="#999999" VALIGN="bottom" ALIGN="center"><a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select a forum to unpublish'); } else {submitbutton('unpublish', '');}" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('Unpublish','','../images/admin/Unpublish_f2.gif',1);" ><img name="Unpublish" src="../images/admin/Unpublish.gif" width="45" HEIGHT="47" border="0" HSPACE="10" VSPACE="0"></a></td>
						<TD WIDTH="50" ALIGN='center' BGCOLOR="#999999" VALIGN="bottom"><A HREF="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select a forum to archive'); } else {submitbutton('archive', '');}" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('archive','','../images/admin/archive_f2.gif',1);"><IMG SRC="../images/admin/archive.gif" ALT="Archive" WIDTH="35" HEIGHT="47" BORDER="0" NAME="archive" HSPACE="10" VSPACE="0"></A></TD>
						<TD WIDTH="50" ALIGN='center' BGCOLOR="#999999" VALIGN="bottom"><A HREF="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select a forum to unarchive'); } else {submitbutton('unarchive', '');}" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('unarchive','','../images/admin/unarchive_f2.gif',1);"><IMG SRC="../images/admin/unarchive.gif" ALT="Unarchive" WIDTH="44" HEIGHT="47" BORDER="0" NAME="unarchive" HSPACE="10" VSPACE="0"></A></TD>
						<TD WIDTH="50" BGCOLOR="#999999" VALIGN="bottom" ALIGN="center"><A HREF="javascript:submitbutton('new', '');" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('new','','../images/admin/new_f2.gif',1);"><IMG SRC="../images/admin/new.gif"  WIDTH="31" HEIGHT="47" VALUE="new" BORDER="0" NAME="new" HSPACE="10" VSPACE="0"></A></TD>
						<TD WIDTH="50" BGCOLOR="#999999" VALIGN="bottom" ALIGN="center"><A HREF="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select a forum to edit'); } else {submitbutton('edit', '');}" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('edit','','../images/admin/edit_f2.gif',1);"><IMG SRC="../images/admin/edit.gif" NAME="edit" ALT="Edit" WIDTH="34" HEIGHT="47" BORDER="0" HSPACE="10" VSPACE="0"></A></TD>			    
						<TD WIDTH="50" BGCOLOR="#999999" VALIGN="bottom" ALIGN="center"><A HREF="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please select a forum to delete'); } else if (confirm('Are you sure you want to delete selected items, this will also delete any threads in this forum')){ submitbutton('remove');}" onMouseOut="MM_swapImgRestore();"  onMouseOver="MM_swapImage('delete','','../images/admin/delete_f2.gif',1);"><IMG SRC="../images/admin/delete.gif" ALT="Delete" WIDTH="34" HEIGHT="47" BORDER="0" NAME="delete" HSPACE="10" VSPACE="0"></TD>
						<TD WIDTH="270">&nbsp;</TD>
					</TR>
					</TABLE>
				</TD>
			</TR>
			<TR>
				<TD WIDTH="370">&nbsp;</TD>
				<TD VALIGN="bottom" ALIGN="left" BGCOLOR="#999999"><img name="shadow" src="../images/admin/shadow.gif" width="100%" height="10" border="0" VSPACE="0" HSPACE="0"></TD>
			</TR>
			</TABLE>
		<?php 	}
}


*/
?>
