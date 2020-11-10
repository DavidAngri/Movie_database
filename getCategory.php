<?php

require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if (!empty($_POST)) 
{
    $queryCat = "SELECT c.name, c.category_id, COUNT(c.name) movieCount
                    FROM movies m
                    JOIN movie_category mc ON m.movie_id = mc.movie_id
                    JOIN categories c ON c.category_id = mc.category_id
                    GROUP BY c.name";

    $resultsCat = mysqli_query($conn, $queryCat);

    // Retrieve Categories
    $categories = mysqli_fetch_all($resultsCat, MYSQLI_ASSOC);

    foreach ($categories as $category) {
        //echo "<a href='getMovies.php?id=$category[category_id]' name = catMovies id=catMovies'> $category[name] ($category[movieCount])</a>";
        echo "<a href=''> $category[name] ($category[movieCount])</a>";
    }
}
