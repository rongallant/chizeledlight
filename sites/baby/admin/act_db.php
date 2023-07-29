<?php
include("settings.inc");
$DBname = "Secure";
$query = "CREATE DATABASE $DBname";
$result = $sqlDbConnection->query($query) or die("ERROR while creating database");
print("OK, database made, name of DB : $DBname<br><br>");

mysql_select_db($DBname, $connection);
$query2 = "CREATE TABLE Usersettings (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
Username varchar(10), 
Password char(10))";
$result2 = $sqlDbConnection->query($query2) or die("ERROR while creating table");
print("OK, table made, name of table : Usersettings<br><br>");

$query3 = "CREATE TABLE Temp (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
SesId INT unsigned, 
Date varchar(100))";
$result3 = $sqlDbConnection->query($query3) or die("ERROR while creating table");
print("OK, table made, name of table : Temp<br>");
?>
