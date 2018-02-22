<?php
    namespace core\acp_dal;
    
    require_once '../../core/util/DBUtil.php';
    
    use core\util\DBUtil;
    use core\acp\Registrant;
                                                   
    class RegistrationManagerDB {
        public static function isUserExist($email) {
            $conn = DBUtil::getDbConnection();
            $email = mysqli_real_escape_string($conn, $email);
            $sql="SELECT * FROM CP_TB_USER WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
            $conn->close();
        }
        
        public static function saveRegistrant(Registrant $registrant) {
            $conn = DBUtil::getDbConnection();
            $sql = "call usp_user_save(?,?,?,?)";
            $email = $registrant->getEmail();
            $firstname = $registrant->getFirstName();
            $lastname = $registrant->getLastName();
            $secret = $registrant->getSecret();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $email, $firstname, $lastname, $secret);
            $stmt->execute();
            if ($stmt->errno !=0) {
                printf("Error: %s. \n", $stmt->error);
            }
            $stmt->close();
            $conn->close();
        }
    }
   
    
  ?>