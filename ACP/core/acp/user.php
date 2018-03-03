<?php
/*
 *Provides details of User class properties, User Profile class properties and Email list properties
 */
 
    namespace core\acp;
    
    /*
     * @return object User properties
     */
    class User {
        public $id;
        public $email;
        public $firstname;
        public $lastname;
        public $role_id;
        public $secret;
        public $is_active;
    }
    
    /*
     * @teturn object User Profile properties
     */
    class UserProfile {
        public $id;
        public $email;
        public $firstname;
        public $lastname;
        public $userjob;
        public $useredu;
        public $institute;
        public $password;
        public $bio;
        public $user_photo_path;
        public $notification;
    }
    
    
    /*
     * @teturn object Email list of users subscribed for email notification
     */
    class EmailList {
        public $firstname;
        public $lastname;
        public $email;
    }
    
?>