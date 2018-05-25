<?php
require("connection.php");
//function to checkmate input fields;

function checker($conn,$field){
    return (htmlentities(trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$field))))));
    
}
?>