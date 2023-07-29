<?PHP

$URL = 'index.php?fuseaction=gb.View';

ob_end_clean(); // ends output buffering 
header("Location: $URL"); // sends header information 
exit; // stops any other PHP processing
?>