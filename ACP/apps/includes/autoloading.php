<?php
    spl_autoload_register(function ($class) {
       include $_SERVER['DOCUMENT_ROOT']."/M5.ProjectLab/".$class.".php";
    })
?>