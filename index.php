<!DOCTYPE html>
<?php 
include("include/database.php");
include("internals/User.php"); 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test</title>
        
        <script type="text/javascript" >
            function load_data() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
                        document.getElementById("json_data").innerHTML = xmlhttp.responseText;
                    }
                };
                
                xmlhttp.open("GET", "config/get_user_info.php?name=Test", true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body onload="load_data()">
        <div id="json_data"></div>
    </body>
</html>
