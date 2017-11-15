<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>


<?php 
    if (!isset($_GET['brandId']) || $_GET['brandId'] == NULL) {
       echo  "<script>window.location = 'brandlist.php'</script>";
    }else{
        $id = $_GET['brandId'];
    }
 ?>


<?php 
    $brand = new Brand();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $brandName = $_POST['brandName'];
        $id        =$_POST['id'];

        $updatebrand = $brand->brandUpate($brandName,$id);
        
  
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 

                   <?php 
                        if(isset($updatebrand)){
                            echo $updatebrand;
                        }
                    ?>

                    <?php 
                        $getBrand = $brand->getbrandById($id);
                        if($getBrand){
                            while ($result = $getBrand->fetch_assoc()) {
                               
                            
                     ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td><input type="hidden" name="id" value="<?php echo $result['brandId'] ?>">
                                <input type="text" name="brandName" value="<?php echo     $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }} ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>