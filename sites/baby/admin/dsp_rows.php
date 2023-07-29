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

<TABLE CELLPADDING="3" CELLSPACING="0" BORDER="0" WIDTH="100%" RULES="rows">
<?php
	while ($row = mysqli_fetch_array($result)) {
		$id = $row["id"]; 
		$date = $row["date"];
		$news = stripslashes ($row["news"]);
		if (isset($attributes['offset'])) $offset = $attributes['offset']; else $offset="";
		print ("\n<tr valign='top'><td><strong>$date</strong>"); 
		print ("<span class='editfunc'>");
		print ("[<a href='index.php?fuseaction=admin.Edit&id=$id&offset=$offset'>edit</a>]");
		$deleteUrl = "index.php?fuseaction=admin.DeleteEntry&id=$id&offset=$offset";
		print ("[<a href=\"javascript:deleteEntry('$deleteUrl');\">delete</a>]"); 
		print ("</span>");
		print ("<br />$news</td></tr>");
	}
	print ("<TR><TD colspan='2'>");
?>
		</TD>
	</TR>
</TABLE>