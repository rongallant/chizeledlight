<?PHP $title = 'Chizeled Light - Tools';?> 

<?php include ($phpRoot . 'assets/templates/main_header.inc');?>

<H1>Tools</H1>

<H2>Select Theme</H2>

<UL>
	<LI><A HREF="Utils/index.php?fuseaction=utils.Blue">Select Blue Theme</A>
	<LI><A HREF="Utils/index.php?fuseaction=utils.Green">Select Green Theme</A>
	<LI><A HREF="Utils/index.php?fuseaction=utils.Ribbon">Select Ribbon Theme</A>
	<LI><A HREF="Utils/index.php?fuseaction=utils.BreakfastJava">Select Breakfast Java Theme</A>
	<!-- <LI><A HREF="/Utils/index.php?fuseaction=utils.DeleteTheme">Delete Theme Cookie</A> -->
</UL>

<P><A HREF="<?PHP echo $HTTP_REFERER; ?>">&lt;&lt; Back</A></P>

<?php include ($phpRoot . 'assets/templates/main_footer.inc');?>
