<?php
    $conn = new mysqli('localhost', 'chesire' , 'pass', 'Bloggy');

    if($conn->connect_error){
        die("Connection error: $conn->connect_error");
    }
    else{
        
    }
?>