<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <style>
        .errors {
            color: red;
        }



        body {

            background-size: cover;
            background-image: linear-gradient(to top, rgba(200, 200, 200, 0.839), rgba(200, 200, 200, 0.839)), url('images/background.jpg');
        }

        section {
            border: 1px solid gray;
            border-radius: 10px;
            margin: auto;
            margin-top: 100px;
            width: 400px;
            height: 600px;
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

        #form {
            width: 350px;
            height: 31px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        label {

            font-size: 13px;
            line-height: 19px;
            color: #111;
            font-family: Arial, sans-serif;
            font-weight: 700;
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

        article {
            height: 44px;
            padding-top: 5px;
            background: -webkit-linear-gradient(to bottom, rgba(0, 0, 0, .14), rgba(0, 0, 0, .03) 3px, transparent);
            background: linear-gradient(to bottom, rgba(0, 0, 0, .14), rgba(0, 0, 0, .03) 3px, transparent);
            z-index: 0;
            zoom: 1;
            text-align: center;
        }

        div {
            padding-left: 30px;
        }
    </style>
</head>

<body>
    <?php
    $firstname = '';
    $lastname = '';
    $nickname = '';
    $email = '';
    $password = '';
    $confirm_password = '';

    $errors = array();

    if (isset($_POST['submitBtn'])) {
        //  Retrieve form data and trim
        $firstname = trim(htmlspecialchars($_POST['firstname']));
        $lastname = trim(htmlspecialchars($_POST['lastname']));
        $nickname = trim(htmlspecialchars($_POST['nickname']));
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $confirm_password = trim(htmlspecialchars($_POST['confirm_password']));

        // Encrypt the Password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Basic Validations for required fields

        if (empty($firstname))
            $errors['firstname'] = 'First Name is Mandatory!!!';
        if (empty($lastname))
            $errors['lastname'] = 'Last Name is Mandatory!!!';
        if (empty($nickname))
            $errors['nickname'] = 'Name is Mandatory!!!';
        if (empty($email))
            $errors['email'] = 'Email is Mandatory!!!';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Enter a Valid Email';
        if (empty($password))
            $errors['password'] = 'Password is Mandatory!!!';
        if (strlen($password) < 8)
            $errors['password'] = 'Passsword must contain more than 8 Characters';
        if (!$password == $confirm_password)
            $errors['confirm_password'] = 'Password and Confirm Password must Match';
        if (count($errors) == 0) {

            require_once 'database.php';

            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

            $query = "SELECT * FROM users WHERE email = '$email'";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {

                $query_insert = "INSERT INTO users(firstname, lastname, nickname, email, password) 
                VALUES ('$firstname', '$lastname', '$nickname', '$email', '$hashedPassword')";

                $result_insert = mysqli_query($conn, $query_insert);
                echo '<h2>Welcome ' . $nickname . '</h2>';
            } else
                echo "User with the email $email already Exists....";
        }
    }

    ?>
    <section>
        <h1>Registration</h1>
        <form action="" method="post">

            <!-- first Name -->
            <div>
                <label for="firstname">First Name</label><br>
                <input id="form" type="text" name="firstname" placeholder="Henri" value='<?= $firstname ?>'>
                <?php if (isset($errors['firstname'])) echo $errors['firstname'] ?><br>
            </div>
            <!-- last Name -->
            <div>
                <label for="lastname">Last Name</label><br>
                <input id="form" type="text" name="lastname" placeholder="Beck" value='<?= $lastname ?>'>
                <?php if (isset($errors['lastname'])) echo $errors['lastname'] ?><br>
            </div>
            <!-- Nick Name -->
            <div>
                <label for="nickname">Nick Name</label><br>
                <input id="form" type="text" name="nickname" placeholder="Alias Name" value='<?= $nickname ?>'>
                <?php if (isset($errors['nickname'])) echo $errors['nickname'] ?><br>
            </div>
            <!-- Email -->
            <div>
                <label for="email">Email</label><br>
                <input id="form" type="text" name="email" placeholder="henri.beck@gmail.com" value='<?= $email ?>'>
                <?php if (isset($errors['email'])) echo $errors['email'] ?><br>
            </div>
            <!-- Password -->
            <div>
                <label for="password">Password</label><br>
                <input id="form" type="password" name="password" placeholder="Enter your password" value='<?= $password ?>'>
                <?php if (isset($errors['password'])) echo $errors['password'] ?><br>
            </div>
            <!-- Confirm Password -->
            <div>
                <label for="confirm_password">Confirm Password</label><br>
                <input id="form" type="password" name="confirm_password" placeholder="Confirm your password" value='<?= $confirm_password ?>'>
                <?php if (isset($errors['confirm_password'])) echo $errors['confirm_password'] ?><br>
            </div>
            <!-- Submit Button -->
            <input id="submitBtn" type="submit" name="submitBtn" value="Register"><br>
            <article>
                Already have an account? <a href="http://192.168.64.2/Movie_database/Log-in-page.php">Login</a>
            </article>
        </form>
    </section>
</body>

</html>