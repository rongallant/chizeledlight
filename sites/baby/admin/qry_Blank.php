<?PHP
    // START ----------------------- Query Database ------------------------------
    $query = "SELECT id,date,news FROM $my_table WHERE 1 = 0";
    $result = $sqlDbConnection->query($query) or die ("Query failed<BR><BR>$query");
    // END ------------------------- Query Database ------------------------------
?>
