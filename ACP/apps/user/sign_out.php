<?php
    session_start();
    unset($_SESSION['email']);
    session_destroy();
    header("Location: sign_in.php");
?>