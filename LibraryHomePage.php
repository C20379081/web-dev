<!Doctype html>
<?php
       //CONNECTS the database to the page
    require_once 'Database.php';
    session_start(); 
    if(isset($_SESSION['status']))
    {
       echo $_SESSION['status']; 
       unset ($_SESSION['status']);
    }
    /*Checks if the user is logged in at the start of the page, if not sent back to the login page  */
    if (!isset($_SESSION["username"]))
    {
        header("location: Login.php");
    } 
    else { 
    // when the button is clicked it redirects to selected page
    if(isset($_POST["select"]))
    {
        $_SESSION['select'] = $_POST['select'];
        $select = $_SESSION['select'];
        switch($select)
        {
            case 'lookup_book':
                header("Location: search.php");
                break;
            case 'reserve_book':
                header("location: reserve.php");
                break;
            case 'reserved_book':
                header("location: reserved.php");
                break;
            case 'logout':
                session_start();
                session_destroy();
                header("location: Login.php");
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
            Home page
        </title>
        <link rel = "stylesheet" type = "text/css" href = "style3.css">
    </head>
    <body>

    <header>
        <h1>
            Home Page
        </h1>
    </header>    
    <form method="post">
    <div class="form-element">
            <label>What would you like to do?</label><select name="select">
            
            <option value = "lookup_book"> Look up availabilty</option>
            <option value = "reserved_book"> Check reserved books</option>
            <option value = "logout"> Log out</option></select><br>
            
            <button type="submit" name="search">Search</button>
           
</div>
    </form>

    </body>
    <footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>