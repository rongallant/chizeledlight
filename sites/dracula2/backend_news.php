<?php
/**
* Backend for Mambo Open Source 4.0.12
* File Name: backend_news.php
* Developer: Robert Castley
* Date: 23-04-2003
* Version #: 2.02
* Comments: RSS News Generator.
* Install: Just copy the file into the Mambo root directory and then
*          provide a link to http://your-mambo-site.com/backend_news.php
*          You can call this file anytime via
*          http://your-mambo-site.com/backend_news.php
**/

include ("configuration.php");
header ("content-type: text/xml");
print ('<');
print ('?xml version="1.0" encoding="iso-8859-1"?');
print ('>'."\n");
print ('<!-- Mambo 4.0.12 RSS Generator Version 2.02 (24/04/2003)- Robert Castley -->'."\n");
print ('<!-- Copyright (C) 2000-2003 - '.$sitename.'-->'."\n");

?>
<rssfeeds version="0.1">
<channel>
<title><?php echo htmlspecialchars($sitename); ?></title>
<link><?php echo $live_site; ?></link>
<description>News Items</description>
<language>en</language>
<lastBuildDate><?php $date = date("d/m/y - H:i"); echo "$date GMT";?></lastBuildDate>
<image>
<link><?php echo $live_site; ?></link>
	<!--
	Change the following line to point to the image you wish to display
	-->
<url><?php echo $live_site; ?>/images/themes/theme_original/news_f2.gif</url> 
<title>Powered by Mambo Open Source</title> 
	<!--
	Uncomment this section if you need to set image widths
	<width>88</width> 
	<height>31</height>
	--> 
</image>
  
<?php
mysql_connect($host, $user, $password);
$query = "SELECT sid, title, introtext FROM ".$dbprefix."stories WHERE published='1'";
$result = mysql_db_query($db,$query) or die("Did not execute query");;
$num = mysql_num_rows($result);
$i=1;
$j=0;
while ($num>=$i) {
	$row = mysql_fetch_array($result);
	$title = $row["title"];
	$introtext = $row["introtext"];
	$id = $row["sid"];
	
	print ('<item>');
	print ('<title>'.htmlspecialchars($title).'</title>'."\n");
	print ('<link>'.$live_site.'/popups/newswindow.php?id='.$row["sid"].'</link>'."\n");
	$words = $introtext;
	$words = preg_replace("'<script[^>]*>.*?</script>'si","",$words);
	$words = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2 (\1)', $words);
	$words = preg_replace('/<!--.+?-->/','',$words);
	$words = preg_replace('/{.+?}/','',$words);
	$words = strip_tags($words);
	
	print ('<description>'.substr($words,0,100).'...</description>'."\n");
	print ('</item>'."\n");
	$i++;
}
?>
</channel>
</rssfeeds>
