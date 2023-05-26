<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
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
                    <div class="mb-3 signin_bttn">
                        <input class="whitebttn" name="login" type="submit" value="Sign in">
                    </div>
                </form>
                <span>Don't have account? Register <a href="pages/register.php">here</span>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous" defer></script>
</body>

</html>