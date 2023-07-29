<script language='JavaScript'>
	$page = "<?$self?>?fuseaction=pics.home&PhotoDate=";
	function visit(PicPage) {
		// If the selected file name isn't blank, send it to reader.
		if (PicPage != "") {
			location.href=$page+PicPage
		}
	}
</script>

<FORM name="myForm" ACTION="<?echo $self?>">
<div align="right">
	<SELECT NAME="PhotoDate" onchange=visit(this.options[selectedIndex].value)>
		<option value="20020209" <?if ($PhotoDate=="20020209"){echo "selected";}?>>February 9th, 2002</option>
		<option value="20020120" <?if ($PhotoDate=="20020120"){echo "selected";}?>>January 20th, 2002</option>
		<option value="20011231" <?if ($PhotoDate=="20011231"){echo "selected";}?>>December 31st, 2001</option>
		<option value="20011230" <?if ($PhotoDate=="20011230"){echo "selected";}?>>December 30th, 2001</option>
		<option value="20011128" <?if ($PhotoDate=="20011128"){echo "selected";}?>>November 28th, 2001</option>
		<option value="20011123" <?if ($PhotoDate=="20011123"){echo "selected";}?>>November 23rd, 2001</option>
		<option value="20011031" <?if ($PhotoDate=="20011031"){echo "selected";}?>>October 31st, 2001</option>
		<option value="20011002" <?if ($PhotoDate=="20011002"){echo "selected";}?>>October 2nd, 2001</option>
		<option value="20010926" <?if ($PhotoDate=="20010926"){echo "selected";}?>>September 26th, 2001</option>
		<option value="20010924" <?if ($PhotoDate=="20010924"){echo "selected";}?>>September 24th, 2001</option>
		<option value="20010922" <?if ($PhotoDate=="20010922"){echo "selected";}?>>September 22nd, 2001</option>
		<option value="20010918" <?if ($PhotoDate=="20010918"){echo "selected";}?>>September 18th, 2001</option>
		<option value="20010914" <?if ($PhotoDate=="20010914"){echo "selected";}?>>September 14th, 2001</option>
		<option value="20010909" <?if ($PhotoDate=="20010909"){echo "selected";}?>>September 9th, 2001</option>
		<option value="20010907" <?if ($PhotoDate=="20010907"){echo "selected";}?>>September 7th, 2001</option>
		<option value="20010901" <?if ($PhotoDate=="20010901"){echo "selected";}?>>September 1st, 2001</option>
		<option value="20010819" <?if ($PhotoDate=="20010819"){echo "selected";}?>>August 19th, 2001</option>
		<option value="20010817" <?if ($PhotoDate=="20010817"){echo "selected";}?>>August 17th, 2001</option>
		<option value="20010616" <?if ($PhotoDate=="20010616"){echo "selected";}?>>June 16th to August 14th, 2001</option>
		<option value="20010617" <?if ($PhotoDate=="20010617"){echo "selected";}?>>June 17th, 2001</option>
		<option value="Ultrasounds" <?if ($PhotoDate=="Ultrasounds"){echo "selected";}?>>Ultrasounds</option>
	</SELECT>
</div>
</FORM>