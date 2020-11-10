<?php

require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

// $search = trim($_POST['catMovies']);

if (isset($_GET['id']))
{
    $id =$_GET['id'];

$query = "SELECT * FROM movies m 
            INNER JOIN movie_category mc ON mc.movie_id = m.movie_id 
            INNER JOIN categories c ON c.category_id =mc.category_id 
            WHERE c.category_id = $id ";        

$results = mysqli_query($conn, $query);

// Retrieve the results as an array and display each element
while($db_record = mysqli_fetch_assoc($results))
{
    // echo "<div>";
    echo "<img src= 'images/poster/$db_record[poster]' height = 250px, width = 200px><br>";
    echo "<a href='movie-details.php?id='+ $db_record[movie_id]>$db_record[title]</a><br>"; 
    // echo "</div>";
    echo "<hr>";
}
}

