<?php
//*************************************************************************
//*                      Installation Instructions                        *
//*									  *	
//*  1) COPY this file, "configuration-dist.php", to "configuration.php"  *
//*     [if it doesn't exist]						  *
//*  2) EDIT this new file "configuration.php" to suit your database      *
//*     connection and other local/hosted settings. 			  *
//*************************************************************************
//



//*************************************************************************
//*                      Database configuration section                   *
//*************************************************************************
$host = 'localhost';		// This is normally set to localhost
$user = 'dracula';		// MySQL username
$password = 'redbilbo';		// MySQL password
$db = 'dracula';		// MySQL database name
$dbprefix = 'mos_';		// Do not change unless you need to!





//*************************************************************************
//*                      Site specific configuration                      *
//*************************************************************************
setlocale (LC_TIME, "en_GB");					// Country locale
$lang = 'eng';							// Site language
$absolute_path = '/usr/local/apache/htdocs/other/dracula2';	// No trailing slash
$live_site = 'http://www.chizeledlight.com/other/dracula2';	// No trailing slash
$sitename = "Dracula's Homepage";				// Name of Mambo site
$phpmyadmin = '/Secure/phpMyAdmin-2.4.0/index.php';		// Path to phpMyAdmin
$popup = 0;							// 0 = Off, 1 = On
$shownoauth = false;						// Display links &  categories users do not have access to





//*************************************************************************
//*              Do not change ANYTHING below this line !!!               *
//*************************************************************************
$local_backup_path = $absolute_path.'/administrator/backups';
$pdf_path = $absolute_path.'/pdf/';
$image_path = $absolute_path.'/images/stories';
$col = 3;
$row = 3;
if ($directory !='uploadfiles'){
	$title[0]='Story Images';
	$dir[0]=$absolute_path.'/images/stories';
	$picurl[0]=$live_site.'/images/stories/';
	$tndir[0]=$live_site.'/images/stories/';
} else {
	$title[0]='Uploaded File Images';
	$dir[0]=$absolute_path.'/uploadfiles/$Itemid';
	$picurl[0]=$live_site.'/uploadfiles/$Itemid';
	$tndir[0]=$live_site.'/uploadfiles/$Itemid';
}
include_once("$absolute_path/version.php");
?>
