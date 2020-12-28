<?php
    $conn = new mysqli('localhost', 'root', '', 'primary');
    if($conn->connect_error){
        exit('Error connecting to database');
    }


?>