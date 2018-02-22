<?php 
    if (isset($_GET)) {
        $firstname = $_GET['fname'];
        $lastname = $_GET['lname'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DNC::Thank You</title>
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
            <div class="container">
                <div class="row">
                    <a id="img_logo" href="../../index.php"><img alt="home" src="../images/default/abc_logo_motto.png"></a>                
                </div>
            </div>            
        </div>       
        <div class="container">
            <div class="row">
                <div class="pagetitle-div">
                    <h1>Welcome on Board</h1>
                </div>
            </div>
            <div class="row">
                <div class="login-div">
                    <div id="msgbox" class="message-box-div">
                        <div class="pagemessage-div">        
                            <p>Getting to know you better</p><hr/>
                        </div>
                        <div>    
                            <h3>
                                <?= "Dear $firstname $lastname" ?>,
                            </h3>
                        </div>
                        <div>
                            <p>
                                We will like you to update your profile in order to help nurture and grow your network.
                            </p>       
                            <p>
                                Your latest profile can help other users and key decision makers reach you directly. 
                                Likewise, you can search and collaborate with others in the portal. 
                            </p>
                            <p>
                                <i><?= $firstname." ".$lastname ?></i> thanks for making DNC great! Let your journey begins now.
                            </p>
                        </div>
                        <div>
                            <h3>
                                DNC Team
                            </h3>
                        </div>
                        <div>
                            <a href="../user/sign_in.php" id="btnNext" class="btn btn-default button-size-1 pull-right">Next</a>
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
