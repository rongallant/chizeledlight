<?php 
// Yahoo! NewsPod 1.0 
// By Mukul Sabharwal [mukulsabharwal@yahoo.com] 
// Grabs news headlines from yahoo.com/index.html 
// You can modify it as you like. Just don't remove my name 
// PHPArena - http://phparena.tsx.org 

$file = fopen("http://www.cnn.com/index.html", "r"); //open file for reading 
$rf = fread($file, 20000); // read 20KB 
$grab = eregi("<body>(.*)<body>", $rf, $printing); //Search for the news 

fclose($file); // close the file 
echo $grab; // Voila, print it out 
?>