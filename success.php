<?php include 'inc/header.php'; ?>
		<?php 
			$login =Session::get("cuslog");
			if ($login==false) {
				header("Location:login.php");
			}
		 ?>

<style>
.Success{width:500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin:0px auto;padding:50px;}
.Success h2{
     margin-bottom: 40px;padding-bottom: 10px;
}
.Success h3{
	border-bottom: 1px solid #ddd;margin-bottom: 40px;padding-bottom: 10px; font-size: 70px;color:green;
}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="Success">
					<h3>Success</h3>
					<?php 
						$cmrId =Session::get("cmrId");
						$Amount = $ct->PaybleAmount($cmrId);
						if ($Amount) {
							$sum=0;
							while ($result =$Amount->fetch_assoc()) {
					     	$sum = $sum +$result['price'];
							}
							   
					 ?>

					<h2>Total Payble Amount(Including Vat) : $
					    <?php 
					      
					    	$vat = $sum * 0.1;
					    	$total =$sum +$vat;
					    	echo $total;
					    	
					 		}
					     ?>
					</h2>
					<h2>Thanks For Purchase. Receive Your Order Successfully. We Will Contact 
					You As Soon As Possible With Delivery Details.Here Is Your Order Details...
					<a href="orderdetails.php">Visit Here..</a></h2>
			</div>
		</div>
	</div>
</div>
	
<?php include 'inc/footer.php'; ?>