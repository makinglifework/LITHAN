<?php
    namespace core\util;

    
    class DBConfig
    {
        public static $dbconfig;
        public $server;
        public $user;
        public $secret;
        public $data;
        
        public static function getDBConfig($reload = false){
            if(isset($dbconfig)==false || $reload==true){
                $ini =  parse_ini_file("../../conf/dbconfig.ini");
                $dbconfig = new DBConfig();
                $dbconfig->server = $ini['server'];
                $dbconfig->user = $ini['user'];
                $dbconfig->secret= $ini['password'];
                $dbconfig->data = $ini['db'];
                return $dbconfig;
            }
            return $dbconfig;
        }
    }
?>
