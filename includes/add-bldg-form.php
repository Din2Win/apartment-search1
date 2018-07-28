<?php 
    require_once("conn/connApts.php");
    // load the buildings for the select menu
    $query = "SELECT IDbldg, bldgName FROM buildings ORDER BY bldgName ASC";
    $result = mysqli_query($conn, $query);
    echo mysqli_error($conn); // check to see if we have any errors yet
?>


<form method="post" action="CMS-add-apt-bldg-proc.php">
      
          <p>Bldg Name: <input type="text" name="bldgName"></p>
          <p>Num Floors: <input type="number" name="floors"></p>
          <p>Year Built: <input type="number" name="yearBuilt"></p>
          <p>Address: <input type="text" name="address"></p>
          <p>Email: <input type="text" name="email"></p>
          <p>Phone: <input type="text" name="phone"></p>
          <p><button>Submit</button></p>
          
      </form>