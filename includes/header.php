<header>
    <?php
    $SearchField = '';

    if (isset($_POST['Search'])) {
        $SearchField = $_POST['SearchField'];
    }


    ?>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form method="post" class="d-flex" role="search">
                <input class="form-control me-2" name="SearchField" type="search" placeholder="Search" aria-label="Search">
                <input class="searchbttn" name="Search" type="submit" value="Search">
            </form>


            <ul class="nav nav-pills user_drop">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#pos_modal" style="color: white" href="#">Add position</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: white" href="../pages/add_em.php">Add employee</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo $user_name['login'] ?></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#chng_login">Change login</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item " href="logout.php">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>