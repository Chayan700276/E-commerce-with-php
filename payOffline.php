<?php include 'inc/header.php'; ?>
		<?php 
			$login =Session::get("cuslog");
			if ($login==false) {
				header("Location:login.php");
			}
		 ?>

		 <?php 
		 	if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
		 		$cmrId =Session::get("cmrId");
		 		$insertOrder = $ct->orderProduct($cmrId);
		 		$delData = $ct->delCustomerCart($id);
		 		header("Location:success.php");
		 	}
		  ?>
<style>
	.order{width: 300px;padding: 10px;background-color:red;text-align: center;color:white;margin-left: 360px; }
</style>
<div class="main">
	<div class="content">
		<div class="section group">

		    <div class="division">
		    	<table class="tblone">
							<tr>
							    <th>NO</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>

							<?php
								$getPro =$ct->getCartProduct();
								if ($getPro) {
									$i=0;
									$sum =0;
									$qty =0;
									while ($result = $getPro->fetch_assoc()) {
										$i++;
							 ?>

							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$.<?php echo $result['price']; ?></td>
								<td><?php echo $result['quantity']; ?></td>
								 <?php 
								 	$total = $result['price'] * $result['quantity'];
								 ?>
								<td>$<?php echo $total; ?></td>
							</tr>

							<?php 
							    $sum = $sum + $total;
							    $qty = $qty+ $result['quantity'];
						
							?>
							<?php }} ?>
						</table>
						<table style="float:right;text-align:left;" width="30%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$
									<?php 
										$vat = $sum * 0.1;
										$gtotal = $vat + $sum;
										echo $gtotal;
									 ?>
								 </td>
							</tr>
							<tr>
								<td>Quantity</td>
								<td><?php echo $qty; ?></td>
							</tr>
					   </table>
		    </div> 

 			<div class="division">
 				<?php 
			$id = Session::get("cmrId");
			$getData = $cmr->getCustomerData($id);
			if ($getData) {
				while ($result= $getData->fetch_assoc()) {

		 ?>
			<table class="tblone">
		       	<tr>
			   		<td colspan="3"><h2>Your Profiles Details</h2></td>
				</tr>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td><?php echo $result['name'] ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $result['phone'] ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td>:</td>
					<td><?php echo $result['email'] ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><?php echo $result['address'] ?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
					<td><?php echo $result['city'] ?></td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td>:</td>
					<td><?php echo $result['zip'] ?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $result['country'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td>:</td>
					<td><a href="editprofile.php">Edit Profile</a></td>
				</tr>
			</table>
			<?php }} ?>
 			</div>
 			<div class="order">
 				<a href="?orderid=order" style="display: block;"><h2 style="color:yellow;font-size:30px;">Order Now</h2></a>
 			</div>
		</div>
	</div>
</div>
	
<?php include 'inc/footer.php'; ?>