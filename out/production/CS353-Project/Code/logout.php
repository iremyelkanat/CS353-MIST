<?php
session_start();
if(empty($_SESSION['a_id'])){
    header("location: index.php");
    die("Redirecting to index.php");
}
session_destroy();
header("Location:index.php");
exit;
?>