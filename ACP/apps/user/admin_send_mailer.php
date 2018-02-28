<?php
// namespace PHPMailer;
use PHPMailer\PHPMailer;
use PHPMailer\Exception;


ob_start();
include '../includes/security.php';
include '../includes/admin_header.php';


$errors = [];
$missing = [];


if (isset($_POST['send'])){
    $expected = ['email', 'subject', 'contents'];
    $required = ['email', 'subject', 'contents'];
    
    require '../includes/process_email.php';
    
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/SMTP.php';
    
    
    $mail = new PHPMailer(true);                              // Exception enabled
    
    try {
        // Configure email server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'lithantesters@gmail.com';                 // SMTP username
        $mail->Password = '$lithanese@2020.';                           // SMTP password
        $mail->SMTPSecure = 'SSL';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        
        //Recipients
        $mail->setFrom('lithantesters@gmail.com', 'DNC Administrator');
        $mail->addAddress($email);     // Add a recipient
        $mail->addReplyTo('lithantesters@gmail.com', 'DNC Administrator');

        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $contents;
        $mail->AltBody = 'You are invited to the Developer Network Technet 2018! A special event where all software programmers and developers will gathered once a year';
        
        $status = $mail->send();
        echo 'Message has been sent';
        
    } catch(Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    
} 

?>
	<div class="container">
		<h1 >eMailing</h1>
    	<p>Notification service to member of Developers Network Connection</p>
		<div class="row">
    		<div>
			<form method="post" action = "<?= $_SERVER['PHP_SELF']; ?>">
			    <?php if ($_POST && $suspect) : ?>
    				<p class="warning">* Sorry, unable to send your message.</p>
    			<?php  elseif ($errors || $missing) : ?>
    				<p class="warning">Oops! Please correct the following item(s) indicated</p>
    			<?php endif; ?>
				<p>
					<label for="email">Email:
    					<?php if ($missing && in_array('email', $missing)) : ?>
    						<span class="warning"> * Please enter email address</span>
    					<?php elseif (isset($errors['email'])) : ?>
    						<span class="warning">Invalid email address</span>
    					<?php endif; ?>
					</label>
					<input type="email" name="email" id="email"
    					<?php 
        					if ($errors || $missing) {
        					    echo 'value = "'.htmlentities($email).'"';
    					}
					   ?>
					>
				</p>
				<p>
					<label for="subject">Subject:
    					<?php if ($missing && in_array('subject', $missing)) : ?>
    						<span class="warning"> * Please enter the message subject</span>
    					<?php endif; ?>
					</label>
					<input type="text" name="subject" id="subject"
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
					</label>
					<textarea name=contents id="contents"><?php 
    					if ($errors || $missing) {
    					    echo htmlentities($contents);
    					}
    					?>
					</textarea>
				</p>
				<p>
					<input class="btn btn-primary " type="submit" name="send" id="send" value="Send Message">
				</p>
			</form>
			</div>
		</div>
	</div>

<?php 
    include '../includes/footer.php';
?>