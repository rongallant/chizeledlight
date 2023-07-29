<?php

$url = htmlspecialchars($_GET["url"]);

/* Google Chrome now blocks mixed content in iFrames. Doing redirect instead. Ron 20220-03-24 */
header('Location:' . $url);
die();

?>

<!-- <HTML> 
  <HEAD>
    <TITLE><? echo $sitetitle; ?> Link To: <? echo $linktitle; ?></TITLE>
  </HEAD> 
  <FRAMESET BORDER="0" ROWS="20,*"> 
    <FRAME NAME="LinksFrame" SRC="<? echo $self; ?>?fuseaction=utils.RedirectTop&backtext=<? echo $backtext; ?>&backlink=<? echo $backlink; ?>&url=<? echo $url ?>" scrolling=no noresize/> 
    <FRAME NAME="AnswerFrame" SRC="<? echo $url; ?>"/> 
    <NOFRAMES> 
      <BODY BGCOLOR="#FFFFFF"> 
        <p>Links Redirection works well only with frame-capable browsers. 
        Please upgrade your browser to take advantage of this script. 
        </p> 
        <P>Click on the link to proceed to <A HREF="<? echo $url; ?>" TARGET="_top"><? echo $linktitle; ?></A> 
      </BODY> 
    </NOFRAMES>
  </FRAMESET> 
</HTML> -->
