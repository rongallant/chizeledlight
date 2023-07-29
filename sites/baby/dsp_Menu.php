<?php session_start(); ?>

<ul class="mainmenu">
	<li><a href="<?echo $self;?>?fuseaction=baby.home">Home</a></li>
	<li><a href="<?echo $self;?>?fuseaction=pics.home">Photos</a></li>
	<li><a href="<?echo $self;?>?fuseaction=baby.menu">History</a></li>
	<li><a href="<?echo $self;?>?fuseaction=baby.belly">The Belly</a></li>
	<li><a href="<?echo $self;?>?fuseaction=baby.mommy">Mommy</a></li>
	<li><a href="<?echo $self;?>?fuseaction=baby.daddy">Daddy</a></li>
	<li><a href="<?echo $self;?>?fuseaction=baby.bigsister">Big Sister</a></li>
	<li><a href="<?echo $self;?>?fuseaction=baby.babystuff">Baby Stuff</a></li>
</ul>

<?PHP
	session_start();
	// admin menu
	if (isset($_SESSION['LoggedIn'])) {
		echo (
			"<ul class='mainmenu'>"
			."<li><a href='$self?fuseaction=baby.babystuff'></a></li>"
			."<li><a href='$self?fuseaction=admin.Add'>New Entry</a></li>"
			."<li><a href='$self?fuseaction=login.adduser'>Add User</a></li>"
			."<li><a href='$self?fuseaction=login.logout'>Logout</a></li>"
			."</ul>"
		);
	}
?>
