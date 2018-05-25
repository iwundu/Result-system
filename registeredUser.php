<?php
require("connection.php");
function registeredUser($conn){
    $sql = "SELECT COUNT(id) from users";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_row($result);
    return $row[0];
}