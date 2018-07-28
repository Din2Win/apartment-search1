<!doctype html>

<html lang="en-us">

<head>

    <meta charset="utf-8">
    <title>Login</title>
    <link href="../Lesson12/css/apts.css" rel="stylesheet">


</head>

<body>
    <div id="container">

        <h2>Join Now -- It's FREE!</h2>
        <h3>Already a member? Please
            <button onclick="showLogin()" style="font-size:1.1rem; background-color:transparent; font-weight:bold:">Log in</button>
        </h3>

        <div id="login-div" style="padding:5px; background-color:papayawhip; display:none;">
            
                <button onclick="hideLogin()" style="float:right; font-size:1.1rem; background-color:#999; font-weight:bold:">X</button>

            <form method="post" action="loginProc.php">
                

                <p><input type="text" name="user" required placeholder="User Name"></p>

                <p><input type="password" name="pswd1" required placeholder="Password"></p>
                
                <p><button>LOGIN</button></p>

            </form>

        </div>

        <div id="join-div" style="padding:5px; background-color:peachpuff;">
            

            <form method="post" action="memberJoinProc.php" onsubmit="return validatePasswords()">
                
                <p><input type="text" name="firstName" id="firstName" required placeholder="First Name"></p>

                <p><input type="text" name="lastName" id="lastName" required placeholder="Last Name"></p>

                <p><input type="email" name="email" id="email" required placeholder="Email"></p>

                <p><input type="text" name="user" id="user" required placeholder="User Name"></p>

                <p><input type="password" name="pswd" id="pswd" required placeholder="Password"></p>

                <p><input type="password" name="pswd2" id="pswd2" required placeholder="Re-type Password"></p>

                <p><button>Submit</button></p>

            </form>
        </div>
    </div>
</body>
    
<script>
    const loginDiv = document.getElementById('login-div');

    function validatePasswords() {
        //check to see if the passwords match
        var pswd = document.getElementById("pswd").value;
        var pswd2 = document.getElementById("pswd2").value;
        if (pswd != pswd2) {
            alert("Passwords do not match!");
            return false;
        } // end if
    } // end function



    function showLogin() {
        loginDiv.style.display = "block";
    }

    function hideLogin() { // click x btn to hide login div
        loginDiv.style.display = "none";
    }

</script>
    
    <?php 

    // are we landing on this page fresh? or due to a redirect to try again after a failed login attempt?
    
    //set only if redirected after failed login attempt
    
    if(isset($_GET['tryagain'])) { 
    
        // show the login form
        echo '<script>showLogin();</script>';
    }

?>

</html>
