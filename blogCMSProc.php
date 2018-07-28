<?php

    require_once("conn/connApts.php");

    // pass the POST vars from blogCMS.php form to "regular" variables
    $mbrID = $_POST['IDmbr'];
    
    // the strings need to have all single- and double-quotes escaped:
    $blogTitle = $_POST['blogTitle'];
    $blogTitle = mysqli_real_escape_string($conn, $blogTitle);

    $blogBlurb = $_POST['blogBlurb'];
    $blogBlurb = mysqli_real_escape_string($conn, $blogBlurb);

    $blogEntry = $_POST['blogEntry'];
    $blogEntry = mysqli_real_escape_string($conn, $blogEntry);

    // "C" for CRUD: Create new record with INSERT INTO command
    $query = "INSERT INTO blogs(blogTitle, blogBlurb, blogEntry, mbrID) VALUES('$blogTitle', '$blogBlurb', '$blogEntry', '$mbrID')";

    mysqli_query($conn, $query);
 
?>

<!DOCTYPE html>
<html lang="en-us">
    
<head>
    
    <title>Blog CMS Processor</title>
    <link href="css/apts.css" rel="stylesheet">
    
</head>

<body>

    <div id="container">
        
        <?php 
            
            if(mysqli_affected_rows($conn) == 1) {
                echo '<h1>Congrats! Blog Saved Successfully!<br/>
                    <a href="blog.php">Take Me to My Blog!</a></h1>';
            } else {
                echo '<h1>Sorry! Could Not Save Blog!<br/>
                    <a href="blogCMS.php">Try Again!</a></h1>';
            }
        
        ?>
    
    
    </div>

    
</body>
</html>