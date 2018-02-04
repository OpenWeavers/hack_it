<?php
require '../com/config/DBHelper.php';
session_start();
$level = basename($_SERVER['SCRIPT_FILENAME'], ".php");
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}
if (isset($_SESSION['username']) && $_SESSION['current_level'] != $level) {
    header("location:" . $_SESSION['current_level'] . ".php");
}
if (isset($_SESSION['username']) && $_SESSION['on_block'] == $level) {
    $now = date('Y-m-d H:i:s');
    $time_to_unblock = date($_SESSION['when_to_unblock']);
    if ($time_to_unblock <= $now) {
        $db = new DBHelper();
        $con = $db->getConnection();
        $username = $_SESSION['username'];
        $query = "UPDATE track_records SET on_block=0 WHERE username='$username'";
        $con->query($query);
        $_SESSION['on_block'] = 0;
    } else {
        header("location:blocked.php");
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html xmlns:left="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>You've ripped a hole in the fabric of the internet.</title>
</head>
<body>
<h1 align="center">Error 404. Page Not Found</h1>
<img src="qres/404" alt="Page Not Found (404)."
     style="position: absolute; left: 50%; top: 50%; margin-left: -285px; margin-top: -190px;">
<h7 style="position: absolute; left: 50%; top: 130%; margin-top: -290px;">Or Is It?</h7>
</body>
</html>