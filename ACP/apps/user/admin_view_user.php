<?php 

    namespace apps\user;
    
    ob_start();
    include '../includes/security.php';
    include '../includes/admin_header.php';
    
    require_once '../../core/acp/user.php';
    require_once '../../core/acp_bll/UserManager.php';
    
    use core\acp_bll\UserManager;
    
    $firstname = $lastname = $email = $bio = $status ="";
    
    if (isset($_GET)) {
        $id=$_GET['id'];
        $um = new UserManager();
        $up = $um->getUserProfileByUserId($id);
        $firstname = $up->firstname;
        $lastname = $up->lastname;
        $email = $up->email;
        $userjob = $up->userjob;
        $useredu = $up->useredu;
        $institute = $up->institute;
        $user_photo_path = $up->user_photo_path;
        $bio = preg_replace("/[\r\n]+/", "</p><p>", $up->bio);
    }
    
?>
    <div class="container">
    	<div class="col-lg-12 col-lg-offset-2">
        	<div id="content">
        		<div class = "user_profile ">       			
        			<h1><?= "$firstname $lastname"; ?></h1>
        			<h2>Profile: <img src="<?= $user_photo_path; ?>" class = "user_pic" /></h2>
        			<p>
        				Designation:&nbsp; <?= $userjob; ?><br>
        				Qualification:&nbsp; <?= $useredu;  ?><br>
        			   	Institution:&nbsp; <?= $institute;  ?><br>
        			</p>
        			<h2>Experience: </h2>
        			<p><?= $bio; ?></p>
        			<p class="contact_info">Get connected with <?= $firstname; ?></p>
        			<ul>
        				<li>Email: <a href = "mailto:<?= $email; ?>"><?= $email; ?></a></li>
        			</ul>
        		
        		</div>
        	</div>
    	</div>
    </div>
<?php 
    include '../includes/footer.php';
?>