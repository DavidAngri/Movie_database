<style>
    #card {
        display: flex;
        justify-content: space-between;
        width: 900px;
        border: 1px solid black;
        margin: 15px auto;
        transition-duration: 400ms;
        background-color: white;
    }

    #card:hover {
        transform: scale(1.05);
        ;
    }

    #card img {
        border: 3px solid red;
    }

    .picture {
        padding: 30px;
    }

    .details {
        padding: 30px;
    }

    form {
        padding: 30px;
    }

    #synopsis {
        text-overflow: ellipsis;
        text-align: justify;


    }
</style>

<?php
session_start();
require_once 'menu.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<form action="" method="POST">

    <button id=sortasc name="sortasc">Sort movies ASC</button>
    <button id=sortdes name="sortdes">Sort movies DESC</button><br>

    </a>
</form>
<div id="result"></div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    $(function() {

        $.ajax({
            url: 'movies.php',
            method: 'POST',
            data: $('form').serialize()
        }).done(function(movie) {
            // If ajax call worked
            $('#result').html(movie);
        }).fail(function(movie) {
            // If AJAX failed
            console.log('AJAX ERROR');
        });;
    });;
    $(function() {
        $('#sortasc').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'sort.php',
                method: 'POST',
                data: {
                    sortasc: $(this).val()
                }
            }).done(function(movie) {
                $('#result').html(movie);
            }).fail(function(movie) {
                console.log('AJAX Error')
            })
        })
    })
    $(function() {
        $('#sortdes').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'sort.php',
                method: 'POST',
                data: {
                    sortdes: $(this).val()
                }
            }).done(function(movie) {
                $('#result').html(movie);
            }).fail(function(movie) {
                console.log('AJAX Error')
            })
        })
    })
</script>