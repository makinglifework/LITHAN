<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("Location:sign_in.php");
    }
?>