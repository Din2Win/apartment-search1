<?php

    require_once("conn/connApts.php"); 

    $IDapt = $_GET['IDapt']; // From the URL

    // ##** FIRST QUERY : JUST THE ONE APT'S DATA
    $query = "SELECT * FROM apartments, buildings 
    WHERE apartments.bldgID = buildings.IDbldg 
    AND IDapt = '$IDapt'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    // **## SECOND QUERY : MULTIPLE IMAGES FOR THIS ONE APT **##
    // query the images table for all images for this ONE apt
    $query2 = "SELECT * FROM images WHERE catID = 1
            AND foreignID = '$IDapt'";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_array($result2); // first pic == "Big Pic"

?>

<!DOCTYPE html>
<html>
<head>
    <title>Apartment <?php echo $row['apt']; ?> Details</title>
    <link href="css/apts.css" rel="stylesheet">
</head>
<body>
<style>
    table, tr, td {
        border: 1px solid black;
        min-width:10px;
        min-height:10px;
    }
</style>
    <table>
        <tr>
            <td colspan="3"><h1>Apartment <?php echo $row['apt']; ?> Details</h1></td>
            
        </tr>
        <tr>
            <td rowspan="2" style="max-width:385px">
          
                <!-- apt slideshow big pic -->
                <img src="images/propPics/<?php echo $row2['imgName']; ?>" id="bigPic">

                <div id="thumbs" style="background-color:#555; padding:5px; 
                                 overflow-x:scroll; max-height:100px; white-space:nowrap">

                    <img src="images/propPics/<?php echo $row2['imgName']; ?>" style="width:70px; margin:5px" onclick="swapPic()">

                    <!-- apt slideshow thumbnails -->
                    <?php while($row2=mysqli_fetch_array($result2)) { ?>

                        <img src="images/propPics/<?php echo $row2['imgName']; ?>" style="width:70px; margin:5px" onclick="swapPic()">

                    <?php } ?>

                </div><!-- close thumbs -->

            </td>
            
            <td>Square Feet: <?php echo $row['sqft']; ?></td>
            <td>Rent: $<?php echo $row['rent']; ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $row['aptDesc']; ?></td>
        </tr>
        <tr>
            <td>Address: <?php echo $row['address']; ?></td>
            <td>Phone: <?php echo $row['phone']; ?></td>
            <td>Email: <?php echo $row['email']; ?></td>
        </tr>
    </table>
    <br>
    <button class="backButt" onclick="goBack()" width="100px">Click to go back</button>

    <script>
		function goBack() {
			window.history.back();
		}
        
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