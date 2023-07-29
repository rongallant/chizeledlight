<?
/*
<fusedoc fuse="fbx_Layouts.php">
	<responsibilities>
		 I set the theme cookie to 1 hour past so the browser will delete it.
	</responsibilities>	
	<io>
		<out>
			<string name="theme" />
		</out>
	</io>
</fusedoc>
*/


// set the expiration date to one hour ago
SetCookie("theme","$theme",-3600,"/",".chizeledlight.com"); // Delete cookie

?>