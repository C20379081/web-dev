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
        if(isset($_POST["category"]))
        {
            $book = $_POST["category"];
            //switch statment for all the categories
            switch($book)
            {
                case 'Health':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                case 'Business':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                case 'Biography':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                case 'Technology':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                case 'Travel':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                case 'Self-Help':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                case 'Cookery':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                case 'Fiction':
                    $sql = "SELECT * FROM Books INNER JOIN Category ON (Books.CategoryID = Category.CategoryID) WHERE CategoryDescription = '$book'";
                    break;
                default:
                    header("Location: LibraryHomePage.php");

            }
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
                echo '</table>';
            }
            else
            {
                echo "There is no books of that category";
            }
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
            Search Book Category
        </title>
        <link rel = "stylesheet" type = "text/css" href = "style5.css">
    </head>
    <body>
    <header>
        <h1>
            Search Category
        </h1>

        <li> <a href = "search.php"> Select a new option </a> </li>
        <li> <a href = "LibraryHomePage.php"> Go back to the homepage </a> </li>
    </header>

    
    <h2> Search the category of the book </h2>
    <section id = "content">
    <form method="post">
        <div class="form-element">
            <label>Category</label>
            <select name="category">
            <option value = "Health"> Health</option>
            <option value = "Business"> Business</option>
            <option value = "Biography"> Biography</option>
            <option value = "Technology"> Technology</option>
            <option value = "Travel"> Travel</option>
            <option value = "Self-Help"> Self-Help</option>
            <option value = "Cookery"> Cookery</option>
            <option value = "Fiction"> Fiction</option>
            </select>
        </div>
        <button type="submit" name="login" value="login">Search</button>
    </form>
    </section>
    
    </body>
    <footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>