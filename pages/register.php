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
    <div class="container-fluid p-0">
        <main class="container">
            <div class="login_main">
                <h1 class="log_heading">Registration</h1>
                <form method="post">
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="PasswordField" class="form-label">Password</label>
                        <input type="password" class="form-control" id="PasswordField" required>
                    </div>
                    <div class="mb-3">
                        <label for="RepeatPasswordField" class="form-label">Repeat password</label>
                        <input type="password" class="form-control" id="RepeatPasswordField" required>
                    </div>
                    <div class="mb-3 signin_bttn">
                        <input class="whitebttn" name="register" type="submit" value="Register">
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>

</html>