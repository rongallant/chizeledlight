<?php session_start(); ?>
<SCRIPT LANGUAGE="JavaScript">
	function VerifyDelete(newaction) {
		if (window.confirm("Are you sure you want to delete this entry?")) {
			document.myform.fuseaction.value = newaction; 
			document.myform.submit();
		}
	}
	function deleteEntry(pageUrl) {
		if (window.confirm("Are you sure you want to delete this entry?")) {
			window.location = pageUrl;
		}
	}
	function setFuseaction(newaction){ 
		document.myform.fuseaction.value = newaction; 
		document.myform.submit();
	}
</script> 
<H1>Baby - Luis Thomas Gallant</H1>
<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%">
	<TR VALIGN="top">
		<TD>
			<!-- These are the photos on the left -->
			<P ALIGN="center"><IMG SRC="assets/images/AmericanRibbon.gif" WIDTH="66" HEIGHT="100" BORDER="0"></P>
			<p><A HREF="<?echo $self;?>?fuseaction=<?echo $XFA['ViewPhoto'];?>&Pic=<?echo $images;?>/Luis_20020120_02.jpg"><IMG SRC="<?echo $thumbs;?>/Luis_20020120_02.jpg" WIDTH="100" HEIGHT="100" BORDER="0"></A></p>
			<p><A HREF="<?echo $self;?>?fuseaction=<?echo $XFA['ViewPhoto'];?>&Pic=<?echo $images;?>/Luis_20011231_04.jpg"><IMG SRC="<?echo $thumbs;?>/Luis_20011231_04.jpg" WIDTH="100" HEIGHT="100" BORDER="0"></A></p>
			<p><A HREF="<?echo $self;?>?fuseaction=<?echo $XFA['ViewPhoto'];?>&Pic=<?echo $images;?>/Luis_20011031_01.jpg"><IMG SRC="<?echo $thumbs;?>/Luis_20011031_01.jpg" WIDTH="100" HEIGHT="100" BORDER="0"></A></p>
			<p><A HREF="<?echo $self;?>?fuseaction=<?echo $XFA['ViewPhoto'];?>&Pic=<?echo $images;?>/Luis_20011230_02.jpg"><IMG SRC="<?echo $thumbs;?>/Luis_20011230_02.jpg" WIDTH="100" HEIGHT="100" BORDER="0"></A></p>
		</TD>
		<TD><IMG SRC="assets/images/pixel.gif" WIDTH="50" HEIGHT="1" BORDER="0" alt="" /></TD>
		<TD>
			<img src="assets/images/Luis_Drinking.gif" width="150" height="134" border="0" align="right" HSPACE="5" alt="Luis drinking" />
			<p>This is the website of Luis Thomas Gallant. Luis was born on June 16th, 2001 at 24 weeks gestation. Luis was 1.42 lbs and was 11 7/8 inches long making him a <a href="http://www.preemietwins.com/articles/what_is_a_preemie.htm">micro preemie</a>. After 4 months in the hospital and 6 months home on oxygen, Luis has grown up a healthy active child.</p>
			<br clear="both" />
			<h2>Luis' Blog</h2>
			<?PHP
				// setup needed variables
				if (isset($attributes["page"])) $page = $attributes["page"];
					else $page = 1;
				if (isset($attributes["prevlink"])) $prevlink = $attributes["prevlink"];
					else $prevlink = "";
				//output records
				while ($row = mysqli_fetch_array($result)) {
				   	$id = $row["id"];
				   	$urldate = $row["date"];
					$displaydate = displayDate($row['date']);
					$news = stripslashes ($row["news"]);
					$deleteUrl = "index.php?fuseaction=".$XFA['DeleteEntry']."&id=".$id."&page=".$page;
					
					if (isset($_SESSION['LoggedIn'])) {
						$links = "<span class='editfunc'>"
							."[<a href='index.php?fuseaction=".$XFA['EditEntry']."&id=$id&page=$page'>edit</a>]"
							."&nbsp;"
							."[<a href=\"javascript:deleteEntry('$deleteUrl');\">delete</a>]</span>";
					} else {
						$links = "";
					}
					print ("<div class='entry'>");
				 	if ($urldate != $LastDate) {
						print ("<h5><a href='".$myself.$XFA['ViewEntry']."&date=".$urldate."'>".$displaydate."</a></h5>");
					}
					print "<div class='content'>$news $links</div>";
					print ("</div>");
					$LastDate = $urldate;
				}
				// pagination
				$PaginateIt = new PaginateIt();
				$PaginateIt->SetLinksFormat( '<<', '&nbsp;&nbsp;', '>>' );
				$PaginateIt->SetItemCount($total_items);
				$PaginateIt->SetCurrentPage($attributes['page']);
				$PaginateIt->SetLinksToDisplay(5);
				print "<div class='pagination'>" . $PaginateIt->GetPageLinks() . "</div>";
			?>
		</TD>
	</TR>
</TABLE>
