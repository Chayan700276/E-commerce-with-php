<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php 
	$brand = new Brand();
 ?>
 <?php  
 	if(isset($_GET['delbrand'])){
 		$id = $_GET['delbrand'];

 		$delbrand = $brand->delbrandById($id);
 	}
  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">   
                 <?php 
                 	if(isset($delbrand)){
                 		echo $delbrand;
                 	}
                  ?>     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brnad Name</th>
							<th>Action</th>
						</tr>
					</thead>
						<?php 
							$getBrand=$brand->getAllbrnad();
							if($getBrand){
								$i=0;
								while ($result = $getBrand->fetch_assoc()){
									$i++;
						 ?>
					
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['brandName'] ?></td>
							<td><a href="brandedit.php?brandId='<?php echo $result['brandId'] ?>'">Edit</a> || <a onclick="return confirm('Are u sure want to delete!')" href="?delbrand='<?php echo $result ['brandId']; ?>'">Delete</a></td>
						</tr>
						<?php  }} ?>
					
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

