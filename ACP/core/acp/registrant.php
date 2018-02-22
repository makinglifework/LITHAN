<?php
    namespace core\acp;
    
    class Registrant {
        
        private $_email;
        private $_firstname;
        private $_lastname;
        private $_secret;
                   
        public function getEmail() {
            return $this->_email;
        }
        
        public function setEmail($value) {
            $this->_email = $value;
        }
        
        public function getFirstName() {
            return $this->_firstname;
        }
        
        public function setFirstName($value) {
            $this->_firstname = $value;
        }
        
        public function getLastName() {
            return $this->_lastname;
        }
        
        public function setLastName($value) {
            $this->_lastname = $value;
        }
        
        public function getSecret() {
            return $this->_secret;
        }
        
        public function setSecret($value) {
            $this->_secret = $value;
        }
        
    }    
?>