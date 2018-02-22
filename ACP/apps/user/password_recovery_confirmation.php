<?php 
    if (isset($_GET)) {
        $email = $_GET['e'];
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
                    <a id="img_logo" href="index.php"><img alt="home" src="../images/default/abc_logo_motto.png"></a>                
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
                    <div id="msgbox" class="message-box-div">
                        <div class="pagemessage-div">        
                            <p>Password Recovery Reset</p><hr/>
                        </div>
                        <div>    
                            <p style="margin-bottom: 50px;">
                               We have sent the reset password instruction to 
                               <span class="requiredfield"><?= $email ?></span>. 
                               If you still cannot sign in, please contact our support team.
                               </p>
                        </div>
                        <div>
                            <p>
                                Thank you and have a nice day...!
                            </p>       
                        </div>
                        <div>
                            <h4>
                                Support Team
                            </h4>
                        </div>
                        <div>
                            <a href="sign_in.php" id="btnOK" class="btn btn-primary button-size-1 pull-right">OK</a>
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
