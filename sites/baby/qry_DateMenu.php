<?PHP
	// START ------------------------- Query Database ----------------------------
	$query = "SELECT DISTINCT date FROM $my_table order by date asc";
	$queryFull = "SELECT date FROM $my_table";
	$result = $sqlDbConnection->query($query) or die ("Query failed");
	$query_result_handle = $sqlDbConnection->query($queryFull);
	$num_of_rows = mysqli_num_rows($query_result_handle);
    // END ------------------------- Query Database ------------------------------
?>
