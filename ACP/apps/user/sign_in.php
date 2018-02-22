<?php 
    namespace apps\user;
    
    require_once '../../core/acp_bll/UserManager.php';
    
    use core\acp_bll\UserManager;

    $email = $secret = $display_message ="";
    $e_email = $e_secret ="";
    
    if (isset($_POST['submit'])) {
        
        if (!empty($_POST['email'])) {
            $email = strip_tags(trim($_POST['email']));
        } else {
            $e_email = " * Please enter a valid email";
        }
        
        if (!empty($_POST['password'])) {
            $secret = strip_tags(trim($_POST['password']));
        } else {
            $e_secret = "* Please enter a password";
        }
        
        if (empty($e_email) && (empty($e_secret))) {
            $um = new UserManager();
            $userLogin = $um->validateUserLogin($email, $secret);
            if (isset($userLogin)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['role_id'] = $userLogin->role_id;
                if ($_SESSION['role_id'] === 'admin') {
                    header("Location: admin_home.php");
                } else {
                    header("Location: member_home.php");
                }
            } else {
                $display_message = "* Login failed !";
            }
            
        }
      
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DNC::Sign Me In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/bootstrap/bootstrap.3.3.7.min.css" />
        <link rel="stylesheet" href="../assets/abc/abc.css" />
        <script src="../assets/jquery/jquery.3.2.1.min.js"></script>
        <script src="../assets/bootstrap/bootstrap.3.3.7.min.js"></script>
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
                <div class="pagetitle-div">
                    <h2>Member's Login</h2>
                </div>
            </div>
            <div class="row">
                <div class="login-div">             	
                    <form method="post" action="<?= $_SERVER['PHP_SELF']?>" id="signin_form" name="signin_form" class="login-form" >
                        <div class="form-group"> 
                        	<span class="requiredfield"><?= $display_message; ?></span><br>       
                            <label for="lblEmail">Email&nbsp;</label>
                            <span class="requiredfield"><?php if (!empty($e_email)) : echo $e_email; endif ?></span>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">        
                        </div>
                        <div class="form-group">
                            <label for="lblPassword">Password&nbsp;</label>
                            <span class="requiredfield"><?php if (!empty($e_secret)) : echo $e_secret; endif ?></span>
                            <input type="password" class="form-control" id="Password" name="password" value="<?= $secret; ?>">
                        </div>
                        <div class="col-xs-5">
                            <a href="password_recovery.php" id="forgetpassword" class="linktext">Forget Password?</a>
                        </div>
                        <div class="col-xs-7">
                            <input type="submit" id="btn_signin" name="submit" class="btn btn-primary button-size" value="Sign In">
                        </div>
                        <br><hr>
                        <div class="text-center">
                            <a href="../registration/registration.php" class="btn btn-default button-size" role="button">Sign Up</a>
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
