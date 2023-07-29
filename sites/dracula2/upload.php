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
*	File Name: upload.php
*	Original Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 20-01-2003
* 	Version #: 4.0.12
*	Comments: Upload an image.
**/

include('configuration.php');
include('language/'.$lang.'/lang_upload.php');
include("regglobals.php");

?>
<html>
<head>
<title><?php echo _TITLE; ?></title>
<link rel="stylesheet" href="css/ie5.css" type="text/css">
</head>
<FORM ENCTYPE="multipart/form-data" ACTION="userpage.php" METHOD=POST NAME="filename">
	<table border=0 cellpadding=4 cellspacing=0 width=99% class="popupwindow">
		<TR>
			<TD align="left"><span class='articlehead'><?php echo _HEAD; ?></span></TD>
		</TR>
		<TR>
			<TD ALIGN="Left"><?php echo _FILE; ?>  <INPUT class="inputbox" NAME="userfile" TYPE="file"></TD>
		</TR>
		<TR>
			<TD><input type=hidden name="op" value="saveUpload">
				<input type=hidden name="type" value="<?php echo $type;?>">
				<input type="hidden" name="option" value="<?php echo $option;?>">
				<input type="hidden" name="uid" value="<?php echo $uid;?>">
				<input type="hidden" name="existingImage" value="<?php echo $existingImage;?>">
				<INPUT class="button" TYPE="submit" VALUE="Send File">
			</TD>
		</TR>
	</TABLE>
</FORM>
<a href="javascript:window.opener.focus; window.close();"><span class="small"><?php echo _CLOSE; ?></span></a>