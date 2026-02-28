
<?PHP

if ($PATH_INFO == "/tools.php"){$menu1B = 'menuRightOver';}
else {$menu1B = 'menuRight';}

if ($PATH_INFO == "/updates.php"){$menu2B = 'menuRightOver';}
else {$menu2B = 'menuRight';}

if ($PATH_INFO == "/banners.php"){$menu3B = 'menuRightOver';}
else {$menu3B = 'menuRight';}

if ($PATH_INFO == "/DataBase/index.php"){$menu4B = 'menuRightOver';}
else {$menu4B = 'menuRight';}

if ($PATH_INFO == "/DataBase/index.php"){$menu5B = 'menuRightOver';}
else {$menu5B = 'menuRight';}

?>

<DIV STYLE="padding-left: 10px; color:black;">

<A HREF="<?=$htmlRoot?>/tools.php" CLASS="<?echo $menu1B?>">&#149;&nbsp;Site Settings</A><BR>

<A HREF="<?=$htmlRoot?>/banners.php" CLASS="<?echo $menu3B?>">&#149;&nbsp;Banners</A><BR>

<A HREF="<?=$htmlRoot?>/updates.php" CLASS="<?echo $menu4B?>">&#149;&nbsp;Updates</A><BR>

<A HREF="javascript:popupPage('<?=$htmlRoot?>/games/stoneroids/index.html', 'yes', 0, 0, 600, 550)" CLASS="menuright">&#149;&nbsp;Stoneroids</A><BR>

<A HREF="<?=$htmlRoot?>/Utils/index.php?fuseaction=utils.Redirect&url=/games/tetris/tetris.html" CLASS="menuright">&#149;&nbsp;Tetris</A><BR>

<?PHP if (stristr($PATH_INFO, "baby/") != FALSE){$menu7 = 'menuRightOver';}
else {$menu7 = 'menuRight';} ?>
<A CLASS="<?echo $menu7?>" HREF="/Utils/index.php?fuseaction=utils.Redirect&url=/other/baby/index.php">&#149;&nbsp;Baby Site</A><BR>

<?PHP if (stristr($PATH_INFO, "/baby.php") != FALSE){$menu7 = 'menuRightOver';}
else {$menu7 = 'menuRight';} ?>
<A CLASS="<?echo $menu7?>" HREF="/baby.php">&#149;&nbsp;Baby Pics</A><BR>

<A HREF="/Secure/index.php" CLASS="<?echo $menu2B?>">&#149;&nbsp;Admin</A><BR>

</DIV>

<P>&nbsp;</P>

<DIV ALIGN="center">
	<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0"><TR VALIGN="top"><TD>
	<A HREF="/artwork.php"><IMG SRC="/sites/assets/banners/artwork_ban.jpg" WIDTH="88" HEIGHT="31" ALT="Artwork" BORDER="0"></A><BR>
	<A HREF="/chizeled/index.html"><IMG SRC="/graphics/banners/chizeledani.gif" WIDTH=88 HEIGHT=31 ALT="Chizeled Light Interface" BORDER="0"></A><BR>
	<A HREF="http://www.ozoneasylum.com/"><IMG SRC="/sites/assets/banners/asylum.gif" WIDTH=88 HEIGHT=31 ALT="Ozone Asylum" BORDER="0"></A><BR>
	<A HREF="http://www.hypercall.de/index-e.htm"><IMG SRC="/sites/assets/images/wan.gif" WIDTH=88 HEIGHT=31 BORDER="0"></A><BR>
	<A HREF="/other/baby/index.php"><IMG SRC="/sites/baby/assets/images/button_baby.gif" WIDTH=88 HEIGHT=31 ALT="Baby" BORDER="0"></A><BR>
	<A HREF="http://www.php.net/"><IMG SRC="/sites/assets/banners/php-small-purple.gif" WIDTH="88" HEIGHT="31" ALT="PHP" BORDER="0"></A><BR>
	<A HREF="http://www.fusebox.org/"><IMG SRC="/sites/assets/banners/minifusebox.gif" WIDTH="88" HEIGHT="31" ALT="Fusebox" BORDER="0"></A><BR>
	<A HREF="http://www.mysql.com/"><IMG SRC="/sites/assets/banners/includesmysql-88.gif" WIDTH="88" HEIGHT="31" ALT="MySQL" BORDER="0"></A>
	</TD></TR></TABLE>
</DIV>

<P>&nbsp;</P>

