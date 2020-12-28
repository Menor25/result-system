<?php
    include('includes/function.php');
    $user = (isset($_GET['section_id'])) ? delete($_GET['section_id']) : exit();
?>