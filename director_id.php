<?php
require_once 'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT director_id,name FROM directors";
$result = mysqli_query($conn, $query);
$directors = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($directors, JSON_PRETTY_PRINT);
