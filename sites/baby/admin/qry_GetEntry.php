<?PHP
	// START ------------------------- Query Database ----------------------------
    $id = isset($attributes["id"]) ? $attributes["id"] : "";
    $query = "SELECT id,date,news FROM $my_table WHERE id = '$id'";
    $result = $sqlDbConnection->query($query) or die ("Query failed<BR><BR>$query");
    // END ------------------------- Query Database ------------------------------
?>
