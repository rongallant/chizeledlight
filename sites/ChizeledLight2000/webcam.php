<?php include(__DIR__ . '/myGlobals.php');?>
<?PHP $title = 'Chizeled Light - Webcam';?> 
<?php include(__DIR__ . '/../assets/templates/main_header.php');?>

<H1>Webcam</H1>

<script language="JavaScript">
	function reloadImage() {
		if (document.images) { 
			document.images.myImageName.src = '/webcam/cam.jpg?' + (new Date()).getTime(); 
			} 
			setTimeout('reloadImage()',2500); 
		} 
		setTimeout('reloadImage()',2500);

	function reloadImage2() { 
		if (document.images) {
			document.images.webcamalert.src = '/webcam/webcamalert.jpg?' + (new Date()).getTime(); 
		} 
		setTimeout('reloadImage2()', 2500); 
	} 
	setTimeout('reloadImage2()', 2500); 
</script>


<h3 align="center">WebCam</h3>

<div align="center"><img border="0" src="/webcam/cam.jpg" name="myImageName"></div>

<p>&nbsp;</p>

<h3 align="center">Security Image</h3>

<div align="center"><img border="0" src="/webcam/webcamalert.jpg" name="webcamalert"></div>

<?php include(__DIR__ . '/../assets/templates/main_footer.php');?>