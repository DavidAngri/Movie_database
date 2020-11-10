<?php


require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn) {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare my query
        $query = 'SELECT m.title, m.poster, m.synopsis, m.release_year, c.name cname
                FROM movies m 
                JOIN movie_category mc ON m.movie_id = mc.movie_id 
                JOIN categories c ON c.category_id = mc.category_id 
                WHERE m.movie_id = ' . $id;

        $query1 = 'SELECT * FROM actors a
                JOIN movie_actor ma ON ma.actor_id = a.actor_id
                WHERE ma.movie_id =' . $id;

        $query2 = 'SELECT * FROM categories c 
                JOIN movie_category mc ON mc.category_id = c.category_id 
                WHERE mc.movie_id =' . $id;

        // Run/Execute the query
        $results = mysqli_query($conn, $query);

        $db_record = mysqli_fetch_assoc($results);

        $results1 = mysqli_query($conn, $query1);

        $results2 = mysqli_query($conn, $query2);


        echo "<section>";
        echo "<div class='picture'>";
        echo "<img src='images/poster/$db_record[poster]' height = 400px, width = 300px> <br>";
        echo "<p><b>Released in : </b>$db_record[release_year]<p><br>";
        echo "</div>";
        echo "<div class='details'>";
        echo "<h2><a href=''>  $db_record[title]</a></h2><br>";
        echo "<p>$db_record[synopsis]</p>";
        echo "<b>Categories : </b>";
        echo "<ul>";
        while ($db_records2 = mysqli_fetch_assoc($results2)) {
            echo "<li> $db_records2[name] </li>";
        }
        echo "</ul>";
        echo "<b>Actor and Actress : </b>";
        echo "<ul>";
        while ($db_records1 = mysqli_fetch_assoc($results1)) {
            echo "<li> $db_records1[name] </li>";
        }
        echo "</ul>";

        echo "<input type='submit' value='Add to playlist'>";
        echo "</div>";
        echo "</section>";
    } else
        echo '<h2> No Movies is Selceted <h2>';
} else
    echo 'Something is wrong with connection to the DB';

// Close the connection to the database
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img {
            border: 3px solid red;
        }

        section {
            display: flex;
            justify-content: space-around;
        }

        .picture {
            padding: 30px;
        }

        .details {
            padding: 30px;
        }

        input {
            padding: 5px;
            margin-top: 10px;
            background-color: black;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>

<body>

</body>

</html>