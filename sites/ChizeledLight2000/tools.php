<?php include(__DIR__ . '/myGlobals.php');?>
<?PHP $title = 'Chizeled Light - Tools';?> 
<?php include(__DIR__ . '/../assets/templates/main_header.php');?>

<script>
	function setTheme(theme) {
		window.location = window.location.pathname + "?theme=" + escape(theme);
	}
</script>
<H1>Tools</H1>
<H2>Select Theme</H2>
<UL>
	<LI><A HREF="javascript: setTheme('blue')" >Select Blue Theme</A>
	<LI><A HREF="javascript: setTheme('green')">Select Green Theme</A>
	<LI><A HREF="javascript: setTheme('ribbon')">Select Ribbon Theme</A>
	<LI><A HREF="javascript: setTheme('breakfastjava')">Select Breakfast Java Theme</A>
</UL>
<P><A HREF="<?PHP echo $HTTP_REFERER; ?>">&lt;&lt; Back</A></P>

<?php include(__DIR__ . '/../assets/templates/main_footer.php');?>