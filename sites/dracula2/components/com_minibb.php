<?php
//MiniBB Forum//

/**
* MiniBB Forum (Copyright (C) 2001-2002 miniBB.net)
*	File Name: com_minibb.php
*	Date: 06-23-2003
* License: GNU General Public License
* Script Version#: 1.5a + Patch06-23-03
* MiniBB 1.5a MOS Integration: Matt Smith - mambo@clippersoft.net (http://mambo.clippersoft.net)
**/

function minibblogout($database, $dbprefix, $cook){
  	$cryptSessionCookie=md5($cook);
		$query="UPDATE ".$dbprefix."session SET guest=1, username='', userid='', usertype='', gid=0 where session_id='$cryptSessionCookie'";
		$database->openConnectionNoReturn($query);
		print"<script language='javascript'>\n"
		."<!--\n"
		."location.replace('index.php?option=logout')\n"
		."-->"
		."</script>";
}

If ($current=="bb_admin"){
  include("$absolute_path/components/minibb/bb_admin.php");
} else {
  include("$absolute_path/components/minibb/index.php");
}

?>
