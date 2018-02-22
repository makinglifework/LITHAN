<?php 
    if (isset($_GET)) {
        $firstname = $_GET['fname'];
        $lastname = $_GET['lname'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DNC::Registration Successful</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.3.3.7.min.css" />
        <link rel="stylesheet" href="../../assets/abc/abc.css" />
        <script src="../../assets/jquery/jquery.3.2.1.min.js"></script>
        <script src="../../assets/bootstrap/bootstrap.3.3.7.min.js"></script>
        <script src="../../assets/abc/abc.js"></script>
    </head>
    <body>
        <div id="top-bar">      
            <div class="container-fluid">
                <div class="row">
                    <a id="img_logo" href="../../index.php"><img alt="home" src="../../images/default/abc_logo_motto.png"></a>                
                </div>
            </div>            
        </div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="pagetitle-div">
                    <h2>Registration Successful!</h2>
                </div>
            </div>
            <div class="row">
                <div class="login-div">
                    <div id="msgbox" class="message-box-div">
                        <div class="pagemessage-div">        
                            <p>Activation of New User Account</p><hr/>
                        </div>
                        <div>    
                            <h5>
                                Dear <?= "$firstname $lastname"?>,
                            </h5>
                        </div>
                        <div>
                            <p>
                                We have send you an E-mail confirmation for your registration.
                            </p>       
                        </div>
                        <div class="col-xs-offset-0 col-xs-8">
                            <p>Please follow the instruction in the E-mail to activate your new account.</p>
                        </div>
                        <div class="">
                            <img src="../../images/default/send_email_s.png" />
                        </div>
                        <div>
                            <p>Welcome on board and may your journey to your dreams come true!</p>
                        </div>
                        <div>
                            <h3>The DNC Secretariat</h3>
                        </div>
                        <div>
                        	<form method="post" action="<?= $_SERVER['PHP_SELF']?>">
                            <input type='submit' id="btnNext" name="btnNext" value="Next" class="btn btn-primary button-size-1 pull-right"/>
                            </form>
                            
                        </div> 
                    </div>

                </div>
            </div>
        </div>
        
        <footer class="site-footer">
            <div class="container-fluid">
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
