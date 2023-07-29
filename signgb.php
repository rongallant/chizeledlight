<!-- Save this file to your server, modify it, and submit it. -->
<!-- If you add or modify form fields, you'll need to modify your guestbook entry template -->
<html><head>
<title>Ron's Place! - Sign Guestbook</title>

<?PHP include("parts/header.inc"); ?>

<DIV ALIGN="center"><TABLE WIDTH="585" CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR><TD>
<DIV ALIGN="center"><IMG SRC="graphics/signhere.gif" WIDTH=289 HEIGHT=61 ALT="Sign Here" BORDER="0"><BR>
<A HREF="index.php"><IMG SRC="assets/images/url.gif" BORDER="0"></A>
</DIV>


<!-- Do NOT change this next line of HTML (the form tag) -->
<form method="post" action="http://jupiter.guestworld.com/wgb/wgb.deluxe.dbm?owner=redchevelle">

<input type=hidden name="comments_required" value="What's a guest without comments? :)">
<input type=hidden name="name_required" value="What's a guest without a name? :)">
<input type=hidden name=age_integer value="You must supply an integer in the <b>age</b> field!">
<input type=hidden name=age_range value="MIN=1 MAX=99">
<DIV ALIGN="center"><TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="490"><TR><TD ALIGN="right">

<B>Your Name:</B>
</TD><TD>
<input name="name" size=40 maxlength=60 STYLE="font-family:Arial; color:black; background:beige; border-style:solid">
</TD></TR><TR><TD ALIGN="right">
<B>Your Email:</B>
</TD><TD>
<input name="email" size=40 maxlength=128 STYLE="font-family:Arial; color:black; background:beige; border-style:solid">
</TD></TR><TR><TD ALIGN="right">
<B>Where are you from?</B>
</TD><TD>
<input name="location" size=40 maxlength=128 STYLE="font-family:Arial; color:black; background:beige; border-style:solid">
</TD></TR><TR><TD ALIGN="right">
<B>Homepage URL:</B>
</TD><TD>
<input name="homepage" value="http://" size=40 maxlength=128  STYLE="font-family:Arial; color:black; background:beige; border-style:solid">
</TD></TR><TR><TD ALIGN="right">
<B>Homepage Title:</B>
</TD><TD>
<input name="hometitle" size=40 maxlength=128 STYLE="font-family:Arial; color:black; background:beige; border-style:solid">
</TD></TR><TR><TD ALIGN="right">
<B>How did you find me?</B>
</TD><TD>
<SELECT NAME="reference" STYLE="font-family:Arial; color:black; background:beige; border-style:solid">
<OPTION value="Did Not Respond" selected>Select
<OPTION>Just Surfed On In
<OPTION>Search Engine
<OPTION>From a Friend
<OPTION>PickYourBrainetc
<OPTION>Breakfast Java
<OPTION>NewsGroups
<OPTION>Viewing another Guestbook
<OPTION>--------------------------------------------------------------
</SELECT>

</TD></TR><TR><TD ALIGN="right" VALIGN="top">

<B>Comments:</B>
</TD><TD>
<TEXTAREA NAME="comments" COLS=43 ROWS=8 wrap="virtual" style="font-family:Arial; color:black; background:beige; border-style:solid"></textarea>

</TD></TR><TR><TD COLSPAN="2">

<P ALIGN="center"><input type="submit" value="Preview Entry" style="font-family:Arial; color:black; background:beige; border-style:solid"></P>

</form>
</TD></TR></TABLE></DIV>




<BR><BR>
<A HREF="webpanel.php"><IMG SRC="graphics/back.gif"
 WIDTH=53 HEIGHT=53 ALT="Back" BORDER="0"></A><A HREF="index.php" TARGET="_top"><IMG
 SRC="graphics/home.gif" WIDTH=53 HEIGHT=53 ALT="Home" BORDER="0"></A><A
 HREF="http://jupiter.guestworld.tripod.lycos.com/wgb/wgbview.deluxe.dbm?owner=redchevelle"><IMG
 SRC="graphics/next.gif" WIDTH=53 HEIGHT=53 ALT="Next" BORDER="0"></A>
<HR>
<FONT FACE="Arial, Helvetica" SIZE="1">
<?PHP include("parts/menu.inc"); ?><P>
</FONT><P>

<DIV ALIGN="center"><!-- BEGIN WEBSIDESTORY CODE v5 -->
<!-- COPYRIGHT 1998-1999 WEBSIDESTORY, INC. ALL RIGHTS RESERVED.  U.S. PATENT PENDING. -->
<p align="center"><A HREF="http://rd1.hitbox.com/rd?acct=WQ590820C8CE62EN0&p=s">
<IMG SRC="graphics/banners/hitbox.gif?hc=w131&l=y&hb=WQ590820C8CE62EN0&cd=1&n=Sign+Guestbook" height=62 width=88 ALT="Click Here!" border=0></A></p>
<!-- END WEBSIDESTORY CODE  --></DIV>

<CENTER><A HREF="http://www.rons.place.cc/" TARGET="_top">
<FONT COLOR="silver" SIZE="-1">Graphics and design <B>&copy; Gallant Web
Design</B></A><BR><a href=http://www.GuestWorld.com/>http://www.GuestWorld.com/</a></FONT></CENTER>
</TD></TR></TABLE></DIV></body></html>