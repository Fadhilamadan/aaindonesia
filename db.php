<?php

$link = mysqli_connect("localhost", "root", "", "aaindonesia");
if(mysqli_connect_errno()) {
    echo "Connect Error: " . mysqli_connect_error();
    die("Connect Error: " . mysqli_connect_error());   
}
    
?>