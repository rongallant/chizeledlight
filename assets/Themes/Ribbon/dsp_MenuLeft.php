
<DIV STYLE="padding-left: 10px; color:black;">

<?PHP if ($PATH_INFO == "./index.php"){$menu1 = 'mainmenuOver';}
else {$menu1 = 'mainmenu';} ?>
<A CLASS="<?echo $menu1?>" HREF="./index.php">&#149;&nbsp;Homepage</A><BR>

<?PHP if ($PATH_INFO == "./info.php"){$menu2 = 'mainmenuOver';}
else {$menu2 = 'mainmenu';} ?>
<A CLASS="<?echo $menu2?>" HREF="./info.php">&#149;&nbsp;About Me</A><BR>

<?PHP if ($PATH_INFO == "./artwork.php"){$menu3 = 'mainmenuOver';}
else {$menu3 = 'mainmenu';} ?>
<A CLASS="<?echo $menu3?>" HREF="./artwork.php">&#149;&nbsp;Artwork</A><BR>

<?PHP if (stristr($PATH_INFO, "pics") != FALSE OR stristr($PATH_INFO, 'photo') != FALSE){$menu4 = 'mainmenuOver';}
else {$menu4 = 'mainmenu';} ?>
<A CLASS="<?echo $menu4?>" HREF="./photographs/gallery/index.php">&#149;&nbsp;Photographs</A><BR>

<?PHP if (stristr($PATH_INFO, "links") != FALSE){$menu5 = 'mainmenuOver';}
else {$menu5 = 'mainmenu';} ?>
<A CLASS="<?echo $menu5?>" HREF="./links.php">&#149;&nbsp;Links</A><BR>

<?PHP if ($PATH_INFO == "./contact.php"){$menu6 = 'mainmenuOver';}
else {$menu6 = 'mainmenu';} ?>
<A CLASS="<?echo $menu6?>" HREF="./contact.php">&#149;&nbsp;Contact</A><BR>

<?PHP if (stristr($PATH_INFO, "guestbook") != FALSE){$menu7 = 'mainmenuOver';}
else {$menu7 = 'mainmenu';} ?>
<A CLASS="<?echo $menu7?>" HREF="./guestbook/index.php">&#149;&nbsp;Guestbook</A><BR>

</DIV>