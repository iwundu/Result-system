<?php

//connection strings

$dbhost = "localhost";
$dbuser = "root";
$dbpwd = "";
$dbname = "project";

//error handling;

$conn = mysqli_connect($dbhost,$dbuser,$dbpwd,$dbname);

//check if connection was successful or not;

if($conn == false){
    die("Unable to connect".mysqli_connect_error());
}
?>