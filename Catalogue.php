<style>
    #card {
        margin-top: 10px;
        margin-left: 0;
    }
</style>


<?php
require_once 'menu.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<form action="" method="POST">
    <button></button>
    <button id=sortasc name="sortasc">Sort movies ASC</button>
    <button id=sortdes name="sortdes">Sort movies DESC</button><br>

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
                console.log('AJA Error')
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
                console.log('AJA Error')
            })
        })
    })
</script>