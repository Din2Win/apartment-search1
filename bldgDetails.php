<?php
  
  require_once("conn/connApts.php");
  //Get the Variable passed in via the anchor link/URL
  $bldgID = $_GET['bldgID'];
  
  $query = "SELECT * FROM buildings WHERE IDbldg = '$bldgID'";
  $result = mysqli_query($conn, $query);
  
  //Store the row retrieved from the database
  $row = mysqli_fetch_array($result);

  // **## SECOND QUERY FOR MULTIPLE IMAGES FOR THIS BLDG **##
  // query the images table for all images for this ONE bldg
  $query2 = "SELECT * FROM images WHERE catID = 2
            AND foreignID = '$bldgID'";
  $result2 = mysqli_query($conn, $query2);
  $row2 = mysqli_fetch_array($result2); // first pic == "Big Pic"
  
?>
<!DOCTYPE html>
<html>
    
<head>
  <title><?php echo $row['bldgName']; ?> Details</title>
  <link href="css/apts.css" rel="stylesheet">
</head>
    
<body>

  <table border="1px">
      
    <tr>
      <td colspan="3">
        <h1><?php echo $row['bldgName']?></h1>
      </td>
    </tr>
      
    <tr>
        
      <td rowspan="2" style="max-width:385px">
          
        <!-- bldg slideshow big pic -->
        <img src="images/propPics/<?php echo $row2['imgName']; ?>" id="bigPic">
    
        <div id="thumbs" style="background-color:#555; padding:5px; 
                         overflow-x:scroll; max-height:100px; white-space:nowrap">
            
            <img src="images/propPics/<?php echo $row2['imgName']; ?>" style="width:70px; margin:5px" onclick="swapPic()">
            
            <!-- bldg slideshow thumbnails -->
            <?php while($row2=mysqli_fetch_array($result2)) { ?>

                <img src="images/propPics/<?php echo $row2['imgName']; ?>" style="width:70px; margin:5px" onclick="swapPic()">

            <?php } ?>
            
        </div><!-- close thumbs -->
          
      </td>
        
      <td>Floors: <?php echo $row['floors']; ?></td>
      <td>Year Built: <?php echo $row['yearBuilt']; ?></td>
    </tr>
      
    <tr>
      <td colspan="2"><?php echo $row['bldgDesc']; ?></td>
    </tr>
      
    <tr>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['email']; ?></td>
    </tr>
      
  </table>
    
    <script>
    
        // get the main slideshow pic
        const bigPic = document.getElementById('bigPic');
        
        // Yes! You can pass PHP vars to JS vars:
        // alert('<?php // echo $row['email']; ?>');
              
        // slideshow functionality
        function swapPic() { // runs on any thumb click
            // take the src of little thumb and apply it to big pic
            bigPic.src = event.target.src;
        }
    
    </script>

</body>
</html>