<?php
    namespace core\util;
    
    include 'app_config.php';
    use mysqli;
                                    
    class DBUtil {
        public static function getDbConnection() {
            $db = DBConfig::getDBConfig();
            $conn = new mysqli($db->server, $db->user, $db->secret, $db->data);
            return $conn;
        }
    }
 ?>