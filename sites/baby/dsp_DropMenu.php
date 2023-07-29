
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
		<option value="<?echo$date?>" <?if ($PhotoDate=="20011128"){echo "selected";}?>><?echo$date?>
	</SELECT>
</div>
</FORM>