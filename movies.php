<?php
require_once 'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn) {
    $querry = "SELECT * FROM movies ORDER BY title ASC LIMIT 5";
    $result = mysqli_query($conn, $querry);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($movies as $movie) : ?>
        <div id="card">
            <section class="picture">
                <img src="images/poster/<?= $movie['poster'] ?>" alt=""><br>
                <p><b>Movie id : </b><?= $movie['movie_id'] ?></p><br>
                <p><b>Movie Title : </b><a href="movie-details.php?id=" $movie[movie_id]?><?= $movie['title'] ?></a></p><br>
            </section>
            <section class="details">
                <p><b>Year of Release: </b><?= $movie['release_year'] ?></p><br>
                <p id="synopsis"><b>Synopsis : </b><?= $movie['synopsis'] ?></p><br>
                <a href="#">Edit film</a><br>
            </section>

        </div>


<?php endforeach;
} else {
    echo 'something is wrong';
}

?>