<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

 <?php 
 	/**
 	* class for product
 	*/
 	class Product 
 	{
 		
		private $db;
		private $fm;
		
		public function __construct(){
			$this->db = new database();
			$this->fm = new format();
		}

		public function productInsert($data,$file){
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
			$bradId      = mysqli_real_escape_string($this->db->link, $data['bradId']);
			$price       = mysqli_real_escape_string($this->db->link, $data['price']);
			$type        = mysqli_real_escape_string($this->db->link, $data['type']);
			$body        = mysqli_real_escape_string($this->db->link, $data['body']);

			
		    $file_name = $_FILES['image']['name'];
		    $file_size = $_FILES['image']['size'];
		    $file_temp = $_FILES['image']['tmp_name'];
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "upload/".$unique_image;

		    if($productName =="" || $catId =="" || $bradId =="" || $price =="" || $type =="" || $body =="" || $file_name ==""){
		    	$msg = "<span class='error'>Product field must not be empty</span>";
				return $msg;
		    }
			elseif ($file_size >1048567) {
			     echo "<span class='error'>Image Size should be less then 1MB!
			     </span>";
			 } elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-"
			     .implode(', ', $permited)."</span>";
			 } else{
			 	
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query ="INSERT INTO `tbl_product`(`productName`,`catId`,`brandId`,`body`,`price`,`image`,`type` )VALUES('$productName','$catId','$bradId','$body','$price','$uploaded_image','$type')";	
		    	$productInsert = $this->db->insert($query);
		    	if($productInsert){
		    		$msg = "<span class='success'>Product Inserted succesfully</span>";
		    		return $msg;
		    	}else{
		    		$msg = "<span class='error'>error.. Product insert failed</span>";
		    		return $msg;
		    	}	    
		    }

		}

		public function getAllProduct(){
			//using by aliases
				$query ="SELECT p.*, c.catName, b.brandName
				FROM tbl_product as p , tbl_category as c ,tbl_brand as b WHERE 
				   p.catId = c.catId AND p.brandId = b.brandId
				   ORDER BY p.productId DESC
				";
			/*

			// usein by inner join
			$query ="SELECT tbl_product.*, tbl_category.catName ,tbl_brand.brandName FROM tbl_product 
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand 
				ON tbl_product.brandId = tbl_brand.brandId
			    ORDER BY tbl_product.productId DESC";

			    */
			$result = $this->db->select($query);
			return $result;
		}

		public function getProById($id){
			$query = "SELECT * FROM tbl_product WHERE productId =$id";
			$result = $this->db->select($query);
			return $result;
		}

		public function productUpdate($data,$file,$id){
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
			$brandId      = mysqli_real_escape_string($this->db->link, $data['bradId']);
			$price       = mysqli_real_escape_string($this->db->link, $data['price']);
			$type        = mysqli_real_escape_string($this->db->link, $data['type']);
			$body        = mysqli_real_escape_string($this->db->link, $data['body']);

			
		    $file_name = $_FILES['image']['name'];
		    $file_size = $_FILES['image']['size'];
		    $file_temp = $_FILES['image']['tmp_name'];
		    $permited  = array('jpg', 'jpeg', 'png', 'gif');

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "upload/".$unique_image;

		    if($productName =="" || $catId =="" || $brandId =="" || $price =="" || $type =="" || $body ==""){
		    	$msg = "<span class='error'>Product field must not be empty</span>";
				return $msg;
		    }
		    else{   // half from here......
		    	if(!empty($file_name)){

					if ($file_size >1048567) {
					     echo "<span class='error'>Image Size should be less then 1MB!
					     </span>";
					 } elseif (in_array($file_ext, $permited) === false) {
					     echo "<span class='error'>You can upload only:-"
					     .implode(', ', $permited)."</span>";
					 } else{
					 	
				    	move_uploaded_file($file_temp, $uploaded_image);

				    	$query =" UPDATE `tbl_product`
				    			SET 
				    			`productName` = '$productName',
				    			`catId`       = '$catId',
				    			`brandId`     = '$brandId',
				    			`price`       = '$price',
				    			`type`        = '$type',
				    			`body`        = '$body',
				    			`image`       = '$uploaded_image'
				    			WHERE `productId` ='$id'";	// its better to uncoated id ''
				    	$productUpdate = $this->db->update($query);
				    	if($productUpdate){
				    		$msg = "<span class='success'>Product Updated succesfully</span>";
				    		return $msg;
				    	}else{
				    		$msg = "<span class='error'>error.. Product Updated failed</span>";
				    		return $msg;
				    	}	    
				    }
				  }else{
					 	// last part from here

				    	$query =" UPDATE `tbl_product`
				    		     SET 
				    			`productName` = '$productName',
				    			`catId`       = '$catId',
				    			`brandId`     = '$brandId',
				    			`price`       = '$price',
				    			`type`        = '$type',
				    			`body`        = '$body'
				    			WHERE `productId` ='$id'";	 // its better to uncoatd id
				    	$productUpdate = $this->db->update($query);
				    	if($productUpdate){
				    		$msg = "<span class='success'>Product Updated succesfully</span>";
				    		return $msg;
				    	}else{
				    		$msg = "<span class='error'>error.. Product Updated failed</span>";
				    		return $msg;
				    	}	    
				    }
				 }
			  }

		 public function delProById($id){
		 	$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		 	 $getData = $this->db->select($query);

		 	 if($getData){
		 	 	while ($delImg= $getData->fetch_assoc()) {
		 	 		$dellink = $delImg['image'];
		 	 		unlink($dellink);
		 	 	}
		 	 }

		 	 $delquery = "DELETE FROM tbl_product WHERE productId = '$id'";
			$deldata = $this->db->delete($delquery);  
			if($deldata){
				$msg = "<span class='success'>Product delete success </span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Product delete  failed </span>";
				return $msg;
			}
		 }



		 public function getFeaturedProduct(){
			 $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY `productId` DESC LIMIT 4 ";
			$result = $this->db->select($query);
			return $result;
		 }

		 public function getFeaturedNewPD(){
		 	$query = "SELECT * FROM tbl_product WHERE type='1' ORDER BY `productId` DESC LIMIT 4 ";
			$result = $this->db->select($query);
			return $result;
		 }


		 public function getProDetails($id){
			//using by aliases
				$query ="SELECT p.*, c.catName, b.brandName
				FROM tbl_product as p , tbl_category as c ,tbl_brand as b WHERE 
				   p.catId = c.catId AND p.brandId = b.brandId AND p.productId='$id'";
			/*

			// usein by inner join
			$query ="SELECT tbl_product.*, tbl_category.catName ,tbl_brand.brandName FROM tbl_product 
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand 
				ON tbl_product.brandId = tbl_brand.brandId
			    ORDER BY tbl_product.productId DESC";

			    */
			$result = $this->db->select($query);
			return $result;
		}


		public function getLatestFromIphone(){
		 	$query = "SELECT * FROM tbl_product WHERE brandId=17 ORDER BY `productId` DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		 }

		 public function getLatestFromSamsung(){
		 	$query = "SELECT * FROM tbl_product WHERE brandId=16 ORDER BY `productId` DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		 }
		 public function getLatestFromAcer(){
		 	$query = "SELECT * FROM tbl_product WHERE brandId=13 ORDER BY `productId` DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		 }
		 public function getLatestFromCanon(){
		 	$query = "SELECT * FROM tbl_product WHERE brandId=12 ORDER BY `productId` DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		 }

		 public function productByCat($id){
		 	//$id = mysql_real_escape_string($id);
		 	$query = "SELECT * FROM tbl_product WHERE catId =$id";
			$result = $this->db->select($query);
			return $result;
		 }

		 public function insertCompareData($cmrId,$proId){
		 	// $cmrId = mysql_real_escape_string($this->db->link,$cmrId);
		 	// $proId = mysql_real_escape_string($this->db->link,$proId);

		 	$cquery ="SELECT * FROM tbl_compare WHERE `cmrId`='$cmrId' AND `productId` ='$proId'";
 	    	$chk =$this->db->select($cquery);
 	    	if ($chk) {
 	    		$msg = "<span style='color:red'font-size:30px;>Already Added! </span>";
						return $msg;
 	    	}else{


		 	$query = "SELECT * FROM tbl_product WHERE `productId` ='$proId'";
 	    	$product =$this->db->select($query);
 	    	if ($product) {
 	    		  while ($result= $product->fetch_assoc()) {
 	    		  

 	    			$productId   = $result['productId']; 
 	    			$productName = $result['productName'];
 	    			$price       = $result['price'];
 	    			$image       = $result['image'];

 	    			$query ="INSERT INTO `tbl_compare`(`cmrId`,`productId`,`productName`,`price`,`image` )VALUES('$cmrId','$productId','$productName','$price','$image')";
			        $inserted_row = $this->db->insert($query);
				        if($inserted_row){
						$msg = "<span style='color:green'font-size:30px;>Product Added to Compare </span>";
						return $msg;
						} else{
						$msg = "<span style='color:red'font-size:30px;>Product Compare  failed </span>";
						return $msg;
						}
 	    	}
 	      }
 	      }
		 }


		 public function checkCompare($cmrId){

		 	$cquery ="SELECT * FROM tbl_compare WHERE `cmrId`='$cmrId'";
 	    	$chk =$this->db->select($cquery);
 	    	if ($chk) {
 	    		return true;
 	    	}else{
 	    		return false;
 	    	}
		 }

		 public function delCompareData($id){

		 	$query =" DELETE FROM `tbl_compare` WHERE `cmrId` = '$id'";
 	    	$result =$this->db->delete($query);
 	    	return $result;
		 }

		 public function insertWlistData($cmrId,$proId){
		 	//$cmrId = mysql_real_escape_string($cmrId);
		 	//$proId = mysql_real_escape_string($proId);

		 	$cquery ="SELECT * FROM tbl_wlist WHERE `cmrId`='$cmrId' AND `productId` ='$proId'";
 	    	$chk =$this->db->select($cquery);
 	    	if ($chk) {
 	    		$msg = "<span style='color:red'font-size:30px;>Already Added! </span>";
						return $msg;
 	    	}else{


		 	$query = "SELECT * FROM tbl_product WHERE `productId` ='$proId'";
 	    	$product =$this->db->select($query);
 	    	if ($product) {
 	    		  while ($result= $product->fetch_assoc()) {
 	    		  

 	    			$productId   = $result['productId']; 
 	    			$productName = $result['productName'];
 	    			$price       = $result['price'];
 	    			$image       = $result['image'];

 	    			$query ="INSERT INTO `tbl_wlist`(`cmrId`,`productId`,`productName`,`price`,`image` )VALUES('$cmrId','$productId','$productName','$price','$image')";
			        $inserted_row = $this->db->insert($query);
				        if($inserted_row){
						$msg = "<span style='color:green'font-size:30px;>Product Added to Wish List </span>";
						return $msg;
						} else{
						$msg = "<span style='color:red'font-size:30px;>Product Compare  failed </span>";
						return $msg;
						}
 	    	}
 	      }
 	      }
		 }


        public function checkWishlist($cmrId){

        	$cquery ="SELECT * FROM tbl_wlist WHERE `cmrId`='$cmrId'";
 	    	$chk =$this->db->select($cquery);
 	    	if ($chk) {
 	    		return true;
 	    	}else{
 	    		return false;
 	    	}
        }

        public function delWishData($productId,$cmrId){
        	$query = "DELETE FROM tbl_wlist WHERE productId =$productId AND cmrId =$cmrId";
        	$result = $this->db->delete($query);
        	if ($result) {
        		 $msg = "<span style='color:green'font-size:30px;>Delete success </span>";
				 return $msg;
        	}else{
        		$msg = "<span style='color:red'font-size:30px;>error... Delete Failed </span>";
				 return $msg;
        	}
        }


        public function productByBrand($id){
        	$query = "SELECT  * FROM tbl_product WHERE brandId =$id ORDER BY brandId asc";
        	$productData = $this->db->select($query);
        	if ($productData) {
        		return $productData;
        	}
        }


        public function searchProduct($search){
        	$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$search%' LIMIT 7";
        	$result = $this->db->select($query);
        	if ($result) {
        		return $result;
        	}
        }


 	}
  ?>