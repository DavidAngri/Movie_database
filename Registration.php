<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <style>
        .errors{
            color: red;
        }
        form{
            height: 500px;
            width: 500px;
            border: 2px solid blue;
            margin-top: 10%;
            margin-left: 20%;
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
        if (count($errors) == 0)
        {
  
            require_once 'database.php';

            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            
            $query = "SELECT * FROM users WHERE email = '$email'";

            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 0)
            {

                $query_insert = "INSERT INTO users(firstname, lastname, nickname, email, password) 
                VALUES ('$firstname', '$lastname', '$nickname', '$email', '$hashedPassword')";

                $result_insert = mysqli_query($conn, $query_insert);
                echo '<h2>Welcome ' . $nickname . '</h2>';
            }
            else
                echo "User with the email $email already Exists....";

            
        }
    }

    ?>

    <form action="" method="post">
        <div>
            <!-- first Name -->
            <label for="firstname">First Name</label><br>
            <input type="text" name="firstname" placeholder="Henri" value='<?= $firstname ?>'>
            <?php if(isset($errors['firstname'])) echo $errors['firstname']?><br>
            <!-- last Name -->
            <label for="lastname">Last Name</label><br>
            <input type="text" name="lastname" placeholder="Beck" value='<?= $lastname ?>'>
            <?php if(isset($errors['lastname'])) echo $errors['lastname']?><br>
            <!-- Nick Name -->
            <label for="nickname">Nick Name</label><br>
            <input type="text" name="nickname" placeholder="Alias Name" value='<?= $nickname ?>'>
            <?php if(isset($errors['nickname'])) echo $errors['nickname']?><br>
            <!-- Email -->
            <label for="email">Email</label><br>
            <input type="text" name="email" placeholder="henri.beck@gmail.com" value='<?= $email ?>'>
            <?php if(isset($errors['email'])) echo $errors['email']?><br>
            <!-- Password -->
            <label for="password">Password</label><br>
            <input type="password" name="password" placeholder="Enter your password" value='<?= $password ?>'>
            <?php if(isset($errors['password'])) echo $errors['password']?><br>
            <!-- Confirm Password -->
            <label for="confirm_password">Confirm Password</label><br>
            <input type="password" name="confirm_password" placeholder="Confirm your password" value='<?= $confirm_password ?>'>
            <?php if(isset($errors['confirm_password'])) echo $errors['confirm_password']?><br>
            <!-- Submit Button -->
            <input type="submit" name="submitBtn" value="Register"><br>
            Already have an account? <a href="">Login</a>
        </div>
    </form>
</body>

</html>