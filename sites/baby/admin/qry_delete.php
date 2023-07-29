<?php
    // START ----------------------- Query Database ------------------------------
    $id = isset($attributes["id"]) ? $attributes["id"] : "";
    $query = "delete from $my_table	where id = '$id';";
    $result = $sqlDbConnection->query($query) or die ("Query failed<BR><BR>$query");
    // END ------------------------- Query Database ------------------------------
?>
