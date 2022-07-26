<!Doctype html>
<?php
session_start(); 
/* makes database connection */
require_once 'Database.php';   
unset($_SESSION["username"]);    
/*Makes sure the username and password are from the database, then enter the if statement */
if (isset($_POST["username"]) && isset($_POST["password"])) 
{    
    $username = $_POST["username"];
    $password = $_POST["password"];
    /* Query to select username and password equal to the inputted ones*/ 
    $sql = "SELECT Password, Username FROM Registration WHERE Username = '$username' and Password = '$password'";
    $result = $database->query($sql);
    $count = mysqli_num_rows($result);
    // if successful redirect to homepage
    if($count > 0)
    {
        $_SESSION["username"] = $_POST["username"]; 
        $_SESSION["success"] = "Logged in.";
        header("Location:LibraryHomePage.php");
        exit;
    }
    //if not sucessful error message + try again 
    else
    {
        echo "You Entered the wrong username or password!";
        $_SESSION["error"] = "Incorrect password.";
        header( 'Location: Login.php' ) ; 
        return;   
    }  
} 
else if ( count($_POST) > 0 ) 
{  
    $_SESSION["error"] = "Missing Required Information"; 
    header( 'Location: Login.php' ) ;        
    return;   
}
?>
<html>
    <head>
        <title>
            Login Page
        </title>
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
    </head>
    <body>
    <header>
        <h1>
            Login Page
        </h1>

        <li> <a href = "registrationPage.php"> Create new account </a> </li>
    </header>

    <section id = "content">

<h2> Enter your Login Details </h2>
    <form method="post">
        <div class="form-element">
            <label>Username</label>
            <input type="text" name="username" required />
        </div>
        <div class="form-element">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <button type="submit" name="login" value="login">Log In</button>
    </form>
    </body>
    <footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>