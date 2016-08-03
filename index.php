<!DOCTYPE html>
<?php 
include("include/database.php");
include("internals/User.php"); 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test</title>
    </head>
    <body>
        <?php
        // put your code here
            $mysqli_link = @mysqli_connect(db_host, db_user, db_pass, db_name);
            
            if (!$mysqli_link) {
                die('{"error":' . mysqli_connect_errno() . 
                        ',"string":"' . mysqli_connect_error() . '"}');
            }
           
            $user = User::GetUserFromID($mysqli_link, 1);

            if ($user) {
                echo json_encode($user);
            } else {
                echo "{}";
            }
        ?>
    </body>
</html>
