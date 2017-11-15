<?php include 'inc/header.php'; ?>
		<?php 
			$login =Session::get("cuslog");
			if ($login==false) {
				header("Location:login.php");
			}
		 ?>

	    <?php 
	    	$id =Session::get("cmrId");
    		if($_SERVER['REQUEST_METHOD']=='POST'  && isset($_POST['submit'])) {
    		$custUpdate = $cmr->customerUpdate($_POST,$id); 
    		if ($custUpdate) {
    			 echo $custUpdate;
    		}
    	}?>
	<!--Design pore korteci-->

<div class="main">
	<div class="content">
		<div class="section group">
		<?php 
			$id = Session::get("cmrId");
			$getData = $cmr->getCustomerData($id);
			if ($getData) {
				while ($result= $getData->fetch_assoc()) {

		 ?>
		 <form action="" method="POST">
			<table class="tblone">
		       	<tr>
			   		<td colspan="3"><h2>Update Profiles Details</h2></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
				</tr>
				<tr>
					<td>City</td>
					<td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td><input type="text" name="zip" value="<?php echo $result['zip'] ?>"></td>
				</tr>
				<tr>
					<td>Country</td>
					<td><input type="text" name="country" value="<?php echo $result['country'] ?>"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Save"></td>
				</tr>
			</table>
			</form>
			<?php }} ?>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>