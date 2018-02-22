<?php
    include '../includes/security.php';
    include '../includes/header.php';
    
    require_once '../../core/acp/user.php';
    require_once '../../core/acp_bll/UserManager.php';
    
    use core\acp_bll\UserManager;
    use core\acp\User;

    $fn = $ln = $eml = $display_message = "";
    
    
    if (isset($_POST['clear_search'])) {
        $fn = $ln = $eml = $display_message = "";
    } else {
        if (isset($_POST['search'])) {
            if (empty($_POST['firstname']) && empty($_POST['lastname']) && empty($_POST['email'])) {
                $display_message = "* Please enter a valid search criteria.";
            }
            if (!empty($_POST['firstname'])) {
                $fn = strip_tags(trim($_POST['firstname']));
            } 
            
            if (!empty($_POST['lastname'])) {
                $ln = strip_tags(trim($_POST['lastname']));
            }
            
            if (!empty($_POST['email'])) {
                $eml = strip_tags(trim($_POST['email']));
            }
        }
    
    }
?>
	
	<div class="container">
		<div class="row">
		<br><br><br>
    	<form method="post" action="<?= $_SERVER["PHP_SELF"]?>">
    		<fieldset>
    			<legend>:: Search Members ::</legend> 
    			<label class="tab" for="firstname">First Name: </label>
    			<input type="text" name="firstname" id="firstname" value="<?= $fn ?>">
    			<label class="tab" for="lastname">Last Name: </label>
    			<input type="text" name="lastname" id="lastname" value="<?= $ln ?>">
        		<label class="tab" for="email">Email: </label>
            	<input type="text" name="email" id="email" value="<?= $eml ?>">
    			<input class="tab" type = "submit" name="search" value="Search">
    			<input type = "submit" name="clear_search" value="Clear Search">
    		</fieldset>
    	</form>
		</div>
		<br><br>
		<h3>Search List</h3>
		<span class="requiredfield"><?php if (!empty($display_message)) : echo $display_message; endif ?></span>
    	<?php     	
    	   echo "<table id='searchlist' >";
    	   echo "   <tr>";
    	   echo "       <th class='center'>ID</th>";   
           echo "       <th>First Name </th>"; 
           echo "       <th>Last Name</th>";
           echo "       <th>Email</th>";
           echo "       <th class='center'>Action</th>";
           echo "   </tr>";
           $um = new UserManager();
           $members = $um->getMembersBySearch($fn, $ln, $eml);
           if (isset($members)) {
               foreach ($members as $member) {
                   if ($member) {
                       echo "<tr>";
                       echo "  <td class='center'>".$member->id."</td>";
                       echo "  <td>".$member->firstname."</td>";
                       echo "  <td>".$member->lastname."</td>";
                       echo "  <td>".$member->email."</td>";
                       echo "  <td class='center'><a target='_blank' href='show_userprofile.php?id=".$member->id."'>view</a></td>";
                       echo "</tr>";
                   }                 
               } 
               echo "<span class='requiredfield'>Result: ".count($members)." found.</span>";
               echo "</table>";               
           } else {
               if (isset($_POST['search'])) :  echo "<span class='requiredfield'>Result: ".count($members)." found.</span>"; endif;
           }
           echo "</table>";
           
            
        ?>
	</div>
	
<?php 
    include '../includes/footer.php';
?>