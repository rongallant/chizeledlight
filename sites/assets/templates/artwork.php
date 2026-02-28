<?PHP

if ($PATH_INFO == "/graphicdesign/index.php"){$menu1 = 'submenuOver';}
else {$menu1 = 'submenu';}

if ($PATH_INFO == "/webdesign/index.php"){$menu2 = 'submenuOver';}
else {$menu2 = 'submenu';}

if ($PATH_INFO == "/logodesign/index.php"){$menu3 = 'submenuOver';}
else {$menu3 = 'submenu';}

if ($PATH_INFO == "/websets/sets.php"){$menu4 = 'submenuOver';}
else {$menu4 = 'submenu';}

if ($PATH_INFO == "/backgrounds/textures.php"){$menu5 = 'submenuOver';}
else {$menu5 = 'submenu';}

?>

<DIV ALIGN="center" CLASS="SubMenuBg">

<A ID="<?echo $menu1?>" HREF="/graphicdesign/index.php"><B>Graphic Design</B></A> -
<A ID="<?echo $menu2?>" HREF="/webdesign/index.php"><B>Web Design</B></A> -
<A ID="<?echo $menu3?>" HREF="/logodesign/index.php"><B>Logo Design</B></A> -
<A ID="<?echo $menu4?>" HREF="/websets/sets.php"><B>Web Page Graphics</B></A> -
<A ID="<?echo $menu5?>" HREF="/backgrounds/textures.php">Background Textures</A>

</DIV>

