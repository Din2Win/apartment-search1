<?php

    session_start(); 

    //check if username & password combo entered into login form has a match in the members table of the database. 
    require_once("conn/connApts.php");
    
    // grab the form vars
    $user = $_POST['user']; // Joey1
    $pswd = $_POST['pwsd']; // abc123 is NOT hashed 
    
    // step 1: query the database for just the user
    
    $query = "SELECT * FROM members WHERE user='$user'"; 

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    // step 2: see if the user's loaded pswd matches the pswd entered into the form 
    if(password_verify($pswd, $row['pswd'])) { // user is verified!
        
        // ########## MAKE SESSION VARIABLES to track and authenticate the user ##########
        $_SESSION['user'] = $row['row'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['IDmbr'] = $row['IDmbr'];
        
        $msg = "Welcome " . $_SESSION['firstName'];
    } else {
        // intruder alert! -- probably output message and then redirect somwhere
        $msg = "Login Failed! Intruder Alert! Redirecting..."; 
        header("Refresh:5; url='memberJoin-Login.php?tryagain=yes'", true, 303);
    }
?>

<!doctype html>

<html lang="en-us">

<head>

    <meta charset="utf-8">
    <title>Login Processor</title>
    <link href="../Lesson12/css/apts.css" rel="stylesheet">


</head>

<body>
    <div id="container">
        
        <h1>   
            <?php echo $msg ?>
        </h1>
    
    </div>

</body>

</html>
