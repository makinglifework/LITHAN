<?php
    namespace core\acp;
    
    class User {
        public $id;
        public $email;
        public $firstname;
        public $lastname;
        public $role_id;
        public $secret;
        public $is_active;
    }
    
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
    
    class EmailList {
        public $firstname;
        public $lastname;
        public $email;
    }
    
?>