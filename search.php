<?php include 'inc/header.php'; ?>


 <div class="main">


    <div class="content">

	      <div class="section group">
              <?php 
                    if (!isset($_GET['search']) || $_GET['search']==NULL) {
                        header("Location:404.php");
                    }else{
                        $search = $_GET['search'];
                    }

                    $product = $pd->searchProduct($search);
                 ?>
                    <?php 

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
				 <?php } } else{
                    echo "<span style='color:red;font-size:60px;'>Sorry! data not found</span>";
                 } ?>
			</div>

		
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
<style type="text/css">
	.img{
		width: 400px;
		height: 200px;
	}
</style>