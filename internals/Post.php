<?php

/* Post class
 * 
 * Each post can contain a lot of data, such as:
 *  Common messages
 *  Images
 *  Audio
 *  Video
 * 
 *  */

require_once 'User.php';

class Post {
    
    private $id = 0;
    private $userID = 0;
    private $post_date;
    
    /* The post type.
     * Valid types are: POST_TEXT, POST_IMAGE, POST_AUDIO and POST_VIDEO 
     */
    private $post_type;
    
    /* The 'User' object that owns this post */
    public $owner = null;
    
    public $message;
    public $content;
    
    private $isFromDatabase = false;
            
    function __construct($id, $owner) {
        $this->id = $id;
        $this->$owner = $owner;
        $this->userID = $owner->GetID();
    }
    
    function GetID() { return $this->id; }
    function GetPostDate() { return $this->post_date; }
        
    /* Adds the post to the database, or update it if it's added 
        
     *  @returns True on success, false on error
     */
    public function SaveToDatabase($mysqli_link) {  
        if (!$this->isFromDatabase) {
            /* If isn't from database, update post date */
            $this->post_date = date("Y-m-d H:i:s");
        }
        
        return false;
    }  
    
     /* Get a post from database given its ID */
    public static function GetPostFromID($mysqli_link, $id) {
        return null;
    }
    
    /* Get an array of the last $count posts from some user, from $start.
     * If $count = -1, return all posts (You might not want this) 
     */
    public static function GetPostsFromUser($mysqli_link, $users, $start, $count) {
        return null;
    }
    
}