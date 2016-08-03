<?php

/* User class */

class User {
    private $id = 0;
    private $passhash = "";
    
    public $username = "";
    public $sex = '';
    public $birthdate = 0;
    public $formalname = "";
    public $type;
    
    public $city;
    public $biography;
    
    private $isFromDatabase = false;
            
    function __construct($id, $username, $passhash) {
        $this->id = $id;
        $this->username = $username;
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
    
    /* Adds the user to the database, or update it if it's added 
        
     *  @returns True on success, false on error
     */
    public function SaveToDatabase($mysqli_link) {    
        if ($this->isFromDatabase === true) {
            $query_str = "UPDATE users SET usersex=" . $this->sex . ", ";
            $query_str .= "userformalname='" . $this->formalname . "', ";
            $query_str .= "userbirthdate='" . $this->birthdate . "', ";
            $query_str .= "usertype=" . $this->type . ", ";
            $query_str .= "usercountry=0, ";
            $query_str .= "usercity='" . $this->city . "', ";
            $query_str .= "userautobio='" . $this->biography . "' ";
            $query_str .= "WHERE userid=" . $this->id;            
        } else {
            $query_str = "INSERT INTO users (username, usersex, userpassword, userformalname, ";
            $query_str .= "userbirthdate, usertype, usercountry, usercity, userautobio";
            $query_str .= "VALUES ('$this->username',$this->sex,'$this->passhash','$this->formalname', ";
            $query_str .= "'$this->birthdate',$this->type',0,'$this->city','$this->biography')";            
        }
        
        $result = mysqli_query($mysqli_link, $query_str);

        if (!$result){
            return false;
        }
        
        $last_id = mysql_insert_id($mysqli_link);
        if (!$this->isFromDatabase) {
            /* Update id */
            $this->id = $last_id;
        }
        return true;
    }
        
    /*** Static functions ***/
    
    
    /* Get an user from database given its ID, or null if it isn't found */
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
            return null;
        }
    
        $showUser = new User($ret_user['userid'], 
            $ret_user['username'], $ret_user['userpassword']);
        $showUser->sex = $ret_user['usersex'];
        $showUser->formalname = $ret_user['userformalname'];
        $showUser->birthdate = $ret_user['userbirthdate'];
        $showUser->city = $ret_user['usercity'];
        $showUser->biography = $ret_user['userautobio'];
        $showUser->isFromDatabase = true;
         mysqli_free_result($result); 
        return $showUser;
    }
    
    
    
}



