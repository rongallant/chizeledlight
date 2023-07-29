<?php 
/**
*	Mambo Open Source Version 4.0.12
*	Dynamic portal server and Content managment engine
*	27-11-2002
*
*	Copyright (C) 2000 - 2003 Miro International Pty. Limited
*	Distributed under the terms of the GNU General Public License
*	This software may be used without warranty provided these statements are left
*	intact and a "Powered By Mambo" appears at the bottom of each HTML page.
*	This code is Available at http://sourceforge.net/projects/mambo
*
*	Site Name: Mambo Open Source Version 4.0.12
*	File Name: newsfeeds.php
*	Developers: Danny Younes - danny@miro.com.au
*				Nicole Anderson - nicole@miro.com.au
*	Date: 07-02-2003
* 	Version #: 4.0.12
*	Comments: Display News feeds.
**/
require_once("includes/rdf.class.php");
$rdf = new fase4_rdf;
$rdf->use_dynamic_display(true);
$rdf->set_Options( array("channel"=>"hidden", "build"=>"hidden", "cache_update"=>"hidden", "textinput"=>"hidden") );

$query = "SELECT name, link FROM ".$dbprefix."newsfeedslinks WHERE inuse='1'";
$result = $database->openConnectionWithReturn($query);
$query2 = "SELECT numnews FROM ".$dbprefix."components WHERE module='newsfeeds' AND publish=1 LIMIT 1";
$result2 = $database->openConnectionWithReturn($query2);
$numnews = mysql_fetch_row($result2);

$rdf->use_dynamic_display(false);
$rdf->set_CacheDir("$absolute_path/newsfeeds");
$rdf->set_table_width("98%");
$rdf->set_refresh(3600);
$rdf->set_max_item($numnews[0]);
$rdf->$_link_target = "_blank";

$timeUpdated = explode(" ", $rdf->get_cache_update_time( ));
echo "&nbsp;Last Updated: " . $timeUpdated[1] . "<br>&nbsp;\n";

while (list($name, $link) = mysql_fetch_row($result)){
	echo "<table width=\"98%\"><tr><td><div class=\"componentheading\">$name</div></td></tr></table>\n";
$rdf->parse_RDF("$link");
$rdf->finish();
}
?>
