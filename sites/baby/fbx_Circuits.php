<?php
/*
<fusedoc fuse="fbx_Circuits.php">
	<responsibilities>
		I define the Circuits structure used with Fusebox 3.0.  Use slashes ("/") to delimit the circuit mapping, i.e.: $Fusebox["circuits"]["red"] = "home/folder/redCircuit";
	</responsibilities>	
	<io>
		<out>
			<string name="$Fusebox['circuits'][*]" comments="set a variable for each circuit name" />
		</out>
	</io>
</fusedoc>
*/

$Fusebox["circuits"]["baby"] = "baby";
$Fusebox["circuits"]["pics"] = "baby/pictures";
$Fusebox["circuits"]["admin"] = "baby/admin";
$Fusebox["circuits"]["login"] = "baby/admin/security";
?>