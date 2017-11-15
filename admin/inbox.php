<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/cart.php';?>

<?php 
		$ct = new Cart();
		$fm = new format();

		if (isset($_GET['shiftid'])){
			$id    = $_GET['shiftid'];
			$price = $_GET['price'];
			$cmrId = $_GET['cmrId'];
			$Shift = $ct->productShifted($id,$price,$cmrId);
		}
 ?>

 <?php  
 	   if (isset($_GET['delProid'])){
			$id    = $_GET['delProid'];
			$price = $_GET['price'];
			$cmrId = $_GET['cmrId'];
			$delShiftPro = $ct->delShiftedPro($id,$price,$cmrId);
		}
  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 
                	if (isset($Shift)) {
                		echo $Shift;
                	}
                 ?>
                 <?php 
                	if (isset($delShiftPro)) {
                		echo $delShiftPro;
                	}
                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Cust. ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$getOrder = $ct->getAllOrderProduct();
							if ($getOrder) {
								while ($result = $getOrder->fetch_assoc()) {
									
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $result['id'] ?></td>
							<td><?php echo $fm->formatDate($result['date']) ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td>$<?php echo $result['price'] ?></td>
							<td><?php echo $result['cmrId'] ?></td>
							<td><a href="custaddress.php?custId=<?php echo $result['cmrId']; ?>">View Details</a></td>
							<?php 
								if ($result['status']=='0') { ?>
									<td><a href="?shiftid=<?php echo $result['id'] ?> & price=<?php echo $result['price'] ?> & cmrId=<?php echo $result['cmrId'] ?>">Shift</a></td>
							 <?php 	}else if($result['status']=='1'){ ?>
									<td>Pending..</td>
							 <?php 	}else{ ?>							 
							    <td><a href="?delProid=<?php echo $result['id'] ?> & price=<?php echo $result['price'] ?> & cmrId=<?php echo $result['cmrId'] ?>">Remove</a></td>
							    <?php } ?>
						</tr>
						<?php }} ?>
					</tbody>
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
