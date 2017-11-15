<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

<?php 
	/**
	* category class
	*/
	class category {
		
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}

		public function catInsert($catName){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if(empty($catName)){
				$msg = "<span class='error'>category field must not be empty<span>";
				return $msg;
		    }else{
		    	$query ="INSERT INTO tbl_category(catName) VALUES ('$catName')";
		    	$catInsert = $this->db->insert($query);
		    	if($catInsert){
		    		$msg = "<span class='success'>Category Inserted succesfully</span>";
		    		return $msg;
		    	}else{
		    		$msg = "<span class='error'>error.. Category insert failed</span>";
		    		return $msg;
		    	}
		    }
	}

	public function getAllcat(){
		$query = "SELECT * FROM tbl_category ORDER BY `catId` DESC ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getCatById($id){
		$query = "SELECT * FROM tbl_category WHERE catId =$id";
		$result = $this->db->select($query);
		return $result;
	}

	public function catUpate($catName,$id){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);

		$id = mysqli_real_escape_string($this->db->link, $id);

		if(empty($catName)){
		   $msg = "<span class='error'>category field must not be empty<span>";
				return $msg;
		 }else{
		 	$query = " UPDATE `tbl_category` SET `catName`='$catName' WHERE `catId` =$id";
		 	$result = $this->db->update($query);
		 	if($result){
		 		$msg = "<span class='success'>category update success <span>";
				return $msg;
		 	}
		 	else {
		 		$msg = "<span class='error'>error..category update failed <span>";
				return $msg;
		 	}
		 }
		
	}

  

		public function delCatById($id){
			

			$query = "DELETE FROM tbl_category WHERE catId = $id";
			$deldata = $this->db->delete($query);  
			if($deldata){
				$msg = "<span class='success'>category delete success <span>";
				return $msg;
			} else{
				$msg = "<span class='error'>category delete  failed <span>";
				return $msg;
			}
		}	


  }
 ?>