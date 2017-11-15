<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

 <?php 
 	/**
 	* class for cart
 	*/
 	class Cart
 	{
 		
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}

		public function addToCart($quantity,$productId){
			$quantity = $this->fm->validation($quantity);
			// $quantity = mysqli_real_escape_string($this->db->link, $quantity);
			// $productId= mysqli_real_escape_string($this->db->link, $productId);
			$sId      = session_id();

			$squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
			$result = $this->db->select($squery)->fetch_assoc();

			$productName = $result['productName'];
			$price = $result['price'];
			$image = $result['image'];

			$chkquery = "SELECT * FROM tbl_cart WHERE productId ='$productId' AND sId = '$sId'";
			$chkresult = $this->db->select($chkquery);
			if($chkresult){
				$msg = "Product Already added";
				return $msg;
			}else{

			$query ="INSERT INTO `tbl_cart`(`sId`,`productId`,`productName`,`price`,`quantity`,`image` )VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
			$inserted_row = $this->db->insert($query);
			if($inserted_row){
				header("Location:cart.php");
			}else{
				header("Location:404.php");
			}
		  }
		}


		public function getCartProduct(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE `sId` ='$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function quantityUpdate($cartId,$quantity){
			// $cartId   = mysql_real_escape_string($cartId);
			// $quantity =mysql_real_escape_string($quantity);

			$cartId   =$this->fm->validation($cartId);
			$quantity =$this->fm->validation($quantity);

			$query ="UPDATE tbl_cart SET quantity ='$quantity' WHERE cartId='$cartId'";
			$result=$this->db->update($query);

			if($result){
				header("Location:cart.php");
			}else{
				$msg ="<span class='error'>error...Quantity Update failed</span>";
				return $msg;
			}	
		}

		public function RemoveProById($cartId){
			//$cartId = mysql_real_escape_string($cartId);
			$query ="DELETE FROM tbl_cart WHERE cartId='$cartId'";
			$result =$this->db->delete($query);
			if($result){
				$msg ="<span class='success'>Product Removed Successfully</span>";
				return $msg;
			}else{
				$msg ="<span class='error'>error...Product Remove failed</span>";
				return $msg;
		    }

 	    }

 	    public function checkCartTable(){
 	    	$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE `sId` ='$sId'";
 	    	$result =$this->db->select($query);
 	    	return $result;
 	    }
 	    public function delCustomerCart($id){
 	    	$sId = session_id();

 	    	$query =" DELETE FROM `tbl_cart` WHERE sId = '$sId'";
 	    	$result =$this->db->delete($query);
 	    	return $result;
 	    }

 	    public function orderProduct($cmrId){
 	    	$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE `sId` ='$sId'";
 	    	$getPro =$this->db->select($query);
 	    	if ($getPro) {
 	    		while ($result=$getPro->fetch_assoc()) {
 	    			$productId   = $result['productId']; 
 	    			$productName = $result['productName'];
 	    			$quantity    = $result['quantity'];
 	    			$price       = $result['price'] * $quantity;
 	    			$image       = $result['image'];

 	    			$query ="INSERT INTO `tbl_order`(`cmrId`,`productId`,`productName`,`quantity`,`price`,`image` )VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
			        $inserted_row = $this->db->insert($query);
 	    		}
 	    	}
 	    }

 	    public function PaybleAmount($cmrId){
 	    	$query = "SELECT * FROM tbl_order WHERE `cmrId` ='$cmrId' AND date = now()";
 	    	$result =$this->db->select($query);
 	    	return $result;
 	    }

 	    public function getOrderDetails($cmrId){
 	    	$query = "SELECT * FROM tbl_order WHERE `cmrId` ='$cmrId'ORDER BY date  desc";
 	    	$result =$this->db->select($query);
 	    	return $result;
 	    }

 	    public function checkOrder($cmrId){
 	    	$query = "SELECT * FROM tbl_order WHERE `cmrId` ='$cmrId'";
 	    	$result =$this->db->select($query);
 	    	return $result;
 	    }

 	    public function getAllOrderProduct(){
 	    	$query = "SELECT * FROM tbl_order ORDER BY date ";
 	    	$result =$this->db->select($query);
 	    	return $result;
 	    }

 	    public function productShifted($id,$price,$cmrId){
 	  //   	 $id   = mysql_real_escape_string($id);
			 // $price =mysql_real_escape_string($price);
			 // $cmrId =mysql_real_escape_string($cmrId);


 	    	 $query = "UPDATE tbl_order SET status='1' WHERE id='$id' AND price='$price' AND cmrId='$cmrId' ";
 	    	 $success = $this->db->update($query);
 	    	 if($success){
				$msg ="<span class='success'>Product Shifted Successfully</span>";
				return $msg;
			}else{
				$msg ="<span class='error'>error...Product Shifted failed</span>";
				return $msg;
			}	
 	    }

 	    public function delShiftedPro($id,$price,$cmrId){
 	    	// 	$id   = mysql_real_escape_string($id);
			    // $price =mysql_real_escape_string($price);
			    // $cmrId =mysql_real_escape_string($cmrId);

			    $query =" DELETE FROM `tbl_order` WHERE id = '$id' AND price=$price AND cmrId=$cmrId";
			 	$result =$this->db->delete($query);
			 	if($result){
				$msg ="<span class='success'>Shifted Product Delete Successfully</span>";
				return $msg;
			    }else{
				$msg ="<span class='error'>error...Shifted Product Delete failed</span>";
				return $msg;
			}	
 	    }

 	    public function productShiftedConfirm($id,$price,$cmrId){
 	  //   	 $id   = mysql_real_escape_string($id);
			 // $price =mysql_real_escape_string($price);
			 // $cmrId =mysql_real_escape_string($cmrId);

			 $query = "UPDATE tbl_order SET status='2' WHERE id='$id' AND price='$price' AND cmrId='$cmrId' ";
 	    	 $success = $this->db->update($query);
 	    }
    }
  ?>