<?php

/* User class */

class User {
    private $id = 0;
    private $passhash = "";
    
    public $username = "";
    public $sex = '';
    public $birthdate = 0;
    public $formalname = "";
    
    public $city;
    public $biography;
    
    function __construct($id, $username, $passhash) {
        $this->id = $id;
        $this->$username = $username;
        $this->passhash = $passhash;
        
    }
    /* Returns the user ID */
    public function GetID() { return $this->id; }
 
    /* Gets or sets the logged user */
    private static $LoggedUser = null;
    
    public static function GetLoggedUser() {
        return self::$LoggedUser;
    }
    
    public static function SetLoggedUser($user) {
        /* Validate the user before setting its ID */
        if ($user->GetID() == $_SESSION['id']) {
            self::$LoggedUser = $user;
        }
    }
    
    /* Get an user from database given its ID */
    public static function GetUserFromID($mysqli_link, $id) {
        $query_str = "SELECT * ";
        $query_str .= "FROM `users`";
        $query_str .= " WHERE userid = '" . $id . "';";

        $result = mysqli_query($mysqli_link, $query_str);

        if (!$result){
            return null;
        }

        /* Retrieve logged user information */
        $ret_user = mysqli_fetch_assoc($result);

        if (!$ret_user){
            header("Location: index.php?reason=n00bhacker");
        }
    
        $showUser = new User($ret_user['userid'], 
            $ret_user['username'], $ret_user['userpassword']);
        $showUser->sex = $ret_user['usersex'];
        $showUser->formalname = $ret_user['userformalname'];
        $showUser->birthdate = $ret_user['userbirthdate'];
        $showUser->city = $ret_user['usercity'];
        $showUser->biography = $ret_user['userautobio'];
         mysqli_free_result($result); 
        return $showUser;
    }
    
};



