<?php
require_once 'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

$title = "";
$releasedYear = "";
$synopsis = "";
$poster = "";
if ($conn && isset($_POST['submit'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $releasedYear = htmlspecialchars(trim($_POST['releasedYear']));
    $synopsis = htmlspecialchars(trim($_POST['synopsis']));
    $poster = htmlspecialchars(trim($_POST['poster']));
}






?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #synopsis {
            width: 300px;
            height: 300px;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <label for="name">Name of the movie</label><br>
        <input type="text" name="title" id="title"> <br>
        <label for="releasedYear">Released Year</label><br>
        <input type="number" name="releasedYear" id="releasedYear"><br>
        <label for="synopsis">Please write the synopsis of the movie (Max 250 characters)</label><br>
        <input type="text" name="synopsis" id="synopsis"><br><br>
        <label for="poster">Enter the name of your file (add .png at the end of the name)</label><br>
        <input type="text" name="poster" id="poster"><br><br>
        <select name="categories" id="categories">
            <option name="all" id="all" value="0">Select a category</option>
        </select><br>
        <select name="directors" id="directors">
            <option name="all" id="all" value="0">Select a director</option>
        </select><br>
        <input type="submit" name="submit" id="submit">
    </form>



</body>

</html>