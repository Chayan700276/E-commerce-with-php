<?php include 'inc/header.php'; ?>


 <div class="main">

    			<?php 
    				$brand = $bd->AllTobBrands();
    				if ($brand) {
    					while ($result = $brand->fetch_assoc()) { 	
    			 ?>
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3><?php echo $result['brandName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>

	      <div class="section group">
	      	    	  <?php 

    	  		$brandId = $result['brandId'];
    	  		$product = $pd->productByBrand($brandId);
    	  		if ($product) {
    	  			while ($pro_result = $product->fetch_assoc()) {

    	   ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img class="img" src="admin/<?php echo $pro_result['image'] ?>" alt="" /></a>
					 <h2><?php echo $pro_result['productName'] ?> </h2>
					 <p></p>
					 <p><span class="price">$<?php echo $pro_result['price'] ?></span></p>
				     <div class="button"><span><a href="preview.php?proId=<?php echo $pro_result['productId'] ?>" class="details">Details</a></span></div>
				</div>
				 <?php } } ?>
			</div>

		
    </div>
     <?php  }  } ?>
 </div>
<?php include 'inc/footer.php'; ?>
<style type="text/css">
	.img{
		width: 400px;
		height: 200px;
	}
</style>