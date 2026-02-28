
<DIV ALIGN="center" CLASS="SubMenuBg">

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/links.php"){$menu_1 = 'submenuOver';}
else {$menu_1 = 'submenu';} ?>
<A ID="<?echo $menu_1?>" HREF="<?=$htmlRoot?>/links.php">Websites I Have Done</A> -

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/links_friends.php"){$menu_2 = 'submenuOver';}
else {$menu_2 = 'submenu';} ?>
<A ID="<?echo $menu_2?>" HREF="<?=$htmlRoot?>/links_friends.php">Friends</A> -

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/links_tolkien.php"){$menu_3 = 'submenuOver';}
else {$menu_3 = 'submenu';} ?>
<A ID="<?echo $menu_3?>" HREF="<?=$htmlRoot?>/links_tolkien.php">J.R.R. Tolkien</A> -

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/links_PinkFloyd.php"){$menu_PinkFloyd = 'submenuOver';}
else {$menu_PinkFloyd = 'submenu';} ?>
<A ID="<?echo $menu_PinkFloyd?>" HREF="<?=$htmlRoot?>/links_PinkFloyd.php">Pink Floyd</A> -

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/links_knives.php"){$menu_knives = 'submenuOver';}
else {$menu_knives = 'submenu';} ?>
<A ID="<?echo $menu_knives?>" HREF="<?=$htmlRoot?>/links_knives.php">Knives</A> -

<?PHP if ($PATH_INFO == "<?=$htmlRoot?>/links_other.php"){$menu_4 = 'submenuOver';}
else {$menu_4 = 'submenu';} ?>
<A ID="<?echo $menu_4?>" HREF="<?=$htmlRoot?>/links_other.php">Misc</A>

</DIV>