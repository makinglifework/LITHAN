<?php
    namespace core\acp_bll;
    
    require_once '../../core/acp_dal/UserManagerDB.php';

    use core\acp_dal\UserManagerDB;
    use Exception;
use core\acp\UserProfile;
                                
    class UserManager {
        
        public function validateUserByEmail($email) {
            $isUserExist = (UserManagerDB::validateUserByEmail($email));
            if ($isUserExist) {
                return true;
            } else {
                throw new Exception("User is not registered.");
            }
        }
        
        public function validateUserLogin($email, $secret) {
            return UserManagerDB::validateUserLogin($email, $secret);
        }
        
        public function getUserProfileByUserId($id) {
            return UserManagerDB::getUserProfileByUserId($id);
        }
        
        public function getUserProfileByEmail($email) {
            return UserManagerDB::getUserProfileByEmail($email);
        }
        
        
        public function updateUserProfile(UserProfile $up ) {
            return UserManagerDB::updateUserProfile($up);
        }
        
        public function getMembersBySearch($fn, $ln, $eml) {
            return UserManagerDB::getMembersBySearch($fn, $ln, $eml);
        }
        
        public function deleteSelectedUser($list) {
            return UserManagerDB::deleteSelectedUser($list);
        }
        
        public function getEmailList() {
            return UserManagerDB::getEmailList();
        }
        
        
    }    // Class User Manager
?>