<?PHP

$URL = $HTTP_REFERER; // Set url to go to

// ob_end_clean(); // ends output buffering 
header("Location: $URL"); // sends header information 
// exit; // stops any other PHP processing

?>