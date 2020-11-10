<?php

$firstname = '';
if (isset($_POST['submitBtn'])) {
    if (empty($_POST['playlistName']))
        echo "<p class='errors'> Name is Mandatory!!! </p>";
    else {
        require_once 'database.php';

        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

        $query = "INSERT INTO playlist(name)
        VALUES('" . $_POST['title'] . "', '" . $_POST['views']  . "', " . $_POST['directors'] . ")";

        // execute the query
        $result = mysqli_query($conn, $query);

        if ($result)
            echo 'Playlist successfully added!';
        else
            echo 'Error adding playlist into DB';
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
        .errors {
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <form action="" method="post">
            <input type="text" name="playlistName" id="">
            <input type="submit" name value="ADD PLAYLIST">
        </form>
    </main>

    </head>

    <body>

    </body>

</html>