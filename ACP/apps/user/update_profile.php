<?php
ob_start();
include '../includes/security.php';
include '../includes/header.php';

require_once '../../core/acp/user.php';
require_once '../../core/acp_bll/UserManager.php';

use core\acp_bll\UserManager;
use core\acp\User;
use core\acp\UserProfile;


$id = $fn = $ln = $eml = $bio = $user_photo_path = $notification = $display_message = "";
    $secret = $confirm_secret = $e_secret = $e_confirm_secret = "";
    $userjob = $e_userjob = $useredu = $e_useredu = $institute = $e_institute = "";
    $e_fn = $e_ln = $e_eml = $e_bio = $e_file = "";
    
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $email = $_SESSION['email'];
            $um = new UserManager();
            $up = $um->getUserProfileByEmail($email);
            $id = $up->id;
            $fn = $up->firstname;
            $ln = $up->lastname;
            $eml = $up->email;
            $secret = $up->password;
            $userjob = $up->userjob;
            $useredu = $up->useredu;
            $institute = $up->institute;
            $user_photo_path = $up->user_photo_path;
            $bio = $up->bio;
            $notification = $up->notification;
    }
    
    if (isset($_POST['update'])) {
        
        $id = $_POST['ID'];
        
        if (empty($_POST['firstname'])) {
            $e_fn = "* First Name is required";
        } else {
            $fn = strip_tags(trim($_POST['firstname']));
            if (!preg_match('/^[a-zA-Z ]*$/', $fn)) {
                $e_fn = "* First Name must be alphabet";
            }                  
        }
        
        if (empty($_POST['lastname'])) {
            $e_ln = "* Last Name is required";
        } else {
            $ln = strip_tags(trim($_POST['lastname']));
            if (!preg_match('/^[a-zA-Z ]*$/', $ln)) {
                $e_ln = "* Last Name must be alphabet";
            }
        }
        
        if (empty($_POST['email'])) {
            $e_eml = "* Email is required";
        } else {
            $eml = strip_tags(trim($_POST['email']));
            if (filter_var($eml, FILTER_VALIDATE_EMAIL) === false) {
                $e_eml = "* Enter a valid Email";
            }
        }
        
        if (empty($_POST['password'])) {
            $e_secret = " Password is required";
        } else {
            $secret = strip_tags(trim($_POST['password']));
        }
        
        if (empty($_POST['confirmPassword'])) {
            $e_confirm_secret = " Confirmation Password is required";
        } else {
            $confirm_secret = strip_tags(trim($_POST['confirmPassword']));
        }
        
        if (!empty($secret) && !empty($confirm_secret)) {
            if ($secret !== $confirm_secret) {
                $e_secret = "* Password does not match!";
            }
        }
        
        if (!empty($_POST['userjob'])) {
            $userjob = strip_tags(trim($_POST['userjob']));
            if (!preg_match('/^[a-zA-Z ]*$/', $userjob)) {
                $e_userjob = "* User Job must be alphabet";
            }
        }
        
        if (!empty($_POST['useredu'])) {
            $useredu = strip_tags(trim($_POST['useredu']));
            if (!preg_match('/^[a-zA-Z ]*$/', $useredu)) {
                $e_useredu = "* Education must be alphabet";
            }
        }
        
        if (!empty($_POST['institution'])) {
            $institute = strip_tags(trim($_POST['institution']));
            if (!preg_match('/^[a-zA-Z, ]*$/', $institute)) {
                $e_institute = "* Institution must be alphabet";
            }
        }
        
        if (!empty($_POST['bio'])) {
            $bio = strip_tags($_POST['bio']);
        }
        
        if (isset($_FILES['user_photo'])) {
            $file = $_FILES['user_photo'];                
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            
            if (!empty($file_name)) {
                $allowed = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
                $image_dir = "../images/members/";
                
                $file_ext = explode('.', $file_name);
                $file_ext = strtolower(end($file_ext));
                
                if (in_array($file_ext, $allowed)) {
                    if ($file_size <= 20480000 ) {
                        $file_destination = $image_dir.basename($file_name);
                        if (file_exists($file_destination)) {
                            if (unlink($file_destination)) {
                                if (move_uploaded_file($file_tmp, $file_destination)) {
                                    $user_photo_path = $file_destination;
                                }
                            }
                        } else {
                            move_uploaded_file($file_tmp, $file_destination);
                            $user_photo_path = $file_destination;
                        }
                    } else {
                        $e_file = "* $file_name size must be within 30Kb to 2MB.";
                    }
                } else {
                    $e_file = "* Invalid image format!";
                }
            }
            
            if ($_POST['notification'] == 1) {
                $notification = 1;
            } else {
                $notification = 0;
            }
            
            
        }
        
        if (empty($e_fn) && empty($e_ln) && empty($e_eml) && empty($e_bio) && empty($e_file) && 
            empty($e_secret) && empty($e_confirm_secret) && empty($e_userjob) && empty($e_useredu) && 
            empty($e_institute)) {
                             
            $up = new UserProfile();
            $up->id = $id;
            $up->firstname = $fn;
            $up->lastname = $ln;
            $up->email = $eml;
            $up->password = $secret;
            $up->userjob = $userjob;
            $up->useredu = $useredu;
            $up->institute = $institute;
            $up->bio = $bio;
            $up->user_photo_path = $user_photo_path;
            $up->notification = $notification;
            $um = new UserManager();
            try {
                $result = $um->updateUserProfile($up);
                if ($result) {
                    header("Location: view_profile.php?id=$id");
                } else {
                    throw new Exception('Oops! failed to update your profile');                       
                }
            } catch (Exception $e) {
                $display_message = $e->getMessage();
            }
        }
    }
        
