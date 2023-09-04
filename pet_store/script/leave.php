<?php
session_start();
session_unset();
session_destroy();
unset($_SESSION['Name']);
header('Location: index.php');
exit();
?>