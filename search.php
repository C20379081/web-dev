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
        // when the button is clicked it redirects to selected page
        if(isset($_POST["search"]))
        {
            $_SESSION['search'] = $_POST['search'];
            $search = $_SESSION['search'];
            switch($search)
            {
                case 'BookTitle':
                    header("Location: booktitle.php");
                    break;
                case 'Author':
                    header("location: author.php");
                    break;
                case 'Category':
                    header("location: category.php");
                    break;
                default:
                    header("Location: LibraryHomePage.php");

            }
        }
    }
?>
<html>
    <head>
        <title>
            Search page
        </title>
        <link rel = "stylesheet" type = "text/css" href = "style4.css">
    </head>
    <body>

    <header>
        <h1>
            Search Page
        </h1>
        <li> <a href = "LibraryHomePage.php"> Go back to the homepage </a> </li>
    </header>
    <section id="content">
    <form method="post">
        <div class="form-element">
            <label> Search By: Book title / Author / Category</label><select name="search">
            <option value = "BookTitle"> Book Title</option>
            <option value = "Author"> Author</option>
            <option value = "Category"> Category</option>
            </select><br>
       
            <button type="submit" name="searching">Search</button>
           
        </div>
    </form>
    </section>
    </body>
    <footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>