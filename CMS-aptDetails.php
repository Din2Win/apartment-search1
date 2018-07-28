<?php 
require_once("conn/connApts.php"); 
$IDapt = $_GET['IDapt'];
$query = "SELECT * FROM apartments, buildings, images WHERE apartments.bldgID = buildings.IDbldg AND IDapt = '$IDapt';";
$imageQuery = "SELECT * FROM apartments, images WHERE apartments.IDapt = images.foreignID AND IDapt = '$IDapt' AND catID = 1;";
$result = mysqli_query($conn, $query);
$imageResult = mysqli_query($conn, $imageQuery);
$row = mysqli_fetch_array($result);
$imageRow = mysqli_fetch_array($imageResult);
$row_cnt = $imageResult->num_rows;
echo mysqli_error($conn);
?>

<!DOCTYPE html>
<html>
    
<head>
    <title>Apartment <?php echo $row['apt']; ?> Details</title>
    <link href="css/apts.css" rel="stylesheet">
    
    <style>
        
        table, tr, td {
            border: 1px solid black;
            min-width:10px;
            min-height:10px;
        }
        
    </style>
    
</head>
    
<body>

  <form method="post" action="CMS-aptDetailsProc.php">
      
      <!-- include a hidden IDapt so that processor knows which record to update in the database -->
      <input type="hidden" name="IDapt" 
             value="<?php echo $row['IDapt']; ?>">
    
    <table>
        
        <tr>
            <td colspan="3">
                
                <h1>Apartment 
                    <input type="text" name="apt" 
                           style="width:50px; font-weight:bold"
                           value="<?php echo $row['apt']; ?>">
                    Details (Apt ID: <?php echo $row['IDapt']; ?>)
                </h1>
            
                Listing Title:<br/>
                <textarea name="aptTitle" cols="100" rows="2" style="font-size:1rem;padding:5px"><?php echo $row['aptTitle']; ?></textarea>
            
            </td>
            
        </tr>
        
        <tr>
            <td rowspan="3">
                
                <img width="200px" id="mainPic" src="images/propPics/<?php echo $imageRow['imgName'] == '' ? "SohoLoftsApt2.jpg": $imageRow['imgName']; ?>">
                
                <?php 
                    if($row_cnt > 1) { 
                        echo "<br>";
                        for($i = 1; $i < $row_cnt; $i++){
                            $imageRow = mysqli_fetch_array($imageResult);
                            echo '<img onclick="switchImage()" width="30px" src="images/propPics/' . $imageRow['imgName'] . '" id="' . $imageRow['imgName'] . '">';
                        }
                    }; 
                ?>
            </td>
            
            <td>
                Sq Ft: 
                <input type="number" name="sqft" style="width:100px"
                       value="<?php echo $row['sqft']; ?>">
                 &nbsp;  &nbsp; 
                Floor: 
                <input type="number" name="floor" style="width:100px"
                       value="<?php echo $row['floor']; ?>">
            </td>
            
            <td>
                Rent: $
                <input type="number" name="rent" style="width:100px"
                       value="<?php echo $row['rent']; ?>">
            </td>
            
        </tr>
        
        <tr>
            <td colspan="2">
                
            <!-- radio buttons set to Available or Occupied; isAvail = 1 = Available; isAvail = 0 = Occupied -->
                
                <input type="radio" name="isAvail" id="available" style="width:30px" value="1" 
                       <?php 
                            if($row['isAvail'] == 1) { 
                                echo 'checked'; 
                            }; 
                       ?>
                >
                <label for="available">Available</label>
                
                 &nbsp;  &nbsp;  &nbsp; 
                
                <input type="radio" name="isAvail" id="occupied" style="width:30px" value="0" <?php if($row['isAvail'] == 0) { echo 'checked'; }; ?>>
                <label for="occupied">Occupied</label>
                
                <br/><br/>
                
                <textarea name="aptDesc" cols="100" rows="5" style="font-size:1rem;padding:5px"><?php echo $row['aptDesc']; ?></textarea>
            </td>
        </tr>
        
        <tr>
            <td>
                Bedrooms: &nbsp; 
                
                <select name="bdrms">
                
                     <option value="0" 
                             <?php if($row['bdrms'] == 0) echo 'selected'; ?>> Studio</option>
                    
                     <option value="1"
                             <?php if($row['bdrms'] == 1) echo 'selected'; ?> >
                              1 Bedroom</option>
                    
                     <option value="2"
                             <?php if($row['bdrms'] == 2) echo 'selected'; ?> >
                             2 Bedrooms</option>
                    
                     <option value="3"
                             <?php if($row['bdrms'] == 3) echo 'selected'; ?> >
                             3 Bedrooms</option>
                    
                </select>
                
            </td>
            
            <td>
                Baths: &nbsp; 
            
                <select name="baths">
                
                     <option value="1" 
                             <?php if($row['baths'] == 1) echo 'selected'; ?> > 1 Bath</option>
                    
                     <option value="1.5"
                             <?php if($row['baths'] == 1.5) echo 'selected'; ?> >
                              1 1/2 Baths</option>
                    
                     <option value="2"
                             <?php if($row['baths'] == 2) echo 'selected'; ?> >
                             2 Baths</option>
                    
                     <option value="2.5"
                             <?php if($row['baths'] == 2.5) echo 'selected'; ?> >
                             2 1/2 Baths</option>
                    
                </select>
            
            </td>
            
        </tr>
        
        <tr>
            <!-- If a button inside a form does NOT have a type="button" attribute, it will submit the form when clicked. OR use <input type="submit" .. -->
            <td colspan="3" align="center">
                <button class="backButt" 
                        style="width:96%; padding:5px; margin:5px; background-color:#CFC; font-weight:bold; text-transform:uppercase">
                    Save Changes</button>
            </td>
        </tr>
        
    </table>
        
    <!-- type="button" allows a button to be inside a form, without submitting the form when button is clicked -->
    <button type="button" class="backButt" onclick="goBack()" width="100px">
        Click to go back</button>
        
  </form>
    
    <br>

    <script>
        
		function goBack() {
			window.history.back();
		}
        
        function switchImage() {
            let mainPic = document.getElementById('mainPic');
            let mainPicSrc = mainPic.src;
            let smallSrc = event.target.src;
            mainPic.src = smallSrc;
            event.target.src = mainPicSrc;
        }
        
    </script>
    
</body>
</html>