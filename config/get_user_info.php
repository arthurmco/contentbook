<?php

/* Retrieve user information.
 * 
 * Variables:
 * ID: Searches by ID
 * name: Searches by name
 *  */

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

include("../include/database.php");
include("../internals/User.php"); 

$mysqli_link = @mysqli_connect(db_host, db_user, db_pass, db_name);
            
if (!$mysqli_link) {
    die('{"error":' . mysqli_connect_errno() . 
        ',"string":"' . mysqli_connect_error() . '"}');
}

if ($id) {
    $user = User::GetUserFromID($mysqli_link, $id);
} else if ($name) {
    $user = User::GetUsersFromFormalName($mysqli_link, $name);
} else {
    die('{"error":"E_INVALID_PARAMETER"' . 
        ',"string":"Invalid parameter"}');
}
if ($user) {
    echo json_encode($user);
} else {
    echo "{}";
}
