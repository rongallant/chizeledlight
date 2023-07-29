<?PHP
	// START ------------------------- Query Database ----------------------------
	$query = "SELECT id,date,news FROM $my_table ORDER BY date desc, id LIMIT $offset, $item_perpage";
	$queryFull = "SELECT date FROM $my_table";
	$result = $sqlDbConnection->query($query) or die ("Query failed<BR><BR>$query");
	$query_result_handle = $sqlDbConnection->query($queryFull) or die ("Query failed<BR><BR>$query");
	$num_of_rows = mysqli_num_rows($query_result_handle);
    // END ------------------------- Query Database ------------------------------
?>
