<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username']))  {
    header("location:../index.php");
}
if (isset($_SESSION['username']) && $_SESSION['current_level'] != 1) {
    header("location:" . $_SESSION['current_level'] . ".php");
}

?>
//HTML here