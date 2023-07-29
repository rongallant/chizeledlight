<?php
/*
Including this file before the core Fusebox 3.0 code will allow
	your application to support Search Engine Safe (SES) URLs
	ex: http://127.0.0.1/index.php/fuseaction/shoppingcart/additems/127,88/myvar/hello.htm
*/

//we use some List Functions in here
require_once("ListFunctions.php");

//initialize
$Fusebox = array();
$Fusebox["SES"] = array();

/*
-- $Fusebox["SES"]["displayBase"] = true; (default: true)
		allows you to use relative URLs in Fusebox apps using SES URLs
-- $Fusebox["SES"]["createAttributesList"] = true; (default: false)
		makes a variable called $Fusebox["SES"]["attributesList"]
		that contains a more traditional query string in the form of:
		"monkey=banana&foo=bar&var=value"
*/
$Fusebox["SES"]["displayBase"] = true;
$Fusebox["SES"]["createAttributesList"] = false;
if(!isset($GLOBALS["self"])) {
	$Fusebox["SES"]["fusebox"] = "index.php";
} else {
	$Fusebox["SES"]["fusebox"] = $GLOBALS["self"];
}

preg_match("/\w+\.php(.*)/i", $HTTP_SERVER_VARS["REQUEST_URI"], $matches);
$FB_["cleanPathInfo"] = ListRest($matches[0], "/");
$FB_["cleanPathInfo"] = ListFirst($FB_["cleanPathInfo"], "?");
if(strlen($FB_["cleanPathInfo"])) {
	//If you want to append .htm, .html or .php onto the end of your URL, 
	//	this will clean it so it doesn't affect your variables
	$FB_["cleanPathInfo"] = preg_replace("/(\.htm(l)?|\.php)$/i", "", $FB_["cleanPathInfo"]);
	if(strlen($FB_["cleanPathInfo"])) {
		for($i=1; $i<ListLen($FB_["cleanPathInfo"], "/"); $i+=2) {
			$FB_["SESAttributesVariable"] = ListGetAt($FB_["cleanPathInfo"], $i, "/");
			//This line allows you to escape slashes ("/") in your SES URLs:
			//	escape each "/" with "slash_"
			$FB_["SESAttributesValue"] = preg_replace("/slash_/i", "/", ListGetAt($FB_["cleanPathInfo"], $i+1, "/"));
			//This line allows you to escape empties ("") in your SES URLs:
			//	escape each "" with "null_"
			$FB_["SESAttributesValue"] = preg_replace("/^null_$/i", "", ListGetAt($FB_["cleanPathInfo"], $i+1, "/"));
			//next lines allow for querystring variables being passed as an array
			//ex:             "index.php/monkey[]/banana/monkey[]/chunks.htm"
			//is the same as: "index.php?monkey[]=banana&monkey[]=chunks"
			if(preg_match("/(.*)\[(.*)\]$/", $FB_["SESAttributesVariable"], $matches)) {
				$FB_["SESAttributesVariable"] = $matches[1];
				$attributes[$FB_["SESAttributesVariable"]][stripslashes($matches[2])] = $FB_["SESAttributesValue"];
			} else {
				$attributes[$FB_["SESAttributesVariable"]] = $FB_["SESAttributesValue"];
			}
			
			if($Fusebox["SES"]["createAttributesList"]) {
				$Fusebox["SES"]["attributesList"] = ListAppend($Fusebox["SES"]["attributesList"], $FB_["SESAttributesVariable"], "&");
				$Fusebox["SES"]["attributesList"] = ListAppend($Fusebox["SES"]["attributesList"], $FB_["SESAttributesValue"], "=");
			}
		}
	}
}

if($Fusebox["SES"]["displayBase"]) {
	$FB_["cleanScriptName"] = preg_replace("/[^\/]+\.php.*/i", "", $HTTP_SERVER_VARS["SCRIPT_NAME"]);
	if($HTTP_SERVER_VARS["SERVER_PORT"] != 80) {
		$FB_["base"] = "https://" . $HTTP_SERVER_VARS["SERVER_NAME"] . $FB_["cleanScriptName"];
	} else {
		$FB_["base"] = "http://" . $HTTP_SERVER_VARS["SERVER_NAME"] . $FB_["cleanScriptName"];
	}
	$Fusebox["baseHref"] = '<base href="'.$FB_["base"].'">';
}

//create the attributes array
$attributes = array_merge($_POST, $_GET); // GET overwrites POST

?>