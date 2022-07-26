<!Doctype html>
<html>
    <head>
        <title>
            Registration Page
        </title>
        <link rel = "stylesheet" type = "text/css" href = "style2.css">
    </head>
    <body>

    <header>
        <h1>
            Registration Page
        </h1>
        <li> <a href = "Login.php"> Already have an account? </a> </li>
    <section id = "content">    
    <?php
    //connects the database
    require_once 'Database.php';
    // if all the required inputs are met then enter the if statement

    if(isset($_POST["username"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["password"]) 
    && isset($_POST["password2"]) && isset($_POST["address"]) &&  
    isset($_POST["mobile"]) && isset($_POST["telephone"]))
    {
        //assign the input a varibale name
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $address = $_POST["address"];
        $mobile = $_POST["mobile"];
        $telephone = $_POST["telephone"];
        //get the length of te mobile and the password 
        $mobile_length = (STRING)$mobile;
        $password_length = (STRING)$password;
        //check if the mobile = 10 and the apssword = 6
        if ($password == $password2 && (strlen($mobile_length) == 10) && (strlen($password_length) == 6))
        {
            //insert  data into the database
            $sql = "INSERT INTO REGISTRATION 
            VALUES('$password', '$username', '$mobile',
            '$firstname','$lastname','$address', '$telephone')";
            //if true update reg table and redirect to homepage
            if($database->query($sql) === true)
            {
            $sql = "UPDATE Registration SET Username = '$username', Password = '$passsword'";
            $database->query($sql);
            header("Location:LibraryHomePage.php");
            exit;
            }
            //else error message appears
            else
            {
                echo "you hve entered an incorrect login";
            }
        }
        //  if there is an input erro, message will appear
        else
        {
            echo "Make sure passwords are the same | moblie number must be valid | password must be 6 characters";
        }
    }
    ?>

    <h2> Enter your Registration Details </h2>
    <form method="post">
        <div class="form-element">
            <label>Username</label>
            <input type="text" name="username" required />
        </div>
        <div class="form-element">
            <label>First Name</label>
            <input type="text" name="firstname"  />
        </div>
        <div class="form-element">
            <label>Last Name</label>
            <input type="text" name="lastname"  />
        </div>
        <div class="form-element">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <div class="form-element">
            <label>Confirm Password</label>
            <input type="password" name="password2"  />
        </div>
        <div class="form-element">
            <label>Address</label>
            <input type="text" name="address" />
        </div>
        <div class="form-element">
            <label>Mobile Number</label>
            <input type="number" name="mobile" />
        </div>
        <div class="form-element">
            <label>Telephone Number</label>
            <input type="number" name="telephone" />
        </div>

        <button type="submit" name="Submit" value="login"> Create Account</button>
    </form>
    </body>

    <footer>
    <h2>
        Site made by Harry O'Donnell TU856
    </h2>
    </footer>
</html>