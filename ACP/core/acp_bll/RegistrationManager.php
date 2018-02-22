<?php
    namespace core\acp_bll;
    
    require_once '../../core/acp_dal/RegistrationManagerDB.php';
    
    use core\acp\Registrant;
    use core\acp_dal\RegistrationManagerDB;
                                                
    class RegistrationManager {
        
        public static function isUserExist($email) {
            return RegistrationManagerDB::isUserExist($email);
        }
        
        public static function saveRegistrant(Registrant $registrant) { 
            return RegistrationManagerDB::saveRegistrant($registrant);
        }
    }
?>