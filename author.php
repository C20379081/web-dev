<!Doctype html>
<?php

    require_once 'Database.php';
    session_start(); 
    /*Checks if the useris logged in at the start of the page, if not sent back to the login page  */
    if (!isset($_SESSION["username"]))
    {
        header("location: Login.php");
    } 
    else 
    { 
        if(isset($_POST["author"]))
        {
            $book = $_POST["author"];
            //select all the books with the auhtor name like the input
            $sql = "SELECT * FROM Books WHERE Author LIKE '%$book%'";
            
            $result = $database->query($sql);
            $count = mysqli_num_rows($result);
            if($count > 0)
            {
                //display all the books
                echo '<table border = "1">';
                echo "<tr>";
                echo "<th> ISBN</th>";
                echo "<th>Book Title</th>";
                echo "<th>Author</th>";
                echo "<th>Edition</th>";
                echo "<th>Year</th>";
                echo "<th>Reserved?</th>";
                echo "<th>Reserve Book</th>";
                echo "</tr>";
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
                    echo('<a href="reserve.php?ISBN='.htmlentities($row["ISBN"]).'"> Reserve</a>');
                    echo"</td></tr>\n";

                }
                    
            }
                echo '</table>';
        }
        else
        {
            echo "There is no books by that author";
        }
        $_SESSION["ISBN"] = $row["ISBN"];

    }
    
    ?>
<html>
    <head>
        <title>
            Search Author
        </title>
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
    </head>
    <body>
    <header>
        <h1>
            Search Page
        </h1>
        <li> <a href = "search.php"> Select a new option </a> </li>
        <li> <a href = "LibraryHomePage.php"> Go back to the homepage </a> </li>
    </header>

    <section id = "content">
    <h2> Search for book by its author </h2>
    <form method='post'>
            <label>Author</label>
            <input type="text" name="author"/>
        <button type="submit" name="login" value="login">search</button>
    </form>
    
    </body>
    <footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>