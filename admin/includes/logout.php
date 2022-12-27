<?php 

session_start();
session_destroy();
unset($_SESSION['id']);

header("Location: /complete2/index.php");

?>