<?php
ob_start();
include '../includes/security.php';
include '../includes/admin_header.php';

$errors=[];
$missing=[];
if (isset($_POST['send'])){
    $expected = ['email','contents'];
    $required = ['email','contents'];
    require '../includes/process_email.php';
}

?>
	<div class="container">
		<h1 >eMailing</h1>
    	<p>Notification service to members of Developers Network Connection</p>
    	<?php if ($_POST && $suspect) : ?>
    		<p class="warning">* Sorry, unable to send your message.</p>
    	<?php  elseif ($errors || $missing) : ?>
    		<p class="warning">Oops! Please correct the following item(s) indicated</p>
    	<?php endif; ?>
		<div class="row">
    		<div>
			<form method="post" action = "<?= $_SERVER['PHP_SELF']; ?>">
				<p>
					<label for="email">Email:
    					<?php if ($missing && in_array('email', $missing)) : ?>
    						<span class="warning"> * Please enter email address</span>
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
			<pre>
			</pre>
		</div>
	</div>

<?php 
    include '../includes/footer.php';
?>