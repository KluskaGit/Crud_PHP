<div class="db_con">
    <?php
    $dbhost = 'localhost';
    $dbname = 'crud_db';
    $dbuser = 'root';
    $dbpassword = '';
    try {
        $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    } catch (Exception) {
        echo '<div style="text-align: center">Connection Failed</div>';
    }
    ?>
</div>