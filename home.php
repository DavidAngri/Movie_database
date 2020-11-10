<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        main
        {
            padding: 30px;
        }
        input{
            height: 100px;
            width: 100%;
            font-size: 5rem;
            text-align: center;
        }

        #categories{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            padding: 30px;
        }
        #movies {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-evenly;
            padding: 30px;
        }
        #movies a{
            text-align: center;
        }
        #movies img{
            border: 3px solid red;
        }

    </style>
</head>
<body>
    <main>
        <p>
            Welcome to our movie website. Here, you can find the details about the movies like the actor, actress, director and released year.
        </p>

        <form action="" method="post">
            <input type="text" id="mySearch" name="search" placeholder= "Search for movies.....">

            <div id="categories"></div>

            <section id="movies"></section>

        </form>
        <img src="images/poster/" alt="">

    </main>

    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
    ></script>

    <script>

        $(function categories() {
            // To display the categories
            $.ajax({
              url: "getCategory.php",
              method: "post",
              data: { search: $(this).val() }
            })
              .done(function (resultCat) {
                $("#categories").html(resultCat);
              })
              .fail(function (resultCat) {
            });


            $.ajax({
                url: "getMovies.php",
                method: "post",
                data: {
                        keyMovie: $(this).val()
                    },
                dataType: 'json'
                })
                .done(function (result) {
                    $.each(result, function(key, movies) {
                        $('#movies').append('<div><img src = images/poster/' + 
                                                movies.poster + ' height = 250px, width = 200px><br><a href="movie-details.php?id='+ movies.movie_id + '">' + 
                                                movies.title + '</a></p></div>');
                                        
                    });
                })
                .fail(function (result) {
                });


            // To display the movies in the descending order
            $.ajax({
                url: "getMovies.php",
                method: "post",
                data: {
                        keyMovie: $(this).val()
                    },
                dataType: 'json'
                })
                .done(function (result) {
                    $.each(result, function(key, movies) {
                        $('#movies').append('<div><img src = images/poster/' + 
                                                movies.poster + ' height = 250px, width = 200px><br><a href="movie-details.php?id='+ movies.movie_id + '">' + 
                                                movies.title + '</a></p></div>');
                                        
                    });
                })
                .fail(function (result) {
                });

            // To display the movies based on the search
            $('#mySearch').keyup(function (e) {
                e.preventDefault();
                $('#movies').html('');
            $.ajax({
                url: "getMovies.php",
                method: "post",
                data: {
                    keyMovie: $(this).val()
                    },
                dataType: 'json'
                })
                .done(function (result) {
                    $.each(result, function(key, movies) {
                        $('#movies').append('<div><img src = images/poster/' + 
                                                movies.poster + ' height = 250px, width = 200px><br><a href="movie-details.php?id='+ movies.movie_id + '">' + 
                                                movies.title + '</a></p></div>');
                    });
                })
                .fail(function (result) {
                });
            });     
        });
      </script>
    
</body>
</html>
