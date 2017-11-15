<?php include 'inc/header.php' ?>
  <?php 
  	if (!isset($_GET['proId']) || $_GET['proId']==NULL) {
  		echo "<script>window.location= '404.php';</script>";
  	}else{
  		$id = preg_replace('/[^-a-sA-Z0-9]/','',$_GET['proId']);
  	}

  	 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']) ){
        $quantity  = $_POST['quantity'];
        $addCart = $ct->addToCart($quantity,$id);
    }
   ?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

				<?php 
					$getProduct = $pd->getProDetails($id);
					if($getProduct){
						while ($result =$getProduct->fetch_assoc()) {
							
				 ?>		
									
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?> </h2>				
					<div class="price">
						<p>Price: <span><?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>
					<span style="color:red; font-size: 25px;">	
					<?php 
						if(isset($addCart)){
							echo "Product Already Added";
						}
					 ?>
					 </span>
				</div>
				<?php 
					  	$cmrId = Session::get("cmrId");
					if ($_SERVER['REQUEST_METHOD']=='POST'  && isset($_POST['compare'])) {
				        $proId = $_POST['cmprId'];
						$insertCompare = $pd->insertCompareData($cmrId,$proId);

						if ($insertCompare) {
							echo $insertCompare;
						}

					} 
				 ?>
				 <?php 
					  	$cmrId = Session::get("cmrId");
					if ($_SERVER['REQUEST_METHOD']=='POST'  && isset($_POST['wlist'])) {
				        $proId = $_POST['cmprId'];
						$insertWlist = $pd->insertWlistData($cmrId,$proId);

						if ($insertWlist) {
							echo $insertWlist;
						}

					} 
				 ?>
				<?php
					$login =Session::get("cuslog");
				    if ($login==true) {?>
				<div class="add-cart">
				  <div class="mybutton">
					<form action="" method="POST">
						<input type="hidden" class="buyfield" name="cmprId" value="<?php echo $result['productId']; ?>"/>
						<input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
					</form>
				   </div>
				   <div class="mybutton">
					<form action="" method="POST">
						<input type="hidden" class="buyfield" name="cmprId" value="<?php echo $result['productId']; ?>"/>
						<input type="submit" class="buysubmit" name="wlist" value="Save to WishList"/>
					</form>
				   </div>
				</div>
				<?php } ?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body']; ?>
	    </div>
	    <?php }} ?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
				 <h2>CATEGORIES</h2>
					<?php 
						$getCat = $cat->getAllCat();
						if ($getCat) {
							 while ($result =$getCat->fetch_assoc()) {
							 
	
					 ?>
					<ul>
				      <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
    				</ul>
    				<?php }} ?>
    	
 				</div>
 		</div>
 	</div>
 
 <?php include 'inc/footer.php'; ?>
 <style>
 	
 .mybutton{
 	width:100px;
 	float: left;
 	margin-right: 50px;
 }
 </style>
