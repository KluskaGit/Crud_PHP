<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php
    include '../includes/dbconnect.php';

    $email = '';
    $password = '';
    $rpassword = '';
    $error_email = False;
    $error_password = False;
    if (isset($_POST['registerbtn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];


        $email_handler = mysqli_fetch_array(mysqli_query($connection, 'SELECT * FROM users WHERE email like "' . $email . '"'));

        if ($email_handler != []) {
            $error_email = True;
        } elseif ($password != $rpassword) {
            $error_password = True;
        } else {
            $password = password_hash($password, PASSWORD_ARGON2I);
            mysqli_query($connection, "INSERT INTO users (email,login ,password) values ('$email',  '$email', '$password')");
            header('Location: ../index.php');
        }
    }
    ?>
    <div class="container-fluid p-0">
        <main class="container">
            <div class="login_main">
                <h1 class="log_heading">Registration</h1>

                <form method="post">
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" name="email" required value=<?php echo $email ?>>
                        <?php
                        if ($error_email) {
                            echo '<span style="color: red">Account with this Email already exist.</span>';
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="PasswordField" class="form-label">Password</label>
                        <input type="password" class="form-control" id="PasswordField" name='password' required value=<?php echo $password ?>>
                    </div>
                    <div class="mb-3">
                        <label for="RepeatPasswordField" class="form-label">Repeat password</label>
                        <input type="password" class="form-control" id="RepeatPasswordField" name='rpassword' required value=<?php echo $rpassword ?>>
                        <?php
                        if ($error_password) {
                            echo '<span style="color: red">The passwords are not the same.</span>';
                        }
                        ?>
                    </div>
                    <div class="mb-3 signin_bttn">
                        <input class="whitebttn" name="registerbtn" type="submit" value="Register">
                    </div>
                </form>

            </div>
        </main>
    </div>

</body>

</html>