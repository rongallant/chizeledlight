<?php
/*
<fusedoc fuse="fbx_DefaultLayout.cfm">
	<responsibilities>
		I'm just a typical layout file to show how I can wrap my layout around the content in the variable, fusebox.layout.  The $Fusebox["baseHref"] variable prints out a <base> tage when you use Search Engine Safe URLs.  It is required, so please leave it there.
	</responsibilities>	
	<io>
		<in>
			<string name="$Fusebox['layout']" />
		</in>
	</io>
</fusedoc>
*/

print trim($Fusebox["layout"]);


?>