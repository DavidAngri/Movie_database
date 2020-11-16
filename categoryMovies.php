<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            border: 3px solid red;
        }
        section{
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            padding: 10px;
        } 
        body {
            background-size: cover;
            background-image: linear-gradient(to top, rgba(200, 200, 200, 0.839), rgba(200, 200, 200, 0.839)), url('images/background.jpg');
        }
    </style>
</head>
<body>
    <header>
        <?php
        require_once 'menu.php'
        ?>
    </header>
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

        echo "<section>";
        // Retrieve the results as an array and display each element
        while($db_record = mysqli_fetch_assoc($results))
        {
            echo "<div>";
            echo "<img src= 'images/poster/$db_record[poster]' height = 250px, width = 200px><br>";
            echo "<p>$db_record[title]</p><br>"; 
            echo "</div>";
        }
        echo "</section>";
        }

    ?>
</body>
</html>
