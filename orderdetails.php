<?php include 'inc/header.php'; ?>
		<?php 
			$login =Session::get("cuslog");
			if ($login==false) {
				header("Location:login.php");
			}
		 ?>

<?php 
			if (isset($_GET['shiftid'])){
			$id    = $_GET['shiftid'];
			$price = $_GET['price'];
			$cmrId = $_GET['cmrId'];
			$Shifted = $ct->productShiftedConfirm($id,$price,$cmrId);
		}
 ?>

<div class="main">
	<div class="content">
		<div class="section group">
			<div class="notfound">
				<h2>Your Order Details</h2>
					<table class="tblone">
							<tr>
							    <th>SL</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>

							<?php
								$cmrId =Session::get("cmrId");
								$orderDetails =$ct->getOrderDetails($cmrId);
								if ($orderDetails) {
									$i=0;
									while ($result = $orderDetails->fetch_assoc()) {
										$i++;
							 ?>

							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $result['quantity']; ?></td>
								<td>$<?php echo $result['price']; ?></td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>
								<td>
								    <?php
								    	 if($result['status']=='0'){
								    	 	echo "Pending..";
								    	 }elseif($result['status']=='1'){?>
								    	 	<p>Shifted</p>
								    	<?php }else{?>

								    		<p>Ok</p>

								    	<?php } ?>
								 </td>
								 <?php 
								 	if($result['status']=='0'){
								  ?>
								<td>Not available</td>
								<?php }elseif($result['status']=='1'){ ?>
								 <td><a href="?shiftid=<?php echo $result['id'] ?> & price=<?php echo $result['price'] ?> & cmrId=<?php echo $result['cmrId'] ?>">Confirm</a></td>
								<?php }else{ ?>
									<td>Ok</td>
								<?php } ?>
							</tr>

							<?php }} ?>
							
						</table>
			</div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>