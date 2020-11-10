<?php
// Initialize an array to handle errors
$errors = array();
$email = "";
$password = "";

if (isset($_POST['submitBtn'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    if (empty($email)) {
        $errors['email'] = 'Email is mandatory.';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is mandatory.';
    }
    if (count($errors) == 0) {
        require_once 'database.php';
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $querry = 'SELECT * from users WHERE email="' . $email . '"';
        $result = mysqli_query($conn, $querry);
        if (mysqli_num_rows($result) == 0) {
            $errors['email'] = 'email is not valid';
        } else {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['last_activity'] = strtotime('now');
                header('location:home.php');
            } else {
                $errors['password'] = 'Incorrect Password';
            }
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
    section {
        border: 1px solid gray;
        border-radius: 10px;
        margin: auto;
        margin-top: 200px;
        width: 400px;
        height: 350px;
        font-family: Arial, Helvetica, sans-serif;
        background-color: white;
    }

    h1 {
        font-size: 2rem;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        text-rendering: optimizeLegibility;
        font-weight: 400;
    }

    #enterEmail,
    #password {
        width: 350px;
        height: 31px;
        font-size: 13px;
        margin-bottom: 10px;

    }

    label {
        padding-left: 30px;
        font-size: 13px;
        line-height: 19px;
        color: #111;
        font-family: Arial, sans-serif;
        font-weight: 700;
    }

    div {
        padding-left: 30px;
    }

    article {
        height: 44px;
        padding-top: 5px;
        background: -webkit-linear-gradient(to bottom, rgba(0, 0, 0, .14), rgba(0, 0, 0, .03) 3px, transparent);
        background: linear-gradient(to bottom, rgba(0, 0, 0, .14), rgba(0, 0, 0, .03) 3px, transparent);
        z-index: 0;
        zoom: 1;
        text-align: center;
    }

    #submitBtn {
        margin-left: 125px;
        width: 150px;
        font-size: 1rem;
        margin-bottom: 10px;
        height: 30px;
        color: white;
        background-color: black;
        transition-duration: 0.4s;
        border-radius: 10px;
        border: none;
        margin-top: 10px;
    }

    #submitBtn:hover {
        background-color: white;
        color: black;

    }

    a {
        text-decoration: none;
    }

    body {

        background-size: cover;
        background-image: linear-gradient(to top, rgba(200, 200, 200, 0.839), rgba(200, 200, 200, 0.839)), url('images/background.jpg');
    }

    span {
        color: red;
    }
</style>

<body>

    <section>

        <h1>Sign-in</h1>
        <form action="" method="POST">
            <label for="email">Email</label><br>
            <div>
                <input type="text" name="email" id="enterEmail" placeholder="Please enter your email" value="<?php echo $email ?>"><br>
                <?php if (isset($errors['email'])) echo '<span>' . $errors['email'] . '</span>'; ?><br>
            </div>

            <label for="password">Password</label><br>
            <div>
                <input type="passord" name="password" id="password" placeholder="Please enter your password" value="<?php echo $password ?>"><br>
                <?php if (isset($errors['password'])) echo '<span>' . $errors['password'] . '</span>'; ?><br>
            </div>
            <input type="submit" name="submitBtn" id="submitBtn" value="Sign-in">
        </form>
        <article>
            <p>New to our Website ? <a href="#">Create your account</a></p>

        </article>




    </section>

</body>

</html>