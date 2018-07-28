<?php

    // load buildings for dynamic select menu -- see searchApts.php
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Add Apt-Bldg CMS</title>
<!-- <link href="css/apts.css" rel="stylesheet">-->
    
    <style>
        
        body {
            background-color: darkslategray;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #555;
            font-family: sans-serif;
            font-size: 1rem;
        }
    
        #apt, #bldg {
            position: absolute;
            left: 400px;
            top: 100px;
            width: 650px;
            height: 450px;
            padding: 25px;
            border-radius: 10px;
            margin: 25px;
        }
        
        #apt {
           background-color: papayawhip;
            z-index: 1;
        }
        
        #bldg {
            background-color: lightcyan;
            z-index: 2;
        }
        
        #apt-tab, #bldg-tab {
            position: absolute;
            left: 475px;
            top: 65px;
            width: 150px;
            height: 50px;
            padding: 10px 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            cursor: pointer;
            font-size: 1.5rem;
            z-index: 1;
        }
        
        #bldg-tab {
            background-color: lightcyan;
            left: 650px;
        }
        
        #apt-tab {
            background-color: papayawhip;
        }
        
        #bldg-tab:hover, #apt-tab:hover {
            color: green;
        }
        
        
        
    </style>
    
</head>
    
<body>
    
  <!-- 2 Absolute Position Divs: Add-an-Apt and Add-a-Bldg -->
  <div id="apt">
      
     <?php include 'includes/add-apt-form.php'; ?>
                
  </div>
  
  <div id="bldg">
      
      <?php include 'includes/add-bldg-form.php'; ?>
      
  </div>
    
  <!-- apt and bldg divs each need little tabs at top -->
  <div id="apt-tab" onclick="swapZindex()">apt</div>
  <div id="bldg-tab" onclick="swapZindex()">bldg</div>
    
  <script>
      
      // grab the two big divs
      const apt = document.getElementById('apt');
      const bldg = document.getElementById('bldg');
    
      function swapZindex() {
          // HINT: event.target is the div that was clicked
          // when a little div tab is clicked, you want the big div of matching color to go to the top of the stack
          if(event.target.id == 'apt-tab') {
             apt.style.zIndex = '2'; // put apt div on top
             bldg.style.zIndex = '1';
          } else { // if the bldg-tab was clicked
             bldg.style.zIndex = '2'; // put bldg div on top
             apt.style.zIndex = '1';
          }
      }
    
  </script>
    
</body>

</html>