<?php 
    namespace apps\user;
                   
    include '../includes/security.php';
    include '../includes/header.php';
    
    require_once '../../core/acp/user.php';
    require_once '../../core/acp_bll/UserManager.php';
    
    use core\acp_bll\UserManager;
    
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        $email = $_SESSION['email'];
        $um = new UserManager();
        $up = $um->getUserProfileByEmail($email);
        $id = $up->id;
        $fn = $up->firstname;
        $ln = $up->lastname;
        $eml = $up->email;
        $userjob = $up->userjob;
        $useredu = $up->useredu;
        $institute = $up->institute;
        $user_photo_path = $up->user_photo_path;
    }
    
?>
    <div class="container">
        <div class="row">
        	<h2>Welcome to the DNC Portal</h2>
        </div>
        <div class="jumbotron center">       	
        	<img class="user_pic" src="<?= $user_photo_path; ?>" /><br>
			<p>
				<h2><?= "$fn $ln"; ?></h2>
				<?= $userjob; ?><br>
				<?= $useredu;  ?><br>
			   	<?= $institute;  ?>
			</p>
        </div>
    </div>    
        
<?php 
    include '../includes/footer.php';
?>
