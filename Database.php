<!Doctype html>
<html>
    <?php
        $database = mysqli_connect('localhost', 'root', '', 'Assignment');
        if (!$database)
        {
            die("connection failed: ". mysqli_connect_error());
        }
    ?>
</html>