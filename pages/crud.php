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
    session_start();
    if (!isset($_SESSION['userID'])) {
        header('Location: ../index.php');
    }

    $user_name = mysqli_fetch_array(mysqli_query($connection, 'SELECT login From users where user_id=' . $_SESSION['userID'] . ''));

    $em_id = array();
    $edit_error = False;
    $new_login = '';
    $empty_login = False;

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
    } elseif (isset($_POST['ChangeLogin'])) {
        $new_login = $_POST['new_login'];
        if ($new_login != '') {
            mysqli_query($connection, 'UPDATE users set login="' . $new_login . '" where user_id=' . $_SESSION['userID'] . '');
            header('Location: crud.php');
        } else {
            $empty_login = True;
        }
    }
    ?>

    <div class="container-fluid p-0 employees_site">
        <?php include '../includes/header.php' ?>
        <div class="container">

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content change_login_modal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Change your login</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">New login:</label>
                                    <input type="text" name="new_login" class="form-control" id="recipient-name">

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-light" name="ChangeLogin" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                            if ($SearchField == '') {
                                $all_employees = mysqli_query($connection, 'SELECT * FROM employees inner join positions ON employees.position=positions.pos_id');
                            } else {
                                $all_employees = mysqli_query($connection, 'SELECT * FROM employees inner join positions ON employees.position=positions.pos_id 
                                WHERE name like "%' . $SearchField . '%" or surname like "%' . $SearchField . '%" or position_name like "%' . $SearchField . '%" or phone_number like "%' . $SearchField . '%" 
                                or email_address like "%' . $SearchField . '%" or city like "%' . $SearchField . '%" or date_of_employment like "%' . $SearchField . '%"');
                            }


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