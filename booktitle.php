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
        if(isset($_POST["booktitle"]))
        {
            //assigns booktitle to a variable
            $book = $_POST["booktitle"];
            //selecting all the books
            $sql = "SELECT * FROM Books WHERE BookTitle LIKE '%$book%'";
            
            $result = $database->query($sql);
            $count = mysqli_num_rows($result);
            if($count > 0)
            {
                //display all the books with that title
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
                echo '</table>';
            }

        }
        else
        {
            echo "There is no books with that name";
        }
        
        if(isset($_POST["reserve"]))
    {
        header("location: reserve.php");

    }
    }    
    ?>
<html>
    <head>
        <title>
            Search Book Title
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
    <h2> Search for book by its title </h2>
    <form method="post">
        <div class="form-element">
            <label>Book Title </label>
            <input type="text" name="booktitle"/>
        </div>
        <button type="submit" name="login" value="login">Search</button>
    </form>
   
    
    </body>
    <footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>