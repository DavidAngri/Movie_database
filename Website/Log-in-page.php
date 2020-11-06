<?php

$email = "";
$password = "";

if (isset($_POST['submit'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    $querry = 'SELECT * from users WHERE email="' . $email . '"';
    $result = mysqli_query($conn, $querry);
    if (mysqli_num_rows($result) == 0) {
        echo 'email is not valid';
    } else {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['last_activity'] = strtotime('now');
            header('location:home.php');
        } else {
            echo 'wrong password';
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
</head>
<style>
    form {
        align-items: center;
    }
</style>

<body>

    <section>

        <h1>Sign-in</h1>
        <form action="" method="POST">
            <label for="email">Email</label><br>
            <input type="text" name="email" id="enterEmail" placeholder="Plese enter your email" value="<?php echo $email ?>"><br>
            <label for="password">Password</label><br>
            <input type="passord" name="password" id="password" placeholder="Please enter your password" value="<?php echo $password ?>">
            <input type="submit" name="submitBtn" id="submitBtn">
        </form>
        <p>New to our Website ? </p>
        <button><a href="#">Create your account</a></button>





    </section>

</body>

</html>