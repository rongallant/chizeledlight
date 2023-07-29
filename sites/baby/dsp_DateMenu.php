<?PHP
	$photoUrl = $myself.$XFA['ViewPhoto'] . "&Pic=" . $images;
?>

<h1>History</h1>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr valign="top">
		<td width="100">
			<!-- These are the photos on the left -->
			<p align="center"><img src="assets/images/AmericanRibbon.gif" width="66" height="100" border="0"></p>
			<p><a href="<?print$photoUrl;?>/Luis_20011031_01.jpg"><img src="pictures/pictures/thumbs/Luis_20011031_01.jpg" width="100" height="100" border="0" alt="" /></a></p>
			<p><a href="<?print$photoUrl;?>/Luis_20011031_02.jpg"><img src="pictures/pictures/thumbs/Luis_20011031_02.jpg" width="100" height="100" border="0" alt="" /></a></p>
			<p><a href="<?print$photoUrl;?>/Luis_20011031_03.jpg"><img src="pictures/pictures/thumbs/Luis_20011031_03.jpg" width="100" height="100" border="0" alt="" /></a></p>
			<p><a href="<?print$photoUrl;?>/Luis_20011031_04.jpg"><img src="pictures/pictures/thumbs/Luis_20011031_04.jpg" width="100" height="100" border="0" alt="" /></a></p>
		</td>
		<td width="50"><img src="assets/images/pixel.gif" width="50" height="1" border="0"></td>
		<td>
			<ul>
				<?PHP
					$lastyear = "";
					while ($row = mysqli_fetch_array($result)) {
						$date = $row['date'];
						$daydate = displayDateNoYear($date);
						$thisyear = getYear($date);
						if ($lastyear != $thisyear) {
							$thisyear = $thisyear + 1;
							if ($row > 1) print ("</ul>");
							print ("<strong>".$thisyear."</strong><ul>");
						}
						print ("<li><a href='".$myself.$XFA['ViewEntry']."&date=".$date."'>".$daydate."</a>");
						$lastyear = getYear($date);
					}
				?>
			</ul>
		</td>
	</tr>
</table>