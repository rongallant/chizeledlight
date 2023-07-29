<?php
    $date = $attributes["date"] ? $attributes["date"] : "";
    $news = $attributes["news"] ? $attributes["news"] : "";
    $news = addslashes($news);
    $query = "insert into $my_table	(date,news)	values ('$date','$news');";
    $result = $sqlDbConnection->query($query) or die ("Query failed<BR><BR>$query");
?>
