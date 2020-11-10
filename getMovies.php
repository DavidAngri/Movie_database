<?php

require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

$search = trim($_POST['keyMovie']);

if (!empty($_POST) OR isset($search))
{
    if(empty($search))
        $query = "SELECT * FROM movies ORDER BY movie_id DESC LIMIT 4";              
    else
        $query = "SELECT * FROM movies WHERE title LIKE '%$search%'";            

    $results = mysqli_query($conn, $query);

    if (mysqli_num_rows($results) == 0) {
        echo 'No movies matching your criteria';
    } 
    else {
        // Retrieve movies
        $movies = mysqli_fetch_all($results, MYSQLI_ASSOC);

        echo json_encode($movies, JSON_PRETTY_PRINT);

    }    
}
?>