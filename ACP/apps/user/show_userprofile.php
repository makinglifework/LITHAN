<?php 

    namespace apps\user;
    
    ob_start();
    include '../includes/security.php';
    
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
	<!DOCTYPE html>
<html>
    <head>
        <title>DNC</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/bootstrap/bootstrap.3.3.7.min.css" />
        <link rel="stylesheet" href="../assets/abc/member.css" />
        <script src="../assets/jquery/jquery.3.2.1.min.js"></script>
        <script src="../assets/bootstrap/bootstrap.3.3.7.min.js"></script>
        <style>
        </style>
    </head>
        <body>
        <div id="top-bar">      
            <div class="container-fluid">
                <div class="row">
                	<a id="img_logo" href="../../index.php"><img alt="home" src="../images/default/abc_logo_motto.png"></a> 
            	</div>
            </div>            
        </div>
        <div class="container">
        	<div class="col-lg-12 col-lg-offset-2">
            	<div id="content">
            		<div class = "user_profile ">       			
            			<h1><?= "$firstname $lastname"; ?></h1>
            			<h2>Profile: <img src="<?= $user_photo_path; ?>" class = "user_pic" /></h2>
            			<p>
            				Designation:&nbsp; <?= $userjob; ?><br>
            				Qualification:&nbsp; <?= $useredu;  ?><br>
            			   	Instituion:&nbsp; <?= $institute;  ?><br>
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