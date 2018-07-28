<?php

    require_once("conn/connApts.php");
    // query the members table for all mbrs
    $query = "SELECT IDmbr, firstName, lastName
    FROM members ORDER BY lastName ASC";
    
    // execute the query
    $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en-us">
    
<head>
    
    <title>Blog CMS</title>
    <link href="css/apts.css" rel="stylesheet">
    
</head>

<body>

    <div id="container">
    
        <form method="post" action="blogCMSProc.php" 
              onsubmit="return checkAuthor()">
        
            <h1>Blog CMS</h1>
            
            <p>Author:
                
                <select name="IDmbr" id="IDmbr">
                    
                    <option value="-1">Choose</option>
                    
                    <?php 
                        while($row=mysqli_fetch_array($result)) { 
                            echo '<option value="' . $row['IDmbr'] . '">' . $row['firstName'] . ' ' . $row['lastName'] . '</option>';
                        }
                    ?>
                    
                </select>
                
            </p>
            
            <p>
                <input type="text" name="blogTitle" id="blogTitle"
                       style="width:100%" placeholder="Title" required>
            </p>
            
            <p>
                <input type="text" name="blogBlurb" id="blogBlurb"
                       style="width:100%" placeholder="Secondary Title" required>
            </p>
            
            <p>
                <textarea name="blogEntry" id="blogEntry" style="width:100%; font-size:1rem" rows="10" placeholder="Enter Blog Here" required></textarea>
            </p>
            
            <p>
                <button style="width:100%; padding:5px; background-color:#CFC; font-weight:bold; font-size:1rem">SAVE</button>
            </p>
        
        </form>
    
    </div>
    
    <script>
        
        function checkAuthor() {
            // make sure user chose an Author from select menu
            // get the value from the select menu (-1 if no author chosen)
            const IDmbr = document.getElementById('IDmbr').value;
            if(IDmbr == -1) { // first choice "Choose" value is -1
                alert('Please Choose An Author!');
                return false;
            }
        }
    
    </script>
    
    
</body>
</html>