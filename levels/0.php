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
Welcome!
<h5>How To Play ?</h5>
<h6><ol><li>Sign up using the link provided.</li>
        <li>A confirmation link will be sent to your mail. Use it to login.</li>
        <li>Log in and get cracking.</li>
        <li>Use any tool, ranging from your common-sense to Google, to arrive at the answer.</li>
        <li>Answers in lower case, with no space in between words.<br>
            For example, if answer is "LCC SJCE", you should type in "lccsjce"</li>
        <li>Every level contains a hint, but accessing it will cause a time-penalty of 10 minutes.<br>
            Once the hint is obtained, accessing it again won't cause any penalty.</li>
        <li>Position in leaderboard is decided on the user's score. If two or more users have the same score,<br>
            the tie-breaker is the time they took to reach that level.</li>
        <li>If stuck anywhere, ping us at the sub-reddit provided.</li>
    </ol></h6>
<h6>Cheers.</h6>
<a href="1.php">Begin Hack</a>
</body>
</html>
