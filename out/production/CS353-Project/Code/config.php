<?php
define('DB_SERVER', 'dijkstra.ug.bcc.bilkent.edu.tr');
define('DB_USERNAME', 'ecem.yelkanat');
define('DB_PASSWORD', 'RtjlTyQO');
define('DB_DATABASE', 'ecem_yelkanat');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (!$db) {
    die("Database Connection Failed!" . mysqli_connect_error());
}
// echo "Connected successfully";
?>
