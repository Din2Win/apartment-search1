<?php

    require_once("conn/connApts.php");

    // load the 11 most recent blogs: 1 for main and 10 for archive
    // load the newest blog first (catID = 3 = members)
    $query = "SELECT * FROM blogs, members, images WHERE blogs.mbrID = members.IDmbr
    AND images.foreignID = members.IDmbr
    AND images.catID = 3
    ORDER BY blogDateTime DESC LIMIT 11";

    $result = mysqli_query($conn, $query);

    // set aside the first result for prominent display in main
    $row = mysqli_fetch_array($result);
 
?>

<!DOCTYPE html>
<html lang="en-us">
    
<head>
    
    <title>Blog</title>
    <link href="css/apts.css" rel="stylesheet">
    
</head>

<body>

    <div id="container" style="width:95%; margin:0; min-height:80vh; background-color:#EEE">
        
        <main style="float:left; width:61%; margin:1%; padding:1%; background-color:#FFF; overflow-y:scroll; height:74vh">
            
            <h1>Latest Blog</h1>
            <h2><?php echo $row['blogTitle']; ?></h2>
            <h3><?php echo $row['blogBlurb']; ?></h3>
            
            <img src="images/<?php echo $row['imgName']; ?>" style="float:left; margin:10px; width:100px; height:100px; border-radius:50%">
            
            <h4>Author: <?php echo $row['firstName'] . ' ' . $row['lastName']; ?></h4>
            <h4>Posted: <?php echo date('D. M. d, Y - H:m', strtotime($row['blogDateTime'])); ?></h4>
            <hr/>
            <p><?php echo $row['blogEntry']; ?></p>
            
        </main>
        
        <aside style="float:right; width:31%; margin:1%; padding:1%; background-color:#EEF; overflow-y:scroll; height:74vh">
            
            <h2>Blog Archive</h2>
            
            <?php while($row = mysqli_fetch_array($result)) { ?>
            
                <a href="blogArchive.php?IDblog=<?php echo $row['IDblog']; ?>">
                    <h4><?php echo $row['blogTitle']; ?></h4>
                </a>
            
                <img src="images/<?php echo $row['imgName']; ?>" style="float:left; margin:10px; width:50px; height:50px; border-radius:50%">
            
                <p>Author: <?php echo $row['firstName'] . ' ' . $row['lastName']; ?><br/>
                Posted: <?php echo date('D. M. d, Y - H:m', strtotime($row['blogDateTime'])); ?></p>
                <hr/>
            
            <?php } ?>
            
        </aside>
    
    </div>

</body>
</html>