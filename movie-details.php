<?php


require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if($conn)
{

    if(isset($_GET['id']))
    {
        $id =$_GET['id'];

    // Prepare my query
    $query = 'SELECT m.title, m.poster, m.release_year, c.name cname, a.name aname
                FROM movies m 
                JOIN movie_category mc ON m.movie_id = mc.movie_id 
                JOIN categories c ON c.category_id = mc.category_id 
                JOIN movie_actor ma ON m.movie_id = ma.movie_id 
                JOIN actors a ON a.actor_id = ma.actor_id 
                WHERE m.movie_id = ' . $id;

    // Run/Execute the query
    $results = mysqli_query($conn, $query);     

    $db_record = mysqli_fetch_assoc($results);

    echo "<img src= 'images/poster/$db_record[poster]' height = 250px, width = 200px> <br>";
    echo "Title : $db_record[title] <br>";
    echo "Released in : $db_record[release_year] <br>";
    echo "Categories : $db_record[cname] <br>";
    echo "Actor and Actress : $db_record[aname] <br>";
    }
    else
       echo '<h2> No Movies is Selceted <h2>';
                
}
else
    echo 'Something is wrong with connection to the DB';

// Close the connection to the database
mysqli_close($conn);    
?>    