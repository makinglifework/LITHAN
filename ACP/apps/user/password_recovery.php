<?php 
    include '../../core/acp_bll/UserManager.php';

    use core\acp_bll\UserManager;

    $email = $display_message = $e_email = "";
    
    if (isset($_POST['submit'])) {      
        if (empty($_POST['email'])) {
            $e_email = " * Email address is required.";
        } else {
            $email = strip_tags(trim($_POST['email']));
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $e_email = "* Enter a valid Email";
            }
        }
        
        if (empty($e_email)) {           
            try {
                $usr_mgr = new UserManager();
                $validate_user = $usr_mgr->validateUserByEmail($email);
                if ($validate_user) {
                    header("Location: password_recovery_confirmation.php?e=$email");
                } 
            } catch (Exception $e) {
                $display_message = "Oops! ".$e->getMessage();
            }
        }
        
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>DNC::Password Recovery</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/bootstrap/bootstrap.3.3.7.min.css" />
        <link rel="stylesheet" href="../assets/abc/abc.css" />
        <script src="../assets/jquery/jquery.3.2.1.min.js"></script>
        <script src="../assets/bootstrap/bootstrap.3.3.7.min.js"></script>
        <script src="../assets/abc/abc.js"></script>
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
                    <h2>Password Recovery</h2>
                </div>
            </div>
            <div class="row">
                <div class="login-div">
                    <div id="prbox" class="message-box-div">
                    <div class="pagemessage-div">        
                        <p>Forgotten Password?</p><hr/>
                    </div>
                        <div>
                            <div>
                                <p>                                   
                                    It's okay, just type the email you used for registering below. 
                                    We will send an E-mail with instruction to reset.
                                </p>
                            </div>
                            <form class="col-xs-12" method = "post" action = "<?= $_SERVER['PHP_SELF'] ?>"
                            	id="passwordrecovery_form" name="passwordrecovery_form">
                                <div class="form-group">        
                                    <label for="lblEmail">Email</label>
                                    <span class="requiredfield"><?php if (!empty($e_email)) : echo $e_email; endif ?></span>
                                    <input type="email" class="form-control" id="email" name="email" value="<?=  $email ?>"> 
                                    <span class="requiredfield"><?php if (!empty($display_message)) : echo $display_message; endif ?></span>       
                                </div>
                                <div class="col-xs-6 pull-right">
                                    <input class="btn btn-primary button-size-1" type="submit" id="btnSubmit" name="submit"  value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
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