?>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3">		<br><br><br>
            	<form method="post" action="<?= $_SERVER["PHP_SELF"]?>" enctype="multipart/form-data">
            		<fieldset>
            			<legend>:: Update Profile ::</legend> 
            			<span class = "requiredfield"><?php if (!empty($display_messsage)) : echo $display_message; endif ?></span>
                        <input  type="hidden" class="form-control" id="ID" name="ID" value="<?= $id; ?>">
                               
            			<div class="form-group">
                        	<label id="lblFirstName" for="firstname">First Name: &nbsp;</label>
                        	<span class="requiredfield"><?php if(!empty($e_fn)) : echo $e_fn; endif ?></span>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $fn; ?>">
                        </div>
            			<div class="form-group">
                      		<label id="lblLastName" for="lastname">Last Name: &nbsp;</label>
                      		<span class="requiredfield"><?php if(!empty($e_ln)) : echo $e_ln; endif ?></span>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $ln; ?>">
                        </div>
                        
                        <div class="form-group">
                        	<label id="lblEmail" for="email">Email: &nbsp;</label>
                        	<span class="requiredfield"><?php if (!empty($e_eml)) : echo $eml; endif ?></span>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $eml; ?>">
                        </div>
                        <div class="form-group">
                            <label id="lblPassword" for="password">Password:&nbsp;</label>
                            <span class="requiredfield">* <?php if (!empty($e_secret)) : echo $e_secret; endif ?></span>             
                            <input type="password" class="form-control" id="password" name="password" value="<?= $secret;?>">
                        </div>
                        <div class="form-group">
                            <label id="lblConfirmPassword" for="confirmPassword">Confirm Password:&nbsp;</label>
                            	<span class="requiredfield">* <?php if (!empty($e_confirm_secret)) : echo $e_confirm_secret; endif ?></span>

                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?= $confirm_secret; ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label id="lblUserJob" for="userjob">Job: &nbsp;</label>
                            <span class="requiredfield"><?php if (!empty($e_userjob)) : echo $e_userjob; endif ?></span>             
                            <input type="text" class="form-control" id="userjob" name="userjob" value="<?= $userjob;?>">
                        </div>
                        
                        <div class="form-group">
                            <label id="lblUserEdu" for="userjob">Education: &nbsp;</label>
                            <span class="requiredfield"><?php if (!empty($e_useredu)) : echo $e_useredu; endif ?></span>             
                            <input type="text" class="form-control" id="useredu" name="useredu" value="<?= $useredu;?>">
                        </div>
                        
                       <div class="form-group">
                            <label id="lblInstitue" for="Institution">Institution: &nbsp;</label>
                            <span class="requiredfield"><?php if (!empty($e_institute)) : echo $e_institute; endif ?></span>             
                            <input type="text" class="form-control" id="institution" name="institution" value="<?= $institute;?>">
                        </div>
                        
                        <div class="form-group">
                        	<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                        	<label id="lblPhoto" for="user_photo">Upload Photo: &nbsp;</label>
                        	<span class="requiredfield"><?php if (!empty($e_file)) : echo $e_file; endif ?></span>
                            <input type="file" class="" id="user_photo" name="user_photo" >
                        </div>   
                        
                        <div class="form-group">
                        	<label id="lblBio" for="bio">Bio: &nbsp;</label><br>
                            <textarea  class="form-control" cols="80" rows="10" id="bio" name="bio" ><?= $bio; ?></textarea>
                        </div>
                        
                        <div class="form-group">                      
                            <input type="checkbox" id="notification" name="notification" value = "1" <?php if ($notification == '1') {echo 'checked';} ?>> Email Notification
                        </div>
        
            			<input class="btn btn-primary" type = "submit" name="update" value="Update"> 
            		</fieldset>
            	</form>
        	</div>
        </div>
	</div>
	
<?php 
    include '../includes/footer.php';
?>