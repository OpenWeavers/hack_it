<?php
session_start();
require ("variables.php");
unset($_SESSION['username']);
if (session_destroy()) ;
header("Location:".$root_path."index.php");
