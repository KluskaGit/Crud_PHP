<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <?php include '../includes/head.php' ?>
</head>

<body>

    <div class="container-fluid p-0 employees_site">
        <?php include '../includes/header.php' ?>
        <div class="container">
            <main class="login_main">
                <form method="post" class="emp_form">
                    <table class="table">
                        <thead class="table-light ">
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Date of Employment (RMD)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../includes/dbconnect.php';
                            $all_employees = mysqli_query($connection, 'SELECT * FROM employees inner join positions ON employees.position=positions.pos_id');

                            while ($row = mysqli_fetch_array($all_employees)) {
                                echo '<tr>' .
                                    '<td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>' .
                                    '<td>' . $row['em_id'] . '</td>' .
                                    '<td>' . $row['name'] . '</td>' .
                                    '<td>' . $row['surname'] . '</td>' .
                                    '<td>' . $row['position_name'] . '</td>' .
                                    '<td>' . $row['phone_number'] . '</td>' .
                                    '<td>' . $row['email_address'] . '</td>' .
                                    '<td>' . $row['city'] . '</td>' .
                                    '<td>' . $row['date_of_employment'] . '</td>' .
                                    '</tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </form>
            </main>
        </div>
    </div>

</body>

</html>