<?php
/*
 * Provides the Registrant class properties
 */

    namespace core\acp;
    
    /*
     * Provides details of new registrant properties
     */
    class Registrant {
        
        private $_email;
        private $_firstname;
        private $_lastname;
        private $_secret;
        
        /*
         * @return string Get Email address of the registrant
         */
        public function getEmail() {
            return $this->_email;
        }
        
        /*
         * @return string Set Email address of the registrant
         */
        public function setEmail($value) {
            $this->_email = $value;
        }
        
        /*
         * @return string Get First Name of the registrant
         */
        public function getFirstName() {
            return $this->_firstname;
        }
        
        /*
         * @return string Set First Name of the registrant
         */
        public function setFirstName($value) {
            $this->_firstname = $value;
        }
        
        /*
         * @return string Get Last Name of the registrant
         */
        public function getLastName() {
            return $this->_lastname;
        }
        
        /*
         * @return string Set Last Name of the registrant
         */
        public function setLastName($value) {
            $this->_lastname = $value;
        }
        
        /*
         * @return string Get password of the registrant
         */     
        public function getSecret() {
            return $this->_secret;
        }
        
        /*
         * @return string Set password of the registrant
         */
        public function setSecret($value) {
            $this->_secret = $value;
        }
        
    }    
?>