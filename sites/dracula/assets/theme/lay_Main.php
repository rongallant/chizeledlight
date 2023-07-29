<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?echo$title;?></title>
	<link rel="STYLESHEET" type="text/css" HREF="assets/theme/style/Main.css">
</head>

<body bgcolor="red">

<table cellpadding="10" cellspacing="0" border="0" width="750" align="center">
	<tr valign="top">
		<td bgcolor="silver" width="200">
		<img src="assets/theme/images/pixel.gif" height="1" width="180"><br>
		<A HREF="<?echo$link?>html/index.html">Drac's Homepage</A><br><br>
		<A HREF="<?echo$link?>html/reflect.html">Drac's Books</A><br><br>
		<A HREF="<?echo$link?>html/cdttours.html">Dracula Tours in Romania</A><br><br>
		<A HREF="<?echo$link?>html/portrait.html">Drac's Pics</A><br><br>
		<A HREF="<?echo$link?>html/bulletin.html">Drac's Bulletin Board</A><br><br>
		<A HREF="<?echo$link?>html/links.html">Drac's Favorite Links</A><br><br>
		<A HREF="<?echo$link?>html/owner.html">About The Owner</A><br><br>
		<!-- 
		<A HREF="<?echo$link;?>html/docu.txt">New Documentary on DRACULA - updated</A><br><br>
		<A HREF="<?echo$link?>html/stoker.html">Bram Stoker, DRACULA and Vampires</A><br><br>
		<A HREF="<?echo$link?>html/tepes.html">Vlad the Impaler</A><br><br>
		<A target="_blank" HREF="http://www.stratford-festival.on.ca/syndra.ssi" target="_blank">DRACULA at the Stratford Festival</A><br><br>
		<A HREF="<?echo$link;?>html/drac2000.txt">DRACULA 2000</A><br><br>
		<A HREF="<?echo$link?>html/centcel.html">1997: The Dracula Centennial Year</A><br><br>
		<A HREF="<?echo$link?>html/dracland.html">Adventures in Draculand (travelog)</A><br><br>
		<A HREF="<?echo$link?>html/tsd.html">Transylvanian Society of Dracula</A><br><br>
		<A HREF="<?echo$link?>html/movies.html">Books, Movies and Publishers</A><br><br>
		<A HREF="<?echo$link?>html/winnball.html">DRACULA: The Royal Winnipeg Ballet</A><br><br>
		<A HREF="<?echo$link;?>html/counter.txt">Web Page Counter</A><br><br>
		 -->
		
 		</td>	
		<td bgcolor="#ffffff">

<?if(substr_count($page,".txt") != 0){print"<pre>";}?>

<?print trim($Fusebox["layout"]);?>

<?if(substr_count($page,".txt") != 0){print"</pre>";}?>

		</td>
	</tr>
</table>

</body>
</html>
