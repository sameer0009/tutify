<?php
session_start();
unset($_SESSION["user_name"]);
unset($_SESSION["id"]);
session_unset();
session_destroy();

header("Location: join.php");
exit();
?>
