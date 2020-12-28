<?php
    $conn = new mysqli('localhost', 'root', '', 'nursery');
    if($conn->connect_error){
        exit('Error connecting to database');
    }


?>