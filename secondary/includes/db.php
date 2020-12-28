<?php
    $conn = new mysqli('localhost', 'root', '', 'secondary');
    if($conn->connect_error){
        exit('Error connecting to database');
    }


?>