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

    <?php
    include '../includes/dbconnect.php';
    $em_id = array();
    $edit_error = False;
    if (isset($_POST['deletebttn'])) {
        $em_id = $_POST['emid'];
        if ($em_id != []) {
            for ($i = 0; $i < count($em_id); $i++) {
                mysqli_query($connection, 'DELETE FROM employees where em_id=' . $em_id[$i] . '');
            }
            header('Location: crud.php');
        } else {
            header('Location: crud.php');
        }
    } elseif (isset($_POST['editbttn'])) {
        $em_id = $_POST['emid'];
        if ($em_id != []) {
            if (count($em_id) == 1) {
                $edit_error = False;
                header('Location: edit.php?emid=' . $em_id[0] . '');
            } else {
                $edit_error = True;
            }
        } else {
            header('Location: crud.php');
        }
    }
    ?>

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
                                <th>Date of Employment (YMD)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $all_employees = mysqli_query($connection, 'SELECT * FROM employees inner join positions ON employees.position=positions.pos_id');

                            while ($row = mysqli_fetch_array($all_employees)) {
                                echo '<tr>' .
                                    '<td><input name="emid[]" class="form-check-input" type="checkbox" value=' . $row['em_id'] . ' id="flexCheckDefault"></td>' .
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
                    <div class="buttons_section">
                        <section class="deleteandedit">
                            <input class="redbttn" type="submit" name="deletebttn" value="Delete">
                            <input class="yellowbttn" type="submit" name="editbttn" value="Edit">
                        </section>
                        <?php
                        if ($edit_error) {
                            echo '<span class="errors" style="text-align: right">You can select only one employee to edit.</span>';
                        }
                        ?>
                    </div>
                </form>
            </main>
        </div>
    </div>

</body>

</html>