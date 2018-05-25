<?php
require("connection.php");
function registeredTeachers($conn){
    $sql = "SELECT COUNT(id) from admin";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_row($result);
    return $row[0];
}