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
        section img {
            border: 3px solid red;
        }

        section {
            display: flex;
        }

        .picture {
            padding: 30px;
        }

        .details {
            padding: 30px;
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

    if ($conn) {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Prepare my query
            $query = 'SELECT d.name, d.picture, d.nationality, m.title mname FROM movies m 
                            JOIN directors d ON m.director_id = d.director_id
                            WHERE d.director_id = ' . $id;

            $query1 = 'SELECT m.title mname FROM movies m 
                            JOIN directors d ON m.director_id = d.director_id
                            WHERE d.director_id = ' . $id;

            // Run/Execute the query
            $results = mysqli_query($conn, $query);

            $results1 = mysqli_query($conn, $query1);

            $db_record = mysqli_fetch_assoc($results);


            echo "<section>";
            echo "<div class='picture'>";
            echo "<img src='images/directors/$db_record[picture]' height = 400px, width = 300px> <br>";
            echo "</div>";
            echo "<div class='details'>";
            echo "<b>Director : </b>$db_record[name]<br>";
            echo "<b>Nationality : </b>$db_record[nationality]<br>";
            echo "<b>Movies :</b><br>";
            while ($db_record1 = mysqli_fetch_assoc($results1)) {
                echo "<li> $db_record1[mname] </li>";
            }
            echo "</div>";
            echo "</section>";
        } else
            echo '<h2> No Director is Selected <h2>';
    } else
        echo 'Something is wrong with connection to the DB';

    // Close the connection to the database
    mysqli_close($conn);
    ?>
</body>

</html>