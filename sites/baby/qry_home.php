<?PHP
	// START ------------------------- Query Database ----------------------------
	$query = "SELECT id,date,news FROM $my_table order by date desc, id LIMIT $start, $per_page";
	$result = $sqlDbConnection->query($query) or die ("Query failed");
	$queryFull = "SELECT date FROM $my_table";
	$query_result_handle = $sqlDbConnection->query($queryFull) or die ("Query failed");
	$total_items = mysqli_num_rows($query_result_handle);
    // END ------------------------- Query Database ------------------------------
?>
