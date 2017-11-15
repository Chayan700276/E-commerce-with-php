<?php include 'inc/header.php'; ?>
		<?php 
			$login =Session::get("cuslog");
			if ($login==false) {
				header("Location:login.php");
			}
		 ?>

<style>
.payment{width:500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin:0px auto;padding:50px;}
.payment h2{
	border-bottom: 1px solid #ddd;margin-bottom: 40px;padding-bottom: 10px;
}
.payment a{
background : #ff0000 none repeat scroll 0 0;border-radius:3px;color:#fff;font-size: 25px;padding: 5px 30px;
}
.back a{
width: 150px; margin: 5px auto 0;padding:10px;text-align: center;display: block;background-color: #555;border: 1px solid #ddd;color: white;border-radius: 4px;
}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="payment">
				<h2>Choose Payment Option</h2>		
				<a href="payOffline.php">Offline Payment</a>
				<a href="payOffline.php">Online Payment</a>
			</div>
			<div class="back">
				<a href="cart.php">Previous</a>
			</div>
		</div>
	</div>
</div>
	
<?php include 'inc/footer.php'; ?>