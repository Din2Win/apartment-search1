<?php 
    require_once("conn/connApts.php");
    // load the buildings for the select menu
    $query = "SELECT IDbldg, bldgName FROM buildings ORDER BY bldgName ASC";
    $result = mysqli_query($conn, $query);
    echo mysqli_error($conn); // check to see if we have any errors yet
?>


<form method="get" action="CMS-add-apt-bldg-proc.php">
          
  <table width="100%" border="0px" cellpadding="5px" align="center">

    <tr>
        <td colspan="2" align="center">
            <h2>Add-an-Apt CMS</h2>
        </td>
    </tr>

    <tr>
        <td> 
            Bedrooms:  
            <select name="bdrms" id="bdrms">
                <option value="-1">Please Choose</option>
                <option value="0">Studio</option>
                <option value="1">1 Bedroom</option>
                <option value="2">2 Bedrooms</option>
                <option value="3">3 Bedrooms</option>
            </select>
        </td>
        
        <td>
           Baths: 
            <select name="baths" id="baths">
                <option value="-1">Please Choose</option>
                <option value="1">1 Bath</option>
                <option value="1.5">1.5 Baths</option>
                <option value="2">2 Baths</option>
                <option value="2.5">2.5 Baths</option>
            </select>
        </td>
        
    </tr>

    <tr>
        <td>
            Availability: 
            <select name="isAvail" id="isAvail">
                <option value="-1">Please Choose</option>
                <option value="0">Occupied</option>
                <option value="1">Available</option>
            </select>
        </td>
        
        <td>
            Building: 
            <select name="bldgID" id="bldgID">
                <option value="-1">Please Choose</option>
            
            <!-- PHP while loop to output buildings as options 
                    see searchApts.php for this exact example -->
                <?php 
                        while($row=mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['IDbldg'] . '">'  . $row['bldgName'] . '</option>';  
                        }
                    ?>
                
            </select>
        </td>
    </tr>

    <tr>
        <td>
            Rent: 
            $ <input type="number" name="rent" style="width:50px"> &nbsp; 
            Sqft: 
            <input type="number" name="sqft" style="width:50px">
        </td>
        <td>
            Floor:
            <input type="number" name="floor" style="width:50px"> &nbsp; 
            Apt: 
            <input type="text" name="apt" style="width:50px">
        </td>
    </tr>

    <tr>
        <td colspan="2" align="center">

            <button name="submit-apt">SAVE</button>
                
        </td>
    </tr>

  </table>
     
</form>