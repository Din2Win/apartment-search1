<?php

	require_once("conn/connApts.php");
	// get variable from 
	$bldgID = $_GET['bldgID'];

	$query = "SELECT * From buildings WHERE IDbldg = '$bldgID'";
	$result = mysqli_query($conn, $query);
	
	// Store the row retrieved from the database
	$row = mysqli_fetch_array($result);

	//echo $row['bldgName];
	//echo $row['address'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $row['bldgName'];?> Details</title>
	<link href="css/apts.css" rel="stylesheet">
	<script>
		function goBack(){ window.history.back();}
	</script>
</head>

<body>
	
<!-- 4 row 3 column table 
	NAME 	NAME 	NAME
	IMG 	FLOORS 	YEARBUILT
	IMG 	DESC 	DESC
	ADDRESS	PHONE	EMAIL
-->
	<form method="post" action="CMS-bldgDetailsProc.php">
		<!-- include hidden IDbldg for processor to know which record to update-->
		<input type="hidden" name="IDbldg" value="<?php echo $row['IDbldg']; ?>">
		<table>
			<tr>
				<td colspan="3">
					<h1>
						<input type="text" name="bldgName" 
								   style="width:200px;"
								   value="<?php echo $row['bldgName']?>">
						Details (Bldg ID: <?php echo $row['IDbldg']; ?>)
					</h1>
				</td>
			</tr>

			<tr>
				<td colspan="3" align="center">
					<input type="checkbox" name="doorman" id="doorman" class="cbW"<?php if($row['isDoorman'] == 1) echo 'checked'; ?>>
					<label for="doorman">Doorman</label>
					
					<input type="checkbox" name="pets" id="pets" class="cbW"<?php if($row['isPets'] == 1) echo 'checked'; ?>>
					<label for="pets">Pet-friendly</label>
					
					<input type="checkbox" name="parking" id="parking" class="cbW"<?php if($row['isParking'] == 1) echo 'checked'; ?>>
					<label for="parking">Parking</label>
					
					<input type="checkbox" name="gym" id="gym" class="cbW"<?php if($row['isGym'] == 1) echo 'checked'; ?>>
					<label for="gym">Gym</label>
					
				</td>
			</tr>

			<tr>
				<td rowspan="2">
					<img src="images/loft1.jpg">
				</td>
				<td>
					Floors:
					<input type="number" name="floors" id="floors"
							   style="width:50px;"
							   value="<?php echo $row['floors'];?>">
				</td>
				<td>
					Year Built: 
					<input type="number" name="yearBuilt" id="yearBuilt"
							   style="width:100px;"
							   value="<?php echo $row['yearBuilt'];?>">
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<textarea name="bldgDesc" cols="100" rows="5" style="font-size:1rem; padding:5px"><?php echo $row['bldgDesc'];?></textarea>
				</td>
			</tr>

			<tr>
				<td>
					Address:
					<input type="text" name="address" id="address"
						  value="<?php echo $row['address'];?>">
				</td>
				<td>
					Phone:
					<input type="tel" name="phone" id="phone"
						   style="width:150px;"
						  value="<?php echo $row['phone'];?>">
				</td>
				<td>
					Email:
					<input type="email" name="email" id="email"
						   style="width:300px;"
						  value="<?php echo $row['email'];?>">
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center">
					<button class="backBtn" style="width:100%; padding:5px; font-weight:bold; font-size:1rem; background-color:#8E8;">Save Changes</button>
				</td>
			</tr>
		</table>
		<button type="button" onclick="goBack()">Back to Search Results</button>
	</form>

</body>
</html>