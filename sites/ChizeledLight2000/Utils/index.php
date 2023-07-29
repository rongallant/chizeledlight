<?php
/*
if you are placing your Fusebox application above the web root,
	use chdir() to allow relative includes and requires.
	(ex: chdir("../fuseboxRoot/");)
*/
// chdir("../fuseboxRoot/");

/*
In order to use Search Engine Safe URLs
	(ex: http://127.0.0.1/index.php/fuseaction/shoppingcart/additems/127,88/myvar/hello+world)
	uncomment the line 'require("fbx_SearchEngineSafe.php");'
*/

// require("fbx_SearchEngineSafe.php");

// require the core FuseBox
require("fbx_Fusebox3.0_PHP4.0.6.php");

?>