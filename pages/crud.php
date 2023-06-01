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
    $empty_table = False;
    $new_pos = '';
    $del_pos = array();

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
        }
    } elseif (isset($_POST['add_pos'])) {
        $new_pos = $_POST['new_pos'];
        if ($new_pos != '') {
            mysqli_query($connection, 'INSERT INTO positions (position_name, user_pos) value ("' . $new_pos . '", ' . $_SESSION['userID'] . ')');
            header('Location: crud.php');
        }
    } elseif (isset($_POST['del_pos'])) {
        $del_pos = $_POST['pos'];
        if ($del_pos != []) {
            for ($k = 0; $k < count($del_pos); $k++) {
                mysqli_query($connection, 'DELETE FROM positions where pos_id=' . $del_pos[$k] . '');
            }
            header('Location: crud.php');
        } else {
            header('Location: crud.php');
        }
    }
    ?>

    <div class="container-fluid p-0 employees_site">
        <?php include '../includes/header.php';
        $all_employees = mysqli_query($connection, 'SELECT * FROM employees inner join positions ON employees.position=positions.pos_id 
        WHERE (name like "%' . $SearchField . '%" or surname like "%' . $SearchField . '%" or position_name like "%' . $SearchField . '%" or phone_number like "%' . $SearchField . '%" 
        or email_address like "%' . $SearchField . '%" or city like "%' . $SearchField . '%" or date_of_employment like "%' . $SearchField . '%") and user_em=' . $_SESSION['userID'] . ' ORDER BY em_id');

        $emp = mysqli_query($connection, 'SELECT * FROM employees where user_em=' . $_SESSION['userID'] . '');
        $all_pos = mysqli_query($connection, 'SELECT * FROM positions where user_pos=' . $_SESSION['userID'] . '');

        if (mysqli_fetch_array($emp) == []) {
            $empty_table = True;
        }

        if (mysqli_fetch_array($all_pos) == []) {
            echo '<style>
                .addemployee{
                    display: none;
                }
            </style>';
        }



        ?>
        <div class="container">



            <!-- Change login modal-->
            <div class="modal fade" id="chng_login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" minlength="2" name="new_login" class="form-control" id="recipient-name">

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
            <!-- Add postion modal-->
            <div class="modal fade" id="pos_modal" tabindex="-1" aria-labelledby="pos_modal1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content change_login_modal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pos_modal1">Add new position</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">New position:</label>
                                    <input type="text" minlength="2" name="new_pos" class="form-control" id="recipient-name">

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-light" name="add_pos" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Delete postion modal-->
            <div class="modal fade" id="delete_pos" tabindex="-1" aria-labelledby="pos_modal1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content change_login_modal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pos_modal1">Delete positions</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" style="overflow:auto">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <ul class="list-group">
                                        <label for="recipient-name" class="col-form-label">Chose positions:</label>
                                        <?php
                                        while ($pos = mysqli_fetch_array($all_pos)) {
                                            echo '
                                            <li class="list-group-item" style="background-color: #191919">' .
                                                '<input name="pos[]" class="form-check-input me-1"  type="checkbox" value=' . $pos['pos_id'] . ' id="firstCheckbox">' .
                                                '<label class="form-check-label" for="firstCheckbox">' . $pos['position_name'] . '</label>' .
                                                '</li>';
                                        }
                                        ?>
                                    </ul>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-light" name="del_pos" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <main class="login_main">
                <?php
                if ($empty_table) {
                    echo '<h3>You have to add positions and next add a employee</h3>';
                } ?>

                <form method="post" <?php
                                    if ($empty_table) {
                                        echo 'style="display: none"';
                                    } ?> class="emp_form">
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





                            while ($row = mysqli_fetch_array($all_employees)) {
                                echo '<tr>' .
                                    '<td><input name="emid[]" class="form-check-input" type="checkbox" value=' . $row['em_id'] . ' id="empcheck"></td>' .
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