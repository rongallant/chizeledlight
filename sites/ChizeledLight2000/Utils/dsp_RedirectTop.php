<SCRIPT Language="Javascript"> 
<!-- 
function RemoveFrames() 
{ 
   parent.location.href = parent.LinksFrame.document.forms[0].elements[0].value; 
   return false; 
} 

function OpenPopup(strFileName) 
{ 
   popupWnd=window.open(strFileName, 
      "PopupWindow", 
      "toolbar=no,width=370,height=240,directories=no,status=no,scrollbars=yes,resize=no,menubar=no"); 
} 
//--> 
</SCRIPT> 

<!--javascript:top.location = parent.document.referrer;"--> 

<style>
DIV.Links {
	font-weight: bold;
	color: white;
	}

</style>

<body marginheight="0" marginwidth="0" topmargin="0">

<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="2">
	<TR>
		<TD ALIGN="CENTER" NOWRAP>
			<a class="TopFrame" href="<? echo $backlink; ?>" target="_top"><? echo $backtext; ?></a>
			|
			<a class="TopFrame" href="<? echo $url; ?>" target="_top">Remove Frame</A>
		</TD>
	</TR>
</TABLE>

</body>

