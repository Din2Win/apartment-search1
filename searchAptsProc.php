<?php 

// 1.) there is no form to process, so skip the POST / GET vars part
$bdrms = $_GET['bdrms'];
$baths = $_GET['baths'];
$minRent = $_GET['minRent'];
$maxRent = $_GET['maxRent'];
$bldgID = $_GET['bldgID']; // from dynamic bldg menu (Any==-1) 
$orderBy = $_GET['orderBy'];
$ascDesc = $_GET['ascDesc'];// radio button choice of ASC or DESC

// 2 + 3.) Connect to mysql, and select the database
require_once("conn/connApts.php");

// 4.) write out the CRUD "order" (query) -- what you want to do
$query = "SELECT * from apartments, buildings, neighborhoods
WHERE apartments.bldgID = buildings.IDbldg 
AND buildings.hoodID = neighborhoods.IDhood 
AND rent BETWEEN '$minRent' AND '$maxRent'";

// concat query if user chose a bldg from dynamic bldg menu
if($bldgID != -1) { // if user chose a bldg (not any)
    $query .= " AND bldgID='$bldgID'"; 
}

// concat query if user typed something into search box 
if($_GET['search'] != "") { // true if user typed something
    $search = $_GET['search'];
    $query .= " AND (aptDesc LIKE '%$search%'
                    OR bldgDesc LIKE '%$search%'
                    OR hoodDesc LIKE '%$search%'
                    OR bldgName LIKE '%$search%'
                    OR aptTitle LIKE '%$search%'
                    OR address LIKE '%$search%')";
}

// concat query for bdrms and baths if menu choice is not "any"
if($bdrms != "-1") { // if bdrms menu choice not "any"
    // filter for bdrms (concat query)
    // is it a plus sign choice of not? (1+, 2+) ... ? 
    // if rounding off bdrms does NOT change value, then bdrsms is an integer already (not 1.1 or 2.1)
    if($bdrms == round($bdrms)) {
     $query .= " AND bdrms='$bdrms'";
    } else { // rounding off DID change the vlaue, so bdrms is not and integer, but rather 1.1 or 2.1, lose the point.1
        $bdrms = round($bdrms);
        $query .= " AND bdrms'";
      }// end if-else
    }// end if 

if($baths != "-1") {
    $baths10 = $baths * 10; // baths times 10 avoids dividing by less than 1. 
    if($baths10 % 5 == 0) { //does $baths/5 yield a remainder?
      $query .= " AND baths='$baths' "; // no remainder means no plus sign
  } else { // $baths dived by 5 yields a remainder, so its a plus-sign value
        $baths -= 0.1; 
        $query .= " AND baths > '$baths'"; 
    }// end if-else
}// end if ($baths! =-1) 


// concat query for checkboxes -- "check" to see, one by one, if the checkboxes are actually checked

if(isset($_GET['doorman'])) { // is the doorman variable set. if so it came over from the form, meaning doorman was checked
    $query .= " AND isDoorman=1";
}

if(isset($_GET['pets'])) { 
    $query .= " AND isPets=1";
}

if(isset($_GET['parking'])) { 
    $query .= " AND isParking=1";
}

if(isset($_GET['gym'])) { 
    $query .= " AND isGym=1";
}



  // Order by *columnName* *ASC/DESC* <-- Sort based on a column
$query .= " ORDER BY $orderBy $ascDesc"; // this line must be last!!! 

// 5.) execute the order: read records from apartments table

$result = mysqli_query($conn, $query);  // the result will be an array of arrays (or, a multi-dimensional array)

// if (!$result) {
//    echo "$query .".mysqli_error($conn);
//}
//  how to check sqli error.... 
?>
<!DOCTYPE html>

<html lang="en-us">

<head>

    <meta charset="utf-8">

    <title>Apartment Search Processor</title>
    <link href="css/apts.css" rel="stylesheet">
</head>

<body>

    <table width="800" border="1" cellpadding="5">

        <tr>
            <td colspan="14" align="center">
                <h1 align="center">Lofty Heights Apartments</h1>
                <h2>
                    <?php echo mysqli_num_rows($result); ?> Results Found</h2>
            </td>
        </tr>
        
        <?php 
            if(mysqli_num_rows($result) == 0) {
                echo '<tr>
                        <td colspan="14">
                            <h3 align="center">Sorry! No results found! Please Search Again!
                                <button onclick="window.history.back()">Search Again</button><br/>
                                Redirecting...
                            </h3>
                        </td>
                      </tr>';
                header("Refresh:10; url=searchApts.php", true, 303); 
                
            } else {
             echo '
        <tr>
            <th>ID</th>
            <th>Apt</th>
            <th>Building</th>
            <th>Bedrooms</th>
            <th>Baths</th>
            <th>Rent</th>
            <th>Floor</th>
            <th>Sqft</th>
            <th>Status</th>
            <th>Neighborhood</th>
            <th>Doorman</th>
            <th>Pets</th>
            <th>Gym</th>
            <th>Parking</th>

        </tr>';
            }
        ?>
                

        <?php
        while($row = mysqli_fetch_array($result)) { ?>

            <tr>
                <td>
                    <?php echo $row['IDapt']; ?>
                </td>
                <td>
                    <?php 
								echo '<a href="aptDetails.php?aptID=' 
										. $row['IDapt'] . '">' 
										. $row['apt'] . '</a>';
							?>
                </td>
                <td>
                    <?php 
								echo '<a href="bldgDetails.php?bldgID=' 
										. $row['bldgID'] . '">' 
										. $row['bldgName'] . '</a>';
							?>
                </td>

                <td>
                    <?php
                              
                  // ternary as alternative to if-else
                  echo $row['bdrms'] == 0 ? 'Studio' : $row['bdrms'];
                           
                  // if-else version of the ternary above
//                  if($row['bdrms'] == 0) {
//                     echo 'Studio'; 
//                  } else {
//                      echo $row['bdrms'];
//                  }
                                                  
              ?>

                </td>
                <td>
                    <?php echo $row['baths']; ?>
                </td>
                <td>
                    $<?php echo number_format($row['rent']); ?>
                </td>
                <td>
                    <?php echo $row['floor']; ?>
                </td>
                <td>
                    <?php echo number_format($row['sqft']); ?>
                </td>
                <td>
                    <?php 
                    if($row['isAvail'] == 0) {
                      echo "Occupied";
                    } else { // value is 1
                      echo "Available";
                    }                
                ?>

                </td>
                <td>
                    <?php echo $row['hoodName']; ?>
                </td>
                <td>

                    <?php 
              
                    if($row['isDoorman'] == 0) {
                      echo 'No'; 
                    } else {
                      echo 'Yes';
                    }
              
                ?>

                </td>

                <td>
                    <?php echo $row['isPets'] == 0 ? 'No':'Yes'; ?>
                </td>

                <td>
                    <?php echo $row['isGym'] == 0 ? 'No':'Yes'; ?>
                </td>

                <td>
                    <?php echo $row['isParking'] == 0 ? 'No':'Yes'; ?>
                </td>

            </tr>

            <?php } ?>

    </table>

</body>

</html>
