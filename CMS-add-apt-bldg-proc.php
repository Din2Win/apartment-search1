<?php
    session_start();
    require_once('conn/connApts.php');
    
    if($_SESSION["bldgName"] != $_POST['bldgName']) {

        // if its the Add-a-Bldg form that was submitted
        // check any bldg var to see if it exists. If it does, these are the bldg form vars coming in
        if(isset($_POST['yearBuilt'])) {

            // incoming form vars
            $bldgName = $_POST['bldgName'];
            $floors = $_POST['floors'];
            $yearBuilt = $_POST['yearBuilt'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // write query to insert a new record into buildings table
            $query = "INSERT INTO buildings(bldgName, floors, yearBuilt, address, email, phone) VALUES('$bldgName', '$floors', '$yearBuilt', '$address', '$email', '$phone')";

        } else { // it was Add-an-Apt form that was submitted

            // incoming form vars
            $bldgID = $_POST['bldgID'];
            $floor = $_POST['floor'];
            $rent = $_POST['rent'];
            $bdrms = $_POST['bdrms'];
            $baths = $_POST['baths'];
            $sqft = $_POST['sqft'];
            $isAvail = $_POST['isAvail'];
            $apt = $_POST['apt'];

            // write query to insert a new record into buildings table
            $query = "INSERT INTO apartments(bldgID, floor, rent, bdrms, baths, sqft, isAvail, apt) VALUES('$bldgID', '$floor', '$rent', '$bdrms', '$baths', '$sqft', '$isAvail', '$apt')";

        }

        mysqli_query($conn, $query);
        
        $_SESSION["bldgName"] = $bldgName;
        
    } 
?>

<!DOCTYPE html>
<html lang="us-en">
    
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Apt-Bldg CMS Processor</title>
  <link href="css/apts.css" rel="stylesheet">
</head>

<body>
    
    <div id="container">
    
      <button onclick="window.history.back()">BACK</button>

      <?php 
        if(mysqli_affected_rows($conn) == 1) {
          echo 'Congrats! It worked!';  
        } else {
            'Sorry! It didn\'t work!';
        }
      ?>
        
    </div><!-- close container -->
        
</body>
    
</html>
