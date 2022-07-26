<!Doctype html>    
    <?php
        //conects the database
        require_once 'Database.php';
        session_start(); 
        $_SESSION["ISBN"] = htmlentities($row["ISBN"]);
        //assigns the isbn number from the previous page to a variable
        $isbn = $_GET['ISBN'];
        // selecting books with that id number
        $sql = "SELECT * FROM Books  WHERE ISBN = '$isbn'";
        $result = $database->query($sql);
        $row = mysqli_fetch_assoc($result); 
        $R = htmlentities($row['Reserved']);
        //if reserevd is = to no then enter if statement
    if($R == 'N')
    {
        //update database table books
        $sql = "UPDATE Books SET Reserved = 'Y' WHERE ISBN = '$isbn' AND Reserved = 'N'";
        $result = $database->query($sql);
        //if sql is true into info to reserved books table 
        if($result == true)
        {
            
            $query = "SELECT * FROM Registration";
            $result2 = $database->query($query);
        
            if($result2->num_rows > 0)
            {
                    // set session useranme toa variable 
                    $username = $_SESSION["username"];
                    $query2 = "INSERT INTO `Reserved Books` (ISBN, UserName, ReservedDate) VALUES ('$isbn', '$username', CURDATE())";
                    $result3 = $database->query($query2);
                    //redirect to homepage 
                    if($result3 == true)
                    {
                        $_SESSION['status'] = "Book Reserved successfully";
                        header("location:LibraryHomePage.php");            
                    }
            
            }
        }
        else
        {
            echo "There is no book with that number";
        }

    }
    else
    {
        header("Location: LibraryHomePage.php");
        $_SESSION['status'] = "Error reserving book, try again!";
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