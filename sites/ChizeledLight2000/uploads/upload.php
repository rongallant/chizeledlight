<?PHP

   for($i=0;$i<sizeof($userfile);$i++)
   { 
     if(!$userfile_size[$i])
         continue;
 
     $UPLOAD = fopen( $userfile[$i], "r" );
     $contents = fread( $UPLOAD,$userfile_size[$i]);      
     fclose( $UPLOAD );  
     $SAVEFILE = fopen("files//".$userfile_name[$i], "wb" );
     fwrite( $SAVEFILE, $contents,$userfile_size[$i] );      
     fclose( $SAVEFILE );       
  }    

?>

<?PHP $title = 'Chizeled Light - Thank You';?> 

<?php include ('/www/chizeledlight/assets/templates/main_header.inc');?>

<H1>Thank You</H1>

<P>Your files have been uploaded to the upload directory.</P>
<P><A HREF="index.php">Return to Uploads</A></P>

<?php include ('/www/chizeledlight/assets/templates/main_footer.inc');?>