<?php
session_start();
session_unset(); //remove session variable
session_destroy();
header('LOCATION:login.php');
?>