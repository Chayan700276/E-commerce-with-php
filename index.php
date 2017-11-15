<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
 ?>


<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      			<?php 
	      				$getFeaturedPD = $pd->getFeaturedProduct();
	      				if($getFeaturedPD){
	      					while ($result =$getFeaturedPD->fetch_assoc()) {
	      					
	      			 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?proId=<?php echo $result['productId'] ?>"><img src="admin/<?php echo $result['image'] ?>" height="180px" width="300px" alt="" /></a>
					 <h2><?php echo $result['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
					 <p><span class="price"><?php echo $result['price'] ?></span></p>
				     <div class="button"><span><a href="preview.php?proId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php }} ?>	

			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
	      			<?php 
	      				$getFeaturedNewPD = $pd->getFeaturedNewPD();
	      				if($getFeaturedNewPD){
	      					while ($Newresult =$getFeaturedNewPD->fetch_assoc()) {
	      					
	      		  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?proId=<?php echo $Newresult['productId'] ?>"><img src="admin/<?php echo $Newresult['image'] ?>" height="180px" width="300px" alt="" /></a>
					 <h2><?php echo $Newresult['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($Newresult['body'], 60); ?></p>
					 <p><span class="price"><?php echo $Newresult['price'] ?></span></p>
				     <div class="button"><span><a href="preview.php?proId=<?php echo $Newresult['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php }} ?>	

			</div>
    </div>
 </div>





 <?php 
 	include 'inc/footer.php';
  ?>
	