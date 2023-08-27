<?PHP $title = 'Chizeled Light - Upload Files';?> 

<?php include($domainRoot . 'assets/templates/main_header.php');?>

<H1>Upload Files</H1>

<DIV ALIGN="center">
<form method="post" action="upload.php" enctype="multipart/form-data"> 
	<input name="userfile[]" type="file"><BR>
	<input name="userfile[]" type="file"><BR>
	<input name="userfile[]" type="file"><BR>
	<input name="userfile[]" type="file"><BR>
	<input name="userfile[]" type="file"><BR>
	<input name="userfile[]" type="file"><BR>
	<P><input type="submit" value="Upload"></P>
</form>
</DIV>

<?php include($domainRoot . 'assets/templates/main_footer.php');?>

