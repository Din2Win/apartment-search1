<form onsubmit="ajaxSaveBldg()">

    <p>Bldg Name: <input type="text" name="bldgName" id="bldgName"></p>
    <p>Num Floors: <input type="number" name="floors" id="floors"></p>
    <p>Year Built: <input type="number" name="yearBuilt" id="yearBuilt"></p>
    <p>Address: <input type="text" name="address" id="address"></p>
    <p>Email: <input type="text" name="email" id="email"></p>
    <p>Phone: <input type="text" name="phone" id="phone"></p>
    <p><button>Submit</button></p>

</form>

<script>

function ajaxSaveBldg() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.status == 200 && xhr.readyState == 4) {
            // handle the server response
            alert(xhr.responseText); // It worked (or not) 
        }
    }
    var url = "add-bldg-ajax-proc.php?";
    var bldgName = document.getElementById('bldgName');
    var floors = document.getElementById('floors');
    var yearBuilt = document.getElementById('yearBuilt');
    var address = document.getElementById('address');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone');
    
    var vars = "bldgName=" + bldgName;
    var += "&floors=" + floors; 
    var += "&yearBuilt=" + yearBuilt;
    var += "&address=" + address;
    var += "&email=" + email;
    var += "&phone=" + phone;
    
    var = encodeURI(vars);
    
    xhr.open("GET", "add-bldg-ajax-proc.php", true);
    xhr.send(); 
}

</script>
          
