<?php
$errors = array();
$category = "";
$directors = "";

if (isset($_POST['submitBtn'])) {
    $category = htmlspecialchars(trim($_POST['category']));
    if (empty($category)) {
        $errors['category'] = 'Please enter on category';
    }
    if (strlen($category) < 4) {
        $errors['category'] = 'Please enter at least 4 characters';
    }
    if (count($errors) == 0) {
        require_once 'database.php';
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM categories WHERE name='$category'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            $query2 = "INSERT INTO categories (name) VALUES ('$category')";
            $result2 = mysqli_query($conn, $query2);
            echo 'category successfully added';
        } else
            $errors['category'] = 'Category already in the database';
    }
}

if (isset($_POST['submitBtn2'])) {
    $poster = htmlspecialchars(trim($_POST['poster']));
    $directorname = htmlspecialchars(trim($_POST['directorname']));
    $nationality = $_POST['nationalities'];

    if (empty($directorname)) {
        $errors['director'] = 'Please enter on director name';
    }
    if (strlen($directorname) < 4) {
        $errors['director'] = 'Please enter at least 4 characters';
    }
    if (empty($poster)) {
        $errors['director'] = 'Please enter on director name';
    }
    if (strlen($poster) < 4) {
        $errors['director'] = 'Please enter at least 4 characters';
    }
    if (count($errors) == 0) {
        require_once 'database.php';
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM directors WHERE name='$directorname'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            $query2 = "INSERT INTO directors (name,nationality,picture) VALUES ('$directorname','$nationality','$poster')";
            $result2 = mysqli_query($conn, $query2);
            echo 'Director successfully added';
        } else
            $errors['Director'] = 'Director already in the database';
    }
}






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>
<header>
    <?php require_once 'menu.php' ?>
</header>

<body>
    <form action="" method="POST">
        <label for="category">Please type the name of a category : </label><br>
        <input type="text" name="category" id="category" value="<?php echo $category  ?>">
        <?php if (isset($errors['category'])) echo $errors['category']; ?><br>
        <input type="submit" name="submitBtn" id="submitBtn">
    </form>
    <hr>
    <form action="" method="POST">
        <label for="category">Please type the name of a director: </label><br>
        <input type="text" name="directorname" id="directorname" value="<?php echo $directors  ?>"><br>
        <?php if (isset($errors['director'])) echo $errors['director']; ?><br>
        <select name="nationalities" id="nationalities">
            <option name="all" id="all" value="0">Select a nationality</option>
        </select><br>
        <label for="picture">Please enter a poster name</label><br>
        <input type="text" name="poster" id="poster"><br>
        <?php if (isset($errors['director'])) echo $errors['director']; ?><br>
        <input type="submit" name="submitBtn2" id="submitBtn2">
    </form>
    <hr>


    <script>
        $(function() {
            $.ajax({
                    url: 'director_nationalities.php',
                    method: 'POST',
                    dataType: 'json',
                }).done(function(result) {
                    let nationalities = result;
                    console.log(nationalities);
                    $.each(nationalities, function(key, nationality) {
                        $('#nationalities').append('<option value="' + nationality.nationality + '">' + nationality.nationality + '</option>');
                    });
                })
                .fail(function(result) {
                    console.log('AJAX ERROR2')
                })
        })
    </script>

</body>

</html>