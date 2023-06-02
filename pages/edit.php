<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php
    include '../includes/dbconnect.php';
    session_start();
    if (!isset($_SESSION['userID'])) {
        header('Location: ../index.php');
    }
    $emid = $_GET['emid'];

    $em_data = mysqli_fetch_array(mysqli_query($connection, 'SELECT * FROM employees inner join positions ON employees.position=positions.pos_id where em_id=' . $emid . ''));

    $name = '';
    $surname = '';
    $position = '';
    $phone = '';
    $email = '';
    $city = '';
    $date_em = '';
    if (isset($_POST['SaveEdit'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $position = $_POST['position'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $date_em = $_POST['date_em'];

        mysqli_query($connection, 'UPDATE employees set name="' . $name . '", surname="' . $surname . '", position=' . $position . ', 
        phone_number=' . $phone . ', email_address="' . $email . '", city="' . $city . '", date_of_employment="' . $date_em . '" where em_id=' . $emid . '');
        header('Location: crud.php');
    }
    mysqli_close($connection);
    ?>
    <div class="container-fluid p-0">
        <div class="container">

            <main class="login_main">
                <h1 class="log_heading">Edit</h1>
                <form method="post">
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" name='name' class="form-control" id="Name" required value=<?php echo $em_data['name'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="Surname" class="form-label">Surname</label>
                        <input type="text" name='surname' class="form-control" id="Surname" required value=<?php echo $em_data['surname'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="Position" class="form-label">Position</label>
                        <select name="position" class="form-select" id='Position' aria-label="Default select example">
                            <?php
                            $positions_list = mysqli_query($connection, 'SELECT * From positions where pos_id!=' . $em_data['position'] . ' and user_pos=' . $_SESSION['userID'] . '');
                            echo '<option selected value=' . $em_data['position'] . '>' . $em_data['position_name'] . '';
                            while ($row = mysqli_fetch_array($positions_list)) {
                                echo '<option value=' . $row['pos_id'] . '>' . $row['position_name'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Phone" class="form-label">Phone number</label>
                        <input type="number" name='phone' class="form-control" id="Phone" required value=<?php echo $em_data['phone_number'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" name='email' class="form-control" id="Email" required value=<?php echo $em_data['email_address'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="City" class="form-label">City</label>
                        <input type="text" name='city' class="form-control" id="City" required value=<?php echo $em_data['city'] ?>>
                    </div>
                    <div class="mb-3">
                        <label for="Date" class="form-label">Date of employment</label>
                        <input type="date" name='date_em' class="form-control" id="Date" required value=<?php echo $em_data['date_of_employment'] ?>>
                    </div>


                    <input class="yellowbttn" type="submit" name="SaveEdit" value="Save">

                </form>

            </main>

        </div>
    </div>

</body>

</html>