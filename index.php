<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <?php include 'includes/head.php'; ?>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-fluid p-0">
        <div class="container">

            <main class="login_main">
                <h1 class="log_heading">Log in</h1>
                <form method="post">
                    <div class="mb-3">
                        <label for="EmailOrLogin" class="form-label">Email/Login</label>
                        <input type="email" class="form-control" id="EmailOrLogin" required>
                    </div>

                    <div class="mb-3">
                        <label for="PasswordField" class="form-label">Password</label>
                        <input type="password" class="form-control" id="PasswordField" required>
                    </div>
                    <div class="mb-3 index_bttns">
                        <input class="whitebttn" name="login" type="submit" value="Sign in">
                        <form action="pages/register.php">
                            <input class="whitebttn" name="register" type="submit" value="Register">
                        </form>
                    </div>
                </form>
            </main>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>