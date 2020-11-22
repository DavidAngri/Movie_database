<?php
session_start();
if ($_SESSION['Status'] == 0) {
    header('location:index.php');
} else {
    //initialize the array to handle the errors
    $errors = array();
    // make empty value when entering the page
    $title = "";
    $releasedYear = "";
    $synopsis = "";
    $poster = "";
    //start the logic
    if (isset($_POST['submit'])) {
        $title = htmlspecialchars(trim($_POST['title']));
        $releasedYear = htmlspecialchars(trim($_POST['releasedYear']));
        $synopsis = htmlspecialchars(trim($_POST['synopsis']));
        $poster = htmlspecialchars(trim($_POST['poster']));

        // errors to be displayed  in if statement
        if (empty($title)) {
            $errors['title'] = 'Title name is mandatory';
        }
        if (empty($releasedYear)) {
            $errors['releasedYear'] = 'Released Year is mandatory';
        }
        if (empty($synopsis)) {
            $errors['synopsis'] = 'Please enter a synopis with at least 10 characters';
        }
        if (empty($poster)) {
            $errors['poster'] = 'Please enter a poster name';
        }
        //if the fields are not empty, i can connect to the database

        if (count($errors) == 0) {

            $director_id = $_POST['directors'] + 0;
            require_once 'database.php';
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

            $query = "SELECT * FROM movies WHERE title = '$title'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                $query2 = "INSERT INTO movies (title,release_year,synopsis,poster,director_id) VALUES ('$title',$releasedYear,'$synopsis','$poster',$director_id)";
                $result2 = mysqli_query($conn, $query2);
                echo '<h2>Movie successfully added</h2>';
            } else
                $errors['title'] = 'Movie already in the database';
        }
    }
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
            width: 500px;
            height: 200px;

        }

        body {
            background-size: cover;
            background-image: linear-gradient(to top, rgba(200, 200, 200, 0.839), rgba(200, 200, 200, 0.839)), url('images/background.jpg');
        }

        section {
            text-align: center;
            margin-top: 30px;
        }

        label {

            font-size: 40px;
            font-family: 'Courier New', Courier, monospace;

        }

        section input,
        #directors {
            width: 500px;
            height: 50px;
            font-size: 30px;
            font-family: 'Courier New', Courier, monospace;
        }

        #submitBTn1 {
            width: 150px;

            font-size: 30px;
            border-radius: 20px;
            margin-top: 20px;
            transition-duration: 0.4s;
        }

        #submitBTn1:hover {
            background-color: green;
            color: white;
        }

        p {
            color: red;
            font-size: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <?php
        require_once 'menu.php'
        ?>
    </header>
    <section>
        <form action="" method="POST">
            <label for="name">Name of the movie</label><br>
            <input type="text" name="title" id="title" value="<?php echo $title ?>"> <br>
            <p> <?php if (isset($errors['title'])) echo $errors['title']; ?></p><br>
            <label for="releasedYear">Released Year</label><br>
            <input type="number" name="releasedYear" id="releasedYear" value="<?php echo $releasedYear ?>"><br>
            <p> <?php if (isset($errors['releasedYear'])) echo $errors['releasedYear']; ?></p><br>
            <label for="synopsis">Please write the synopsis of the movie (Max 250 characters)</label><br>
            <textarea name="synopsis" id="synopsis" value="<?php echo $synopsis ?>"></textarea><br><br>
            <p><?php if (isset($errors['synopsis'])) echo $errors['synopsis']; ?></p><br>
            <label for="poster">Enter the name of your file (add .jpg at the end of the name)</label><br>
            <input type="text" name="poster" id="poster" value="<?php echo $poster ?>"><br><br>
            <p><?php if (isset($errors['poster'])) echo $errors['poster']; ?></p><br>
            <!-- <select name="categories" id="categories">
            <option name="all" id="all" value="0">Select a category</option>
        </select><br> -->
            <select name="directors" id="directors">
                <option name="all" id="all" name="dir">Select a director</option>
            </select><br>

            <input type="submit" name="submit" id="submitBTn1">
        </form>
    </section>
    <script>
        $(function() {
            $.ajax({
                    url: 'director_id.php',
                    method: 'POST',
                    dataType: 'json',
                }).done(function(result) {
                    let directors = result;
                    console.log(directors);
                    $.each(directors, function(key, director) {
                        $('#directors').append('<option value="' + director.director_id + '" name="dir">' + director.name + '</option>');
                    });
                })
                .fail(function(result) {
                    console.log('AJAX ERROR2')
                })
        })
    </script>

</body>

</html>