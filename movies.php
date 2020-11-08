<?php
require_once 'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn) {
    $querry = "SELECT * FROM movies ORDER BY title ASC";
    $result = mysqli_query($conn, $querry);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($movies as $movie) : ?>
        <div id="card">
            <img src="images/poster/<?= $movie['poster'] ?>" alt="">
            <p>Movie id : <?= $movie['movie_id'] ?></p>
            <p> Movie Title : <?= $movie['title'] ?></p>
            <p>Year of Release: <?= $movie['release_year'] ?></p>
            <p>Synopsis : <?= $movie['synopsis'] ?></p>
            <a href="#">Edit film</a>
            <p>Add to my play list<button><i class="fas fa-bookmark"></i></button></p>

            <hr>
        </div>


<?php endforeach;
} else {
    echo 'something is wrong';
}

?>