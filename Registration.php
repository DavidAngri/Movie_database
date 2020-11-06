<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <?php
        $firstname = '';
        $lastname = '';
        $nickname = '';
        $email = '';
        $password = '';
        $confirm_password = '';
        
        if (isset($_POST['submitBtn']))
        {
            //  Retrieve form data and trim
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $nickname = trim($_POST['nickname']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            // Encrypt the Password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if (empty($firstname))
                echo 'First Name is Mandatory!!!';
            elseif (empty($lastname))
                echo 'Last Name is Mandatory!!!';
            elseif (empty($nickname))
                echo 'Nick Name is Mandatory!!!';    
            elseif (empty($email))
                echo 'Email is Mandatory!!!';    
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
                echo 'Enter a Valid Email';
            elseif (empty($password))
                echo 'Password is Mandatory!!!';    
            elseif (strlen($password) < 8)
                echo 'Passsword must contain more than 8 Characters';
            elseif (!$password == $confirm_password)    
                echo 'Password and Confirm Password must Match';
            else
            {
                require_once 'database.php';

                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                $query = "SELECT * FROM users WHERE email = '$email' ";
                $result = mysqli_query()
    
                $query1 = "INSERT INTO users(firstname, lastname, nickname, email, password) 
                            VALUES ('$firstname', '$lastname', '$email', '$hashedPassword')";
                
                $result1 = mysqli_query($conn, $query);


            }    

        }

    ?>

    <form action="" method="post">
        <div>
            <label for="firstname">First Name</label><br>
            <input type="text" name="firstname" placeholder="Henri" value= '<?= $firstname ?>'><br>
            <label for="lastname">Last Name</label><br>
            <input type="text" name="lastname" placeholder="Beck" value= '<?= $lastname ?>'><br>
            <label for="nickname">Nick Name</label><br>
            <input type="text" name="nickname" placeholder="Alias Name" value= '<?= $nickname ?>'><br>
            <label for="email">Email</label><br>
            <input type="email" name="email" placeholder="henri.beck@gmail.com" value= '<?= $email ?>'><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" placeholder="Enter your password" value= '<?= $password ?>'><br>
            <label for="confirm_password">Confirm Password</label><br>
            <input type="password" name="confirm_password" placeholder="Confirm your password" value= '<?= $confirm_password ?>'><br>
            <input type="submit" name="submitBtn" value="Register"><br>
            Already have an account? <a href="">Login</a>
        </div>
    </form>
</body>
</html>