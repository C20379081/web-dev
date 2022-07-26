<!DOCTYPE html>
<?php
session_start(); 
$link = mysqli_connect("localhost", "root", "", "Assignment");
require_once 'Database.php';
/*Checks if the useris logged in at the start of the page, if not sent back to the login page  */
if (!isset($_SESSION["username"]))
    {
        header("location: Login.php");
    } 
else 
{ 
    $username = $_SESSION["username"];
    //select from books and reserved table whith the sleected username
    $sql = "SELECT * FROM Books INNER JOIN `Reserved Books` USING (ISBN) WHERE UserName = '$username'";

    if($result = $database->query($sql))
    {   //display all the books reserved the user 
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table>";
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th> ISBN</th>";
            echo "<th>Book Title</th>";
            echo "<th>Author</th>";
            echo "<th>Edition</th>";
            echo "<th>Year</th>";
            echo "<th>Reserved?</th>";
            echo "<th>Username</th>";
            echo "<th>Date Rented</th>";
            echo "<th>Return Book</th>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo"<tr><td>";
                echo(htmlentities($row['ISBN']));
                echo"</td><td>";
                echo(htmlentities($row['BookTitle']));
                echo"</td><td>";
                echo(htmlentities($row['Author']));
                echo"</td><td>";
                echo(htmlentities($row['Editon']));
                echo"</td><td>";
                echo(htmlentities($row['Year']));
                echo"</td><td>";
                echo(htmlentities($row['Reserved']));
                echo"</td><td>";
                echo(htmlentities($row['UserName']));
                echo"</td><td>";
                echo(htmlentities($row['ReservedDate']));
                echo"</td><td>";
                echo('<a href="return.php?ISBN='.htmlentities($row["ISBN"]).'"> Return</a>');
                echo"</td></tr>\n";
            
            }
            echo "</table>";
            mysqli_free_result($result);
        } 
        else
        {
            echo "No records matching your query were found.";
        }
    } 
    else
    {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    
    if(isset($_POST["return"]))
    {
            $book = $_SESSION['ISBN'];
            $result = $database->query($sql);
            $count = mysqli_num_rows($result);
            if($count>0)
            {
                $sql = "DELETE FROM `Reserved Books` WHERE ISBN = '$book'";
                $sql2 = "UPDATE Books SET Reserved = 'N' WHERE ISBN = '$book'";
            
            if(mysqli_query($link, $sql) === true)
            {
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
    }

    mysqli_close($link);
}
?>
<html>
    <head>
    <title>
            Reserved Books
    </title>
    <link rel = "stylesheet" type = "text/css" href = "style3.css">
    <header>
        <h1>
            Your Reserved Books
        </h1>
        <li> <a href = "LibraryHomePage.php"> Go back to the homepage </a> </li>
    </header>
    </head>

<footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>