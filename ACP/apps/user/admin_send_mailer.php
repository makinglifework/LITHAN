<?php
ob_start();
include '../includes/security.php';
include '../includes/admin_header.php';

$errors=[];
$missing=[];
if (isset($_POST['send'])){
    $expected=['email','contents'];
    $Required=['name','comments'];
    require './includes/process_email.php';
}

?>
	<div class="container">
		<div class="row">
			<h1>eMailing</h1>
    		<p>Notification service to members of Developers Network Connection</p>
    		<hr>
    		<?php if ($errors || $missing) : ?>
    			<p class="warning">Oops! Please correct the item(s) indicated</p>
    		<?php endif; ?>
			<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label for="email">Email:</label>
					<?php if ($missing && in_array('email', $missing)) : ?>
						<span class="warning">Please enter email address</span>
					<?php endif; ?>
					<input type="email" name="email" id="email">
				</div>
				<div class="form-group">
					<label for="contents">Message:</label>
					<?php if ($missing && in_array('contents', $missing)) : ?>
						<span class="warning">You have not add any contents in your message</span>
					<?php endif; ?>
					<textarea name=contents id="contents"></textarea>
				</div>
				<p>
					<input class ="btn btn-primary " type="submit" name="send" id="send" value="Send Message">
				</p>
			</form>
			<pre>
			</pre>
		</div>
	</div>

<?php 
    include '../includes/footer.php';
?>