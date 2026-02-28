
<DIV STYLE="padding-left: 10px; color:black;">

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/index.php"){$menu1 = 'mainmenuOver';}
else {$menu1 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu1?>" HREF="<?=$htmlRoot?>/index.php">Homepage</A><BR>

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/info.php"){$menu2 = 'mainmenuOver';}
else {$menu2 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu2?>" HREF="<?=$htmlRoot?>/info.php">About Me</A><BR>

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/artwork.php"){$menu3 = 'mainmenuOver';}
else {$menu3 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu3?>" HREF="<?=$htmlRoot?>/artwork.php">Artwork</A><BR>

<?PHP if (stristr($PATH_INFO, '<?=$htmlRoot?>/pics') != FALSE OR stristr($PATH_INFO, 'photo') != FALSE){$menu4 = 'mainmenuOver';}
else {$menu4 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu4?>" HREF="<?=$htmlRoot?>/pics.php">Photographs</A><BR>

<?PHP if (stristr($PATH_INFO, '<?=$htmlRoot?>/links') != FALSE){$menu5 = 'mainmenuOver';}
else {$menu5 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu5?>" HREF="<?=$htmlRoot?>/links.php">Links</A><BR>

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/contact.php"){$menu6 = 'mainmenuOver';}
else {$menu6 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu6?>" HREF="<?=$htmlRoot?>/contact.php">Contact</A><BR>

<?PHP if (stristr($PATH_INFO, '<?=$htmlRoot?>/guestbook') != FALSE){$menu7 = 'mainmenuOver';}
else {$menu7 = 'mainmenu';} ?>
&#149;&nbsp;<A CLASS="<?echo $menu7?>" HREF="<?=$htmlRoot?>/guestbook/index.php">Guestbook</A><BR>

</DIV>


<P ALIGN="center"><A HREF="/september11.php"><IMG SRC="<?echo$images;?>/AmericanRibbon.gif" WIDTH="63" HEIGHT="100" BORDER="0"></A></P>