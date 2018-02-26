<?php
    namespace core\acp_dal;
    
    require_once '../../core/util/DBUtil.php';
    require_once '../../core/acp/user.php';
    
    use core\util\DBUtil;
    use core\acp\User;
use core\acp\UserProfile;
                                                
    class UserManagerDB {
        
        public static function fill($data) {
            $member = new User();
            $member->id = $data["user_id"];
            $member->firstname = $data["firstname"];
            $member->lastname = $data["lastname"];
            $member->role_id = $data["role_id"];
            $member->secret = $data["password"];
            $member->email = $data["email"];
            $member->is_active = $data["is_active"];
           
            return $member;
        }
        
        public static function fill_userprofile($data) {
            $member = new UserProfile();
            $member->id = $data["user_id"];
            $member->firstname = $data["firstname"];
            $member->lastname = $data["lastname"];
            $member->email = $data["email"];
            $member->password = $data["password"];
            $member->userjob = $data["user_job"];
            $member->useredu = $data["user_edu"];
            $member->institute = $data["institution"];
        //   $member->is_active = $data["is_active"];
            $member->bio = $data['bio'];
            $member->user_photo_path = $data['user_photo_path'];
            $member->notification = $data['notification'];
            return $member;
        }
        
        public static function validateUserLogin($email, $secret) {
            $conn = DBUtil::getDbConnection();
            $email = mysqli_escape_string($conn, $email);
            $secret = mysqli_escape_string($conn, $secret);
            $sql = "SELECT * FROM CP_TB_USER WHERE email = '$email' && password = '$secret'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                if ($row = $result->fetch_assoc()) {
                    $user = self::fill($row);
                }
                return  $user;
            }
            $conn->close();                       
        }
        
        public static function validateUserByEmail($email) {
            $conn = DBUtil::getDbConnection();
            $email = mysqli_escape_string($conn, $email);
            $sql = "SELECT * FROM CP_TB_USER WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            } 
            $conn->close();
        }
        
        public static function getUserProfileByUserId($id) {
            $conn = DBUtil::getDbConnection();
            $id = mysqli_escape_string($conn, $id);
            $sql = "SELECT user_id, firstname, lastname, email, password, user_job, user_edu, institution, user_photo_path, bio, notification FROM CP_TB_USER WHERE user_id=$id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $member = self::fill_userprofile($row);
                }
                return $member;
            }
            $conn->close();
        }
        
        public static function getUserProfileByEmail($email) {
            $conn = DBUtil::getDbConnection();
            $id = mysqli_escape_string($conn, $email);
            $sql = "SELECT user_id, firstname, lastname, email, password, user_job, user_edu, institution, user_photo_path, bio, notification FROM CP_TB_USER WHERE email='$email' && is_active=1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { 
                    $member = self::fill_userprofile($row);
                }
                return $member;
            }
            $conn->close();
        }
        
        public static function updateUserProfile(UserProfile $up) {
            $conn = DBUtil::getDbConnection();
            $sql = "call usp_update_userprofile(?,?,?,?,?,?,?,?,?,?,?)";
            $id = $up->id;
            $firstname = $up->firstname;
            $lastname = $up->lastname;
            $email = $up->email;
            $password = $up->password;
            $userjob = $up->userjob;
            $useredu = $up->useredu;
            $institue = $up->institute;
            $user_photo_path = $up->user_photo_path;
            $bio = $up->bio;
            $notification = $up->notification;
            $dbcmd = $conn->prepare($sql);
            $dbcmd->bind_param('isssssssssi', $id, $firstname, $lastname, $email, $password, $userjob, $useredu, $institue, $user_photo_path, $bio, $notification);
            $dbcmd->execute();
            if ($dbcmd->errno !=0) {
                printf("Error: %s. \n", $dbcmd->error);
            } else {
                return true;
            }
            $dbcmd->close();
            $conn->close();
        }
        
        public static function getMembersBySearch($fn, $ln, $eml) {
            
            if (!empty($fn) || !empty($ln) || !empty($eml)) {
                $where = "";
                $sql = "SELECT * FROM CP_TB_USER";
                if (!empty($fn)) {
                    if (strlen($where) == 0) {
                        $where = " WHERE";
                        $sql .= $where." firstname LIKE '%".$fn."%'";
                    }
                }
                
                if (!empty($ln)) {
                    if (strlen($where) == 0) {
                        $where = " WHERE";
                        $sql .= $where." lastname LIKE '%".$ln."%'";
                    } else {
                        $sql .= " && lastname LIKE '%".$ln."%'";
                    }
                }
                
                if (!empty($eml)) {
                    if (strlen($where) == 0) {
                        $where = " WHERE";
                        $sql .= $where." email LIKE '%".$eml."%'";
                    } else {
                        $sql .= " && email LIKE '%".$eml."%'";
                    }
                }
                
                $sql .= " && is_active = 1";                
                $conn = DBUtil::getDbConnection();
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $member = self::fill($row);
                        $members[] = $member;
                    }
                    return $members;
                }
                $conn->close();
            }
        }
        
        public static function deleteSelectedUser($list) {
            $conn = DBUtil::getDbConnection();
            $sql = "DELETE FROM CP_TB_USER WHERE user_id IN ($list)";
            if ($conn->query($sql) === TRUE) {
                return true;   
            } else {
                return false;
            }
        }

             
    }
?>