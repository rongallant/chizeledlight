<?php
 session_start();
 $_SESSION["Ron"] = "Hi Again";
	/*
	if you are placing your Fusebox application above the web root,
		use chdir() to allow relative includes and requires.
		(ex: chdir("../fuseboxRoot/");)
	*/
//	chdir("/home/e-smith/files/ibays/archives/html/baby/");
	/*
	In order to use Search Engine Safe URLs
		(ex: http://127.0.0.1/index.php/fuseaction/shoppingcart/additems/127,88/myvar/hello+world)
		uncomment the line 'require("fbx_SearchEngineSafe.php");'
	*/
	//require("fbx_SearchEngineSafe.php");
	
	//require the core FuseBox
	
	// START Set Database values
	$mysql_host = "localhost";
	$mysql_login = "com.chizeledlight";
	$mysql_password = "cRedbilbo73#";
	$my_database = "sites_baby";
	$my_table = "baby";
	$comma = ",";
    global $sqlDbConnection;
    if(!isset($sqlDbConnection)) {
        $sqlDbConnection = new mysqli("$mysql_host", "$mysql_login", "$mysql_password", "$my_database")
            or die ("Could not select database");
    }
	// END Set Database values
 
	require("fbx_Fusebox3.0_PHP4.0.6.php");
?>