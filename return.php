<!Doctype html>    
    <?php
    
        require_once 'Database.php';
        session_start(); 
        $link = mysqli_connect("localhost", "root", "", "Assignment");
        $_SESSION["ISBN"] = htmlentities($row["ISBN"]);
        //assigns the isbn number from the previous page to a variable
        $isbn = $_GET['ISBN'];
        $username = $_SESSION["username"];
         // selecting books with that id number
        $sql = "SELECT * FROM Books INNER JOIN `Reserved Books` USING (ISBN) WHERE UserName = '$username'";
        echo "$isbn";
        $result = $database->query($sql);
        $count = mysqli_num_rows($result);
        if($count>0)
            {
                //delete books from reserve tablemand setting reserved back to N
                $sql = "DELETE FROM `Reserved Books` WHERE ISBN = '$isbn'";
                $sql2 = "UPDATE Books SET Reserved = 'N' WHERE ISBN = '$isbn'";
            //if true redirect to homepage 
            if(mysqli_query($link, $sql) === true)
            {
                echo"hey2";
                $database->query($sql2);
                $_SESSION['status'] = "Book Returned successfully";
                header("location: LibraryHomePage.php"); 
                exit;
            }
            else
                {
                    echo "Unsuccessfully returned!";
                }
            }

    ?>

<html>
    <head>
        <title>
            Reserve a Book
        </title>
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
    </head>
    <body>
    <header>
        <h1>
            Reserve a Book
        </h1>
    </header>
</html>