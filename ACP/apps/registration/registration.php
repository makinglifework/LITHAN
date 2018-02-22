<?php
    namespace apps\registration;    

    require_once '../../core/acp/registrant.php';
    require_once '../../core/acp_bll/RegistrationManager.php';
    
    use core\acp\Registrant;
    use core\acp_bll\RegistrationManager;
                    
    $display_message = $email = $firstname = $lastname = $secret = $confirm_secret ="";
    $e_email = $e_firstname = $e_lastname = $e_secret = $e_confirm_secret = "";
    
    
  if (isset($_POST)) { 
        
        if (isset($_POST['btnCancel'])) {
            header("Location: ../../index.php");
        } elseif (isset($_POST['submitted'])) {
            
            if (empty($_POST['txtEmail'])) {
                $e_email = " Email address is required.";
            } else {
                $email = strip_tags(trim($_POST['txtEmail']));
                if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    $e_email = "* Enter a valid Email";
                }
            }
            
            if (empty($_POST['txtFirstName'])) {
                $e_firstname = " First Name is required";
            } else {
                $firstname = strip_tags(trim($_POST['txtFirstName']));
                if (!preg_match('/^[a-zA-Z ]*$/', $firstname)) {
                    $e_firstname = " First Name must be alphabet";
                }
            }
            
            if (empty($_POST['txtLastName'])) {
                $e_lastname = " Last Name is required";
            } else {
                $lastname = strip_tags(trim($_POST['txtLastName']));
                if (!preg_match('/^[a-zA-Z ]*$/', $lastname)) {
                    $e_lastname = " Last Name must be alphabet";
                }
            }
            
            if (empty($_POST['txtPassword'])) {
                $e_secret = " Password is required";
            } else {
                $secret = strip_tags(trim($_POST['txtPassword']));
            }
            
            if (empty($_POST['txtConfirmPassword'])) {
                $e_confirm_secret = " Confirmation Password is required";
            } else {
                $confirm_secret = strip_tags(trim($_POST['txtConfirmPassword']));
            }
            
            if (!empty($secret) && !empty($confirm_secret)) {
                if ($secret !== $confirm_secret) {
                    $e_secret = " Password does not match!";
                }
            }
            
            if (   empty($e_email)
                && empty($e_firstname)
                && empty($e_lastname)
                && empty($e_secret)
                && empty($e_confirm_secret)) {
                    
                    $registrant = new Registrant();
                    
                    $registrant->setEmail($email);
                    $registrant->setFirstName($firstname);
                    $registrant->setLastName($lastname);
                    $registrant->setSecret($secret);
                    
                    $exist = RegistrationManager::isUserExist($email);
                    if ($exist) {
                        $display_message = "Oops! User already registered";
                    } else {
                        RegistrationManager::saveRegistrant($registrant);
                        header("Location: registration_thank_you.php?fname=$firstname&lname=$lastname");                       
                    }
                }               
        }
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/bootstrap/bootstrap.3.3.7.min.css" />
        <link rel="stylesheet" href="../assets/abc/abc.css" />
        <script src="../assets/jquery/jquery.3.2.1.min.js"></script>
        <script src="../assets/bootstrap/bootstrap.3.3.7.min.js"></script>
        <script src="../assets/abc/abc.js"></script>
        <style>         
        </style>
    </head>
    <body>
        <div id="top-bar">      
            <div class="container-fluid">
            	<div class="row">
          	   	    <a id="img_logo" href="../../index.php"><img alt="home" src="../images/default/abc_logo_motto.png"></a>     
        		</div>
            </div>            
        </div>

        <div class="container">
            <div class="row">
                <div class="register-div">
                    <form method="post" class="register-form" id="registration_form" name="registration_form" 
                        action="<?= $_SERVER['PHP_SELF'] ?>" onsubmit="return validateform();">  
                        <div>
                            <h1 class="text-center">Create New Account</h1>
                            <div id="lblNotice" class="text-center">
                                 <span class="notice">* All fields are required! </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="lblEmail" for="lblEmail">Email&nbsp;
                            	<span class="requiredfield" id="valEmail">* <?php if (!empty($e_email)) : echo $e_email; endif ?></span>
                            	<span class="requiredfield"><?php if (!empty($display_message)) : echo $display_message; endif ?></span>
                            </label>
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?= $email; ?>">
                        </div>
                        <div class="form-group">
                            <label id="lblFirstName" for="firstname">First Name&nbsp;
                            	<span class="requiredfield" id="valFirstName">* <?php if (!empty($e_firstname)) : echo $e_firstname; endif ?></span>
                            </label>
                            <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" value="<?= $firstname; ?>">
                        </div>
                        <div class="form-group">
                            <label id="lblLastName" for="lastname">Last Name&nbsp;
                            	<span class="requiredfield" id="valLastName">* <?php if (!empty($e_lastname)) : echo $e_lastname; endif ?></span>
                            </label>
                            <input type="text" class="form-control" id="txtLastName" name="txtLastName" value="<?= $lastname; ?>">
                        </div>
                        <div class="form-group">
                            <label id="lblPassword" for="password">Password&nbsp;
                            	<span class="requiredfield" id="valPassword">* <?php if (!empty($e_secret)) : echo $e_secret; endif ?></span>
                            </label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" value="<?= $secret;?>">
                        </div>
                        <div class="form-group">
                            <label id="lblConfirmPassword" for="confirmPassword">Confirm Password&nbsp;
                            	<span class="requiredfield" id="valConfirmPassword">* <?php if (!empty($e_confirm_secret)) : echo $e_confirm_secret; endif ?></span>
                            </label>
                            <input type="password" class="form-control" id="txtConfirmPassword" name="txtConfirmPassword" value="<?= $confirm_secret; ?>"/>
                        </div>
                        <div class="col-xs-5">
                        	<a href="../../index.php" class="btn btn-default button-size" id="btnCancel" name="btnCancel">Cancel</a>
                        </div>
                        <div class="col-xs-7">
                        	<input type="submit" class="btn btn-primary button-size pull-right" name="submitted" value="Register"/>	
                         </div>
                    </form> 
                </div>                  
            </div> 
        </div>
        <footer class="site-footer">
      	  <div class="container">
                <div class="row">                   
                    <div class="col-md-4 pull-left">Copyright &#169; <script>document.write(new Date().getFullYear())</script> - ABC Pte Ltd</div>
                    <div class="col-md-offset-0 col-md-4 pull-right">                          
                        <ul class="footer-list">
                            <li><strong>Technical Support:</strong></li>
                            <li>Tel: +65 6772 2777</li>
                            <li>Email: <a href="mailto:support@dnc.com">support@dnc.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>