<?php 

// 1.) connect to MySQL
require_once("conn/connApts.php");

// processor for form on memberJoin.php
// 2.) pass incoming form data to "regular" php variables
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$user = $_POST['user'];
$pswd = $_POST['pswd'];

// 3.) hash (encrypt) the password ; for example: 6b6f7c011ea28ea526d8513538747f8e78395e4d4c694f0fdc7e4ed101198f21
$hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);

// 4.) write CRUD "order" (query) what you want to do w DB

$query = "INSERT INTO members(firstName, lastName, email, user, pswd) VALUES('$firstName', '$lastName', '$email', '$user', '$hashed_pswd')";

// 5.) insert new record into members table

mysqli_query($conn, $query);

// 6.) feedback (confirmation)

$registered = mysqli_affected_rows($conn); // $registered = 1 if it worked

// if it worked (if $registered == 1), make a folder for new member
if($registered == 1) {
    
    $mbr_folder = 'members/' . $user;
    mkdir($mbr_folder, 0777); // mkdir means make directory (folder)
    
    // make sub-folders inside the main member folder
    $images_folder = $mbr_folder . '/images';
    mkdir($images_folder, 0777);
    
    $audio_folder = $mbr_folder . '/audio';
    mkdir($audio_folder, 0777);
    
    $video_folder = $mbr_folder . '/video';
    mkdir($video_folder, 0777);
    
    $pdf_folder = $mbr_folder . '/pdf';
    mkdir($pdf_folder, 0777);
        
}

?>

<!doctype html>

<html lang="en-us">
    
<head>
    
    <meta charset="utf-8">
    
    <title>Member Join Processor</title>
    
</head>

<body>
    
        <h1>Thank you for joining!</h1>
    
    <?php if($registered == 1){
    echo "Welcome " . $firstName . " " . $lastName . "! Thanks for signing up, your information has been recorded.";
    }
else{
    echo "Sorry, ${$firstName} ${$lastName}! Couldn't sign you up!";
}
    ?>
    
</body>
   
</html>