<?php

require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

$search = trim($_POST['keyMovie']);

if (!empty($_POST) OR isset($search))
{
    if(empty($search))
        $query = "SELECT * FROM movies ORDER BY movie_id DESC LIMIT 4";  
    /*elseif(isset($_GET['id']))
    {
        $id =$_GET['id'];
        {
            $query = "SELECT * FROM movies m 
                        INNER JOIN movie_category mc ON mc.movie_id = m.movie_id 
                        INNER JOIN categories c ON c.category_id =mc.category_id 
                        WHERE c.category_id = $id ";
        } 
    } */              
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