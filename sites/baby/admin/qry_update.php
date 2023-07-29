<?php
    $id = isset($attributes["id"]) ? $attributes["id"] : "";
    $date = $attributes["date"] ? $attributes["date"] : "";
    $news = $attributes["news"] ? addslashes($attributes["news"]) : "";
    $query = "update $my_table set date='$date', news='$news' where id=$id;";
    $result = $sqlDbConnection->query($query) or die ("Query failed<BR><BR>$query");
?>
