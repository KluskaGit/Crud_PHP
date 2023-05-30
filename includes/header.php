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
        </div>
    </nav>
</header>