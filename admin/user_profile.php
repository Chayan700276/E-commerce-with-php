<?php require_once 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/adminLogin.php'; ?>

<?php 

 $admin = new adminLogin();
$admin_data = $admin->getAdminData();
 ?>



		<div class="grid_10">
            <div class="box round first grid">
                <h2> User Profile</h2>
                <div class="block">   
                <?php 

                if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD']=='POST') {
 		             $admin_update = $admin->adminDataUpdate($_POST);
 		             if ($admin_update) {
					 	  echo $admin_update;
                        	}

 	                }
 		


                	if ($admin_data) {
                		$result = $admin_data->fetch_assoc();
                 ?> 

		          <form action="" method="POST">
		            <table class="form">					
		                <tr>
		                    <td>
		                        <label>Name</label>
		                    </td>
		                    <td>
		                        <input type="text" value="<?php echo $result['adminName'] ?>"  name="adminName" class="medium" />
		                    </td>
		                </tr>
						 <tr>
		                    <td>
		                        <label>User Name</label>
		                    </td>
		                    <td>
		                        <input type="text" value="<?php echo $result['adminUser'] ?>" name="adminUser" class="medium" />
		                    </td>
		                </tr>

		                <tr>
		                    <td>
		                        <label>E-mail</label>
		                    </td>
		                    <td>
		                        <input type="text" value="<?php echo $result['adminEmail'] ?>" name="adminEmail" class="medium" />
		                    </td>
		                </tr>
						 
						
						 <tr>
		                    <td>
		                    </td>
		                    <td>
		                        <input type="submit" name="update" Value="Update" />
		                    </td>
		                </tr>
		            </table>
		            <?php } ?>
		         </form>

                </div>
            </div>
        </div>



<?php include 'inc/footer.php'; ?>