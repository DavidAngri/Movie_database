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
            width: 300px;
            height: 300px;
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
    <form action="" method="POST">
        <label for="name">Name of the movie</label><br>
        <input type="text" name="title" id="title" value="<?php echo $title ?>"> <br>
        <?php if (isset($errors['title'])) echo $errors['title']; ?><br>
        <label for="releasedYear">Released Year</label><br>
        <input type="number" name="releasedYear" id="releasedYear" value="<?php echo $releasedYear ?>"><br>
        <?php if (isset($errors['releasedYear'])) echo $errors['releasedYear']; ?><br>
        <label for="synopsis">Please write the synopsis of the movie (Max 250 characters)</label><br>
        <?php if (isset($errors['synopsis'])) echo $errors['synopsis']; ?><br>
        <input type="text" name="synopsis" id="synopsis" value="<?php echo $synopsis ?>"><br><br>
        <?php if (isset($errors['synopsis'])) echo $errors['synopsis']; ?><br>
        <label for="poster">Enter the name of your file (add .jpg at the end of the name)</label><br>
        <input type="text" name="poster" id="poster" value="<?php echo $poster ?>"><br><br>
        <?php if (isset($errors['poster'])) echo $errors['poster']; ?><br>
        <!-- <select name="categories" id="categories">
            <option name="all" id="all" value="0">Select a category</option>
        </select><br> -->
        <select name="directors" id="directors">
            <option name="all" id="all" name="dir">Select a director</option>
        </select><br>

        <input type="submit" name="submit" id="submit">
    </form>

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