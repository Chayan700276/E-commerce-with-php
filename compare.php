<?php include 'inc/header.php'; ?>
<?php 
		$login =Session::get("cuslog");
		if ($login==false) {
			header("Location:login.php");
		}
		 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">
			<div class="cartpage">
			    	<h2>Compare</h2>
						<table class="tblone">
							<tr>
							    <th>SL</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
							<?php 
							    $cmrId = Session::get("cmrId");
								$query = "SELECT * FROM tbl_compare WHERE cmrId = $cmrId order by id desc";
								$Compare = $db->select($query);
								if ($Compare) {
									$i=1;
									while ($result = $Compare->fetch_assoc()) {?>		
								
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>$.<?php echo $result['price']; ?></td>
								<td>
									<a href="preview.php?proId=<?php echo $result['productId'] ?>">View</a>
								</td>
							</tr>
							<?php $i++;	} }?>

						</table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>