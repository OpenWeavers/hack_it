<?php
session_start();
require ("variables.php");
unset($_SESSION['username']);
$_SESSION = array();
if (session_destroy()) ;
header("Location:index.php");
