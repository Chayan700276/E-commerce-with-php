<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php 
	$cat = new category();
 ?>
 <?php  
 	if(isset($_GET['delcat'])){
 		$id = $_GET['delcat'];

 		$delCat = $cat->delCatById($id);
 	}
  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">   
                 <?php 
                 	if(isset($delCat)){
                 		echo $delCat;
                 	}
                  ?>     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
						<?php 
							$getCat=$cat->getAllcat();
							if($getCat){
								$i=1;
								while ($result = $getCat->fetch_assoc()){
									
						 ?>
					
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['catName'] ?></td>
							<td><a href="catedit.php?catId='<?php echo $result['catId'] ?>'">Edit</a> || <a onclick="return confirm('Are u sure want to delete!')" href="?delcat='<?php echo $result ['catId']; ?>'">Delete</a></td>
						</tr>
						<?php $i++; }} ?>
					
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

