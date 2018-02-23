<?php
ob_start();
include '../includes/security.php';
include '../includes/admin_header.php';

?>
	<div class="container">
		<h1>eMailing</h1>
		<p>Emailing notification services to members of Developers Network Connection</p>
		<div class="row">
			<form method="post" action="">
				<p>
					<label for="email">Email:</label>
					<input type="email" name="email" id="email">
				</p>
				<p>
					<label for="contents">Message</label>
					<textarea name=contents id="contents"></textarea>
				</p>
				<p>
					<input type="submit" name="send" id="send" value="Send Email">
				</p>
			</form>
			<pre>
			</pre>
		</div>
	</div>

<?php 
    include '../includes/footer.php';
?>