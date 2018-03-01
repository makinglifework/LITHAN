<?php
// namespace PHPMailer;
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

use core\acp\User;
use core\acp_bll\UserManager;

ob_start();
include '../includes/security.php';
include '../includes/admin_header.php';

require_once '../../core/acp/user.php';
require_once '../../core/acp_bll/UserManager.php';

$errors = [];
$missing = [];
$display_message = "";

// Retrieve email list from database
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $um = new UserManager();
    $lst = $um->getEmailList();
}


if (isset($_POST['send'])){
    $expected = ['email', 'subject', 'contents', 'SendEmail'];
    $required = ['email', 'subject', 'contents'];
    $display_message = "";
    $emailList = [];
    
    if (!isset($_POST['SendEmail'])) {
        $_POST['SendEmail'] = [];
    } else {
        if (isset($_POST['SendEmail'])) {
            $emailList = $_POST['SendEmail'];
        }
    }
        
    require '../includes/process_email.php';
    
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/SMTP.php';
    
    
    $mail = new PHPMailer(true);                              // Exception enabled
    
    try {
        // Configure email server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->SMTPKeepAlive;
        $mail->Username = 'lithantesters@gmail.com';          // SMTP username
        $mail->Password = '$lithanese@2020.';                 // SMTP password
        $mail->SMTPSecure = 'SSL';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $contents;
        $mail->AltBody = strip_tags(trim($contents));
        
        
        //Recipients
        $mail->setFrom('lithantesters@gmail.com', 'DNC Administrator');
        $mail->addReplyTo('lithantesters@gmail.com', 'DNC Administrator');
        foreach ($emailList as $email ) {           
            $mail->addAddress($email);                            // Add a recipient
 
            if (empty($subject) && empty($content)) {
                $display_message = 'Message could not be sent';
                break;
                
            } else {
                if ($mail->send()) {
                    $display_message = 'Message has been sent ';
                } else {
                    throw new Exception('Message could not be sent');
                }
            
                $mail->clearAddresses();  // Clear address for next loop
            }
        }
        
        
    } catch(Exception $e) {
        $display_message = 'Message could not be sent';
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    }   
    
} 

?>


	<div class="container">
		<h1 >eMailing</h1>
    	<p>Notification service to member of Developers Network Connection</p>
    	<p><span class="warning"><?php if (!empty($display_message)) : echo $display_message; endif ?></span></p>
		
		</div>	
	</div>



	<br/>
	<div class="container">
		<div class="row">
			<form method="post" action = "<?= $_SERVER['PHP_SELF']; ?>">
			
    			<div class = "table-responsive">
    			<table class = "table table-bordered table-striped">
    				<tr>
    					<th>First Name</th>
    					<th>Last Name</th>
    					<th>Email</th>
    					<th class="center">Select</th>
    				</tr> 
    				<?php 
    				$um = new UserManager();
    				$lst = $um->getEmailList();
    				if (isset($lst)) {
        				foreach ($lst as $member) {
        				    if ($member) {
            				    echo "<tr>";
            				    echo "<td>".$member->firstname."</td>";
            				    echo "<td>".$member->lastname."</td>";
            				    echo "<td>".$member->email."</td>";
            				    echo "<td class='center'><input type='checkbox' name='SendEmail[]' value = '".$member->email."'" ?>
            				    <?php if ($_POST && in_array($member->email, $SendEmail)) {echo 'checked';} ?>
            				    <?php
            				    echo "></td>";   				    
            				    echo "</tr>";
            				}
        				}
        				
        				echo "<tr>";
    				}
    
    				?>
    			</table>
				
			    <?php if ($_POST && $suspect) : ?>
    				<p class="warning">* Sorry, unable to send your message.</p>
    			<?php  elseif ($errors || $missing) : ?>
    				<p class="warning">Oops! Please correct the following item(s) indicated</p>
    			<?php endif; ?>
    			
		<!-- 	<p>
					<label for="email">Email:
    					<?php if ($missing && in_array('email', $missing)) : ?>
    						<span class="warning"> * Please enter email address</span>
    					<?php elseif (isset($errors['email'])) : ?>
    						<span class="warning">Invalid email address</span>
    					<?php endif; ?>
					</label><br>
					<input type="email" name="email" id="email" style="width: 20em;"
    					<?php 
        					if ($errors || $missing) {
        					    echo 'value = "'.htmlentities($email).'"';
    					}
					   ?>
					>
				</p>
	    -->	
				<p>
					<label for="subject">Subject:
    					<?php if ($missing && in_array('subject', $missing)) : ?>
    						<span class="warning"> * Please enter the message subject</span>
    					<?php endif; ?>
					</label><br>
					<input type="text" name="subject" id="subject" style="width: 20em;"
    					<?php 
        					if ($errors || $missing) {
        					    echo 'value = "'.htmlentities($subject).'"';
    					}
					   ?>
					>
				</p>
				<p>
					<label for="contents">Message:
    					<?php if ($missing && in_array('contents', $missing)) : ?>
    						<span class="warning">* You have not add any contents in your message</span>
    					<?php endif; ?>
					</label><br>
					<textarea name=contents id="contents"><?php if ($errors || $missing) {echo htmlentities($contents);}?></textarea>
				</p>
				<p>
					<input class="btn btn-primary " type="submit" name="send" id="send" value="Send Message">
				</p>
			</form>
		</div>
	</div>

<?php 
    include '../includes/footer.php';
?>