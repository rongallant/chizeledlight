<?
    // START ------------------------- Query Database ----------------------------
    $query = "SELECT DATE_FORMAT(date, '%W$comma %M %D$comma %Y') AS sqldate,news FROM $my_table WHERE date = '$date' order by date desc";
    $queryFull = "SELECT date FROM $my_table";
    $result = $sqlDbConnection->query($query) or die ("Query failed");
    // END ------------------------- Query Database ------------------------------
?>
