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
};



