<?php
require_once 'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
if (isset($_POST['sortasc'])) {

    $query = "SELECT*
FROM movies ORDER BY release_year ASC ";
} elseif (isset($_POST['sortdes'])) {
    $query = "SELECT*
    FROM movies ORDER BY release_year DESC ";
}

$result = mysqli_query($conn, $query);
$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($movies as $movie) : ?>
    <div id="card">
        <section class="picture">
            <img src="images/poster/<?= $movie['poster'] ?>" alt="">
            <p><b>Movie id : </b><?= $movie['movie_id'] ?></p><br>
            <p><b>Movie Title : </b><?= $movie['title'] ?></p><br>
        </section>
        <section class="details">
            <p><b>Year of Release: </b><?= $movie['release_year'] ?></p><br>
            <p><b>Synopsis : </b><?= $movie['synopsis'] ?></p><br>
            <a href="#">Edit film</a><br>
        </section>            
        <p>Add to my play list<button><i class="fas fa-bookmark"></i></button></p>


        <hr>
    </div>


<?php endforeach;
