<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML><HEAD>

<BASE TARGET="main">

<SCRIPT language="JavaScript">
var browserName = navigator.appName;browserVer = parseInt ( navigator.appVersion );
var version = "n2";
if ( browserName == "Netscape" && browserVer >= 3 ) version = "n3";
if ( browserName == "Microsoft Internet Explorer" && browserVer >=4 ) version = "e4";

home_on = new Image ( 92, 34 );
home_off = new Image ( 92, 34 );;
home_on.src = "graphics/menu/home_on.gif";
home_off.src = "graphics/menu/home_off.gif";

aboutme_on = new Image ( 132, 34 );
aboutme_off = new Image ( 132, 34 );
aboutme_on.src = "graphics/menu/aboutme_on.gif";
aboutme_off.src = "graphics/menu/aboutme_off.gif";

graphics_on = new Image ( 131, 34 );
graphics_off = new Image ( 131, 34 );
graphics_on.src = "graphics/menu/graphics_on.gif";
graphics_off.src = "graphics/menu/graphics_off.gif";

links_on = new Image ( 83, 34 );
links_off = new Image ( 83, 34 );
links_on.src = "graphics/menu/links_on.gif";
links_off.src = "graphics/menu/links_off.gif";

feedback_on = new Image ( 140, 34 );
feedback_off = new Image ( 140, 34 );
feedback_on.src = "graphics/menu/feedback_on.gif";
feedback_off.src = "graphics/menu/feedback_off.gif";

function button_on ( imgName )
{
if ( version == "n3" || version == "e4" )
{
butOn = eval ( imgName + "_on.src" );
document [imgName].src = butOn;
}
}

function button_off ( imgName )
{
if ( version == "n3" || version == "e4" )
{
butOff = eval ( imgName + "_off.src" );
document [imgName].src = butOff;
}
}
</SCRIPT>

</HEAD>

<BODY TOPMARGIN="3" BACKGROUND="graphics/bg.jpg" BGCOLOR="#442D0D">

<DIV ALIGN="center">
<A HREF="index.php" TARGET="_top" ONMOUSEOUT="button_off('home'); return true" ONMOUSEOVER="button_on('home'); return true"><IMG SRC="graphics/menu/home_off.gif" WIDTH=92 HEIGHT=34 ALT="Home" BORDER="0" NAME="home"></A><A HREF="info.php" ONMOUSEOUT="button_off('aboutme'); return true" ONMOUSEOVER="button_on('aboutme'); return true"><IMG SRC="graphics/menu/aboutme_off.gif" WIDTH=132 HEIGHT=34 ALT="About Me" BORDER="0" NAME="aboutme"></A><A HREF="artwork.php" ONMOUSEOUT="button_off('graphics'); return true" ONMOUSEOVER="button_on('graphics'); return true"><IMG SRC="graphics/menu/graphics_off.gif" WIDTH=131 HEIGHT=34 ALT="Graphics" BORDER="0" NAME="graphics"></A><A HREF="morepages.php" ONMOUSEOUT="button_off('links'); return true" ONMOUSEOVER="button_on('links'); return true"><IMG SRC="graphics/menu/links_off.gif" WIDTH=83 HEIGHT=34 ALT="links" BORDER="0" NAME="links"></A><A HREF="webpanel.php" ONMOUSEOUT="button_off('feedback'); return true" ONMOUSEOVER="button_on('feedback'); return true"><IMG SRC="graphics/menu/feedback_off.gif" WIDTH=140 HEIGHT=34 ALT="Feedback" BORDER="0" NAME="feedback"></A>
</DIV></BODY></HTML>