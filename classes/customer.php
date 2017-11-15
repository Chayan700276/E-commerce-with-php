<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

 <?php 
 	/**
 	* class for cart
 	*/
 	class Customer
 	{
 		
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}

		public function customerRegistration($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$passoword = mysqli_real_escape_string($this->db->link, md5($data['passoword']));

			if($name =="" || $city =="" || $zipcode =="" || $email =="" || $address =="" || $country =="" || $phone =="" || $passoword ==""){
		    	$msg = "<span style='color:red'>Field must not be empty</span>";
				return $msg;
			}

			$mailquery ="SELECT * FROM tbl_customer WHERE email ='$email' LIMIT 1";
			$mailChk = $this->db->select($mailquery);
			if ($mailChk !=false) {
				$msg = "<span style='color:red'>Email Already Exist!</span>";
				return $msg;
			}else{
				$query ="INSERT INTO `tbl_customer`(`name`,`city`,`zip`,`email`,`address`,`country`,`phone`,`password` )VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$passoword')";	
		    	$CustomerInsert = $this->db->insert($query);
		    	if($CustomerInsert){
		    		$msg = "<span style='color:green'>Customer Registered succesfully</span>";
		    		return $msg;
		    	}else{
		    		$msg = "<span style='color:red'>error.. Customer Registration failed</span>";
		    		return $msg;
		    	}	 
			}
		}

		public function customerLogin($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if (empty($email) || empty($password)) {
				$msg = "<span style='color:red'>Field must not be empty</span>";
				return $msg;
			}else{
				$query = "SELECT * FROM tbl_customer WHERE email ='$email' AND password= '$password'";
				$chkquery =$this->db->select($query);
				if($chkquery !=false){
					$value =$chkquery->fetch_assoc();
					Session::set("cuslog",true);
					Session::set("cmrId",$value['id']);
					Session::set("cmrName",$value['name']);
					header("Location:cart.php");
				}else{
					$msg = "<span style='color:red'>Email or password not match</span>";
				    return $msg;
				}
			}

		}

		public function getCustomerData($id){
			$query = "SELECT * FROM tbl_customer WHERE id =$id";
			$result = $this->db->select($query);
			return $result;
		}

		public function customerUpdate($data,$id){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zip']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			

			if($name =="" || $city =="" || $zipcode =="" || $email =="" || $address =="" || $country =="" || $phone ==""){
		    	$msg = "<span style='color:red'>Field must not be empty</span>";
				return $msg;
			}else{

				$query =" UPDATE `tbl_customer`
				    		     SET 
				    			`name`   = '$name',
				    			`city`   = '$city',
				    			`zip`    = '$zipcode',
				    			`email`  = '$email',
				    			`address`= '$address',
				    			`country`= '$country',
				    			`phone`  = '$phone'
				    			WHERE `id` =$id";	 // its better to uncoatd id
				    	$cusUpdate = $this->db->update($query);
				    	if($cusUpdate){
				    		$msg = "<span style='color:green'>Customer Profile Updated succesfully</span>";
				    		return $msg;
				    	}else{
				    		$msg = "<span style='color:red'>error.. Customer Profile Updated failed</span>";
				    		return $msg;
				    	}
			}
		}
 	}
  ?>