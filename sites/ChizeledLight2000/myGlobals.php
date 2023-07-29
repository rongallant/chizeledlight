<?php
/*
<fusedoc fuse="dsp_form.cfm" specification="2.0" language="ColdFusion">
	<responsibilities>I provide the user a form to add to the database.</responsibilities> 
	<properties>
		<history author="Ron Gallant" email="ron@chizeledlight.com" date="" role="architect" type="create" /> 
		<property name="difficulty" value="1" /> 
	</properties>
	<io>
		<in>
		<string name="self" scope="variables" format="CFML" optional="false" /> 
		<string name="XFA.submitForm" scope="variables" format="CFML" optional="false" /> 
		</in>
		<out>
		<string name="userName" scope="formOrUrl" format="CFML" optional="false" /> 
		<string name="password" scope="formOrUrl" comments="password" format="CFML" optional="false" /> 
		<string name="fuseaction" scope="formOrUrl" format="CFML" optional="false" /> 
		</out>
	</io>
</fusedoc>
*/

if ( !isset($theme) ) {
	$theme = 'Blue';
}

if($_GET["theme"]) {
	$theme = $_GET["theme"];
}

$phpRoot = './';
$myDomain = 'http://www.rongallant.com/';
$myEmail = 'ron@chizeledlight.com';
$myGraphics = 'assets/images';
$images = 'assets/images';
$myTheme = $phpRoot . 'assets/Themes/';
$myTemplates = $phpRoot . 'assets/templates/';
$mySSL = 'https://rongallant.com/sites/ChizeledLight2000/';
$mySSLCGI = 'https://hora.safe-order.net/cgi-chizeledlight/';
$self = $PATH_INFO;
?>
