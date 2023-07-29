<?PHP
	print ("<h1>History - ".displayDate($date)."</h1>");
?>
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%">
	<TR VALIGN="top">
		<TD WIDTH="100">
			<!-- These are the photos on the left -->
			<P ALIGN="center"><IMG SRC="assets/images/AmericanRibbon.gif" WIDTH="66" HEIGHT="100" BORDER="0" alt="9-11" /></P>
			<p><A HREF="<?echo$myself;?>pics.View&Pic=<?echo $images;?>/Luis_20011031_01.jpg"><IMG SRC="pictures/pictures/thumbs/Luis_20011031_01.jpg" WIDTH="100" HEIGHT="100" BORDER="0" alt="" /></A></p>
			<p><A HREF="<?echo$myself;?>pics.View&Pic=<?echo $images;?>/Luis_20011031_02.jpg"><IMG SRC="pictures/pictures/thumbs/Luis_20011031_02.jpg" WIDTH="100" HEIGHT="100" BORDER="0" alt="" /></A></p>
			<p><A HREF="<?echo$myself;?>pics.View&Pic=<?echo $images;?>/Luis_20011031_03.jpg"><IMG SRC="pictures/pictures/thumbs/Luis_20011031_03.jpg" WIDTH="100" HEIGHT="100" BORDER="0" alt="" /></A></p>
			<p><A HREF="<?echo$myself;?>pics.View&Pic=<?echo $images;?>/Luis_20011031_04.jpg"><IMG SRC="pictures/pictures/thumbs/Luis_20011031_04.jpg" WIDTH="100" HEIGHT="100" BORDER="0" alt="" /></A></p>
		</TD>
		<TD WIDTH="50"><IMG SRC="assets/images/pixel.gif" WIDTH="50" HEIGHT="1" BORDER="0" alt="" /></TD>
		<TD>
			<?PHP
				while ($row = mysqli_fetch_array($result)) {
				   	$date = $row["sqldate"];
					$news = stripslashes($row["news"]);
					print "<P>$news</P>";
				}
			?>
			<p><a href="javascript:history.back();"><< Back</a></p>
		</TD>
	</TR>
</TABLE>