
<DIV STYLE="padding-left: 10px; color:black;">

<?PHP if ($PATH_INFO == "./index.php"){$menu1 = 'mainmenuOver';}
else {$menu1 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu1?>" HREF="./index.php">Homepage</A><BR>

<?PHP if ($PATH_INFO == "./info.php"){$menu2 = 'mainmenuOver';}
else {$menu2 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu2?>" HREF="./info.php">About Me</A><BR>

<?PHP if ($PATH_INFO == "./artwork.php"){$menu3 = 'mainmenuOver';}
else {$menu3 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu3?>" HREF="./artwork.php">Artwork</A><BR>

<?PHP if (stristr($PATH_INFO, 'pics') != FALSE OR stristr($PATH_INFO, 'photo') != FALSE){$menu4 = 'mainmenuOver';}
else {$menu4 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu4?>" HREF="./photographs/gallery/index.php">Photographs</A><BR>

<?PHP if (stristr($PATH_INFO, 'links') != FALSE){$menu5 = 'mainmenuOver';}
else {$menu5 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu5?>" HREF="./links.php">Links</A><BR>

<?PHP if ($PATH_INFO == "./contact.php"){$menu6 = 'mainmenuOver';}
else {$menu6 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu6?>" HREF="./contact.php">Contact</A><BR>

<?PHP if (stristr($PATH_INFO, 'guestbook') != FALSE){$menu7 = 'mainmenuOver';}
else {$menu7 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu7?>" HREF="./guestbook/index.php">Guestbook</A><BR>

</DIV>


<P ALIGN="center"><A HREF="./september11.php"><IMG SRC="./assets/banners/AmericanRibbon.gif" WIDTH="63" HEIGHT="100" BORDER="0"></A></P>