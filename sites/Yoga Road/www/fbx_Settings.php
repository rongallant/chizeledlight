<? /*
<fusedoc fuse="fbx_Settings.php">
	<responsibilities>
		I set up the enviroment settings for this circuit. If this settings file is being inherited, then you can set a variable outright to override a value set in a parent circuit or use if(!isset(...)) to accept a value set by a parent circuit
	</responsibilities>	
</fusedoc>
*/

if($Fusebox["isHomeCircuit"]) {
//put settings here that you want to execute only when this is the application's home circuit (for example session_start(); )

	//In case no fuseaction was given, I'll set up one to use by default.
	if(!isset($attributes["fuseaction"])){ $attributes["fuseaction"] = "yoga.splash"; }
	
	//useful constants
	if(!isset($GLOBALS["self"])){ $GLOBALS["self"] = "index.php"; }
	
	if(!isset($title)){ $title = "Yoga Road"; }
	if(!isset($layout)){ $layout = "main"; }
	if(!isset($images)){ $images = "assets/themes/images"; }
	if(!isset($prods)){ $prods = "assets/images/products"; }
	if(!isset($prodthumbs)){ $prodthumbs = "assets/images/products"; }
	if(!isset($styles)){ $styles = "assets/themes/styles"; }
	if(!isset($email)){ $email = "info@yogaroad.net"; }
	
	
	//should fusebox silently suppress its own error messages? default is FALSE
	$Fusebox["suppressErrors"] = false;

} else {
//put settings here that you want to execute only when this is not an application's home circuit
	
}

?>