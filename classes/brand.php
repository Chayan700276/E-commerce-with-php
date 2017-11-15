<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

<?php 
	/**
	* class for brand
	*/
	class Brand{
		
		private $db;
		private $fm;
		
		public function __construct(){
			$this->db = new database();
			$this->fm = new format();
		}
		public function brandInsert($brandName){
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);

			if(empty($brandName)){
				$msg = "<span class='error'>Brand field must not be empty<span>";
				return $msg;
		    }else{
		    	$query ="INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
		    	$brandInsert = $this->db->insert($query);
		    	if($brandInsert){
		    		$msg = "<span class='success'>Brand Name Inserted succesfully</span>";
		    		return $msg;
		    	}else{
		    		$msg = "<span class='error'>error.. Brand Name insert failed</span>";
		    		return $msg;
		    	}
		    }
	   }

	   	public function getAllbrnad(){
		$query = "SELECT * FROM tbl_brand ORDER BY `brandId` DESC ";
		$result = $this->db->select($query);
		return $result;
	}

	    public function getbrandById($id){
	    	$query ="SELECT * FROM tbl_brand WHERE brandId=$id";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function brandUpate($brandName,$id){
	    	$brandName = $this->fm->validation($brandName);
		    $brandName = mysqli_real_escape_string($this->db->link, $brandName);

		$id = mysqli_real_escape_string($this->db->link, $id);

		if(empty($brandName)){
		   $msg = "<span class='error'>Brand field must not be empty<span>";
				return $msg;
		 }else{
		 	$query = " UPDATE `tbl_brand` SET `brandName`='$brandName' WHERE `brandId` ='$id'";
		 	$result = $this->db->update($query);
		 	if($result){
		 		$msg = "<span class='success'>Brand update success <span>";
				return $msg;
		 	}
		 	else {
		 		$msg = "<span class='error'>error..Brand update failed <span>";
				return $msg;
		 	}
		 }
	    }
	    public function delbrandById($id){
			

			$query = "DELETE FROM tbl_brand WHERE brandId = $id";
			$deldata = $this->db->delete($query);  
			if($deldata){
				$msg = "<span class='success'>Brand delete success <span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Brand delete  failed <span>";
				return $msg;
			}
		}

		public function AllTobBrands(){
			$query = "SELECT * FROM tbl_brand ORDER BY brandId asc limit 3";
			$select = $this->db->select($query);
			if ($select) {
				return $select;
			}
		}	


	}
 ?>