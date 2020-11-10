<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Happy+Monkey&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Happy+Monkey&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_POST['submitBtn'])) {
        session_unset();
        session_destroy();
        header('location:index.php');
    }
    ?>
    <nav>
        <div id="flexy">
            <img src="images/Logo/logo2.png" alt="" id="logo">
            <h1 id="Project">Cinemestro</h1>
        </div>
        <ul>
            <li><a id="homenav" href="home.php">Home</a></li>
            <li><a id="homenav" href="Catalogue.php">Movie Catalogue</a></li>
            <li><a id="homenav" <?php if ($_SESSION['Status'] == 0) echo "class='user'" ?> href="add-category.php">Add a category</a></li>
            <li><a id="homenav" <?php if ($_SESSION['Status'] == 0) echo "class='user'" ?> href="Adding-movies.php">Add a movie</a></li>
        </ul>
        <form action="" method="POST">
            <input type="submit" name="submitBtn" id="submitBtn" value="Log Out">
        </form>
    </nav>



</body>

</html>