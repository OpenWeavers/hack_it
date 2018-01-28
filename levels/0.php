<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username']))  {
    header("location:../index.php");
}
if (isset($_SESSION['username']) && $_SESSION['current_level'] != 0) {
    header("location:" . $_SESSION['current_level'] . ".php");
}
$db = new DBHelper();
$con = $db->getConnection();
$query = "UPDATE track_records SET current_level=1 WHERE username='".$_SESSION['username']."'";
$con->query($query);
$_SESSION['current_level'] = 1;
?>
<html>
<body>
welcome. <a href="1.php">Begin Hack</a>
</body>
</html>
