
<DIV STYLE="padding-left:10px; color:black;">

<?PHP if ($PATH_INFO == "/tools.php"){$menu1 = 'mainmenuOver';}
else {$menu1 = 'mainmenu';} ?>
&#149;&nbsp;<A HREF="/tools.php" CLASS="<?echo $menu1?>">Site Settings</A><BR>

<?PHP if ($PATH_INFO == "/banners.php"){$menu2 = 'mainmenuOver';}
else {$menu2 = 'mainmenu';} ?>
&#149;&nbsp;<A HREF="/banners.php" CLASS="<?echo $menu2?>">Banners</A><BR>

<?PHP if ($PATH_INFO == "/updates.php"){$menu3 = 'mainmenuOver';}
else {$menu3 = 'mainmenu';} ?>
&#149;&nbsp;<A HREF="/updates.php" CLASS="<?echo $menu3?>">Updates</A><BR>

&#149;&nbsp;<A HREF="javascript:popupPage('/games/stoneroids/index.html', 'yes', 0, 0, 600, 550)" CLASS="mainmenu">Stoneroids</A><BR>

&#149;&nbsp;<A HREF="/Utils/index.php?fuseaction=utils.Redirect&url=/games/tetris/tetris.html" CLASS="mainmenu">Tetris</A><BR>

&#149;&nbsp;<A HREF="/Utils/index.php?fuseaction=utils.Redirect&url=/other/baby/index.php" CLASS="mainmenu">Baby Site</A><BR>

<?PHP if ($PATH_INFO == "/baby.php"){$menu2 = 'mainmenuOver';}
else {$menu2 = 'mainmenu';} ?>
&#149;&nbsp;<A HREF="/baby.php" CLASS="<?echo $menu2?>">Baby Pics</A><BR>

<?PHP if ($PATH_INFO == "/main.php"){$menu4 = 'mainmenuOver';}
else {$menu4 = 'mainmenu';} ?>
&#149;&nbsp;<A HREF="/Secure/index.php" CLASS="<?echo $menu4?>">Admin</A><BR>

</DIV>

<P>&nbsp;</P>

<?include("/www/chizeledlight/assets/Themes/Blue/dsp_ButtonAds.php");?>

<P>&nbsp;</P>

