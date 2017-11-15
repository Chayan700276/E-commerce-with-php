<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/session.php');
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>


<?php 

	class adminLogin {

		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}

		public function adminLogin($adminUser,$adminPass){
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if(empty($adminUser) || empty($adminPass)){
				$loginmsg = "Username or Password must not be empty";
				return $loginmsg;
			}else{
				$query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";

				$result =$this->db->select($query);
				if($result != false){
					$value = $result->fetch_assoc();
					Session::set("adminlogin", true);
					Session::set("adminId",$value['adminId']);
					Session::set("adminUser",$value['adminUser']);
					Session::set("adminName",$value['adminName']);
					header("Location:index.php");
				}else{
					$loginmsg ="Username or password not match";
					return $loginmsg;
				}
			}
		}


		public function getAdminData(){
			$admin_id = Session::get('adminId');

			$query = "SELECT * FROM  tbl_admin WHERE adminId = $admin_id";
			$data = $this->db->select($query);
			if ($data) {
				return $data;
			}
		}

		public function adminDataUpdate($data){
			
			$adminName = $data['adminName'];
	 		$adminUser = $data['adminUser'];
	 		$adminEmail = $data['adminEmail'];
	 		$adminId = Session::get('adminId');

	 		if (empty($adminName) || empty($adminUser) || empty($adminEmail)) {
	 			$msg = "<p style='color:red'>Field must not be empty</p>";
				return $msg;
	 		}

	 		$query = "UPDATE `tbl_admin` 
	 				  SET 
	 				  `adminName`  = '$adminName',
	 				  `adminUser`  = '$adminUser',
	 				  `adminEmail` = '$adminEmail'
	 				  WHERE `adminId` = '$adminId'";
	 		$result = $this->db->update($query);
	 		if ($result) {
	 			$msg = "<p style='color:green'>Data Updated succesfully</p>";
				return $msg;
	 		}


		}


		public function changePassword($data){
			$adminPass = $_POST['adminPass'];
			$newPass   = $_POST['newPass'];
			$adminId = Session::get('adminId');

			if (empty($adminPass) || empty($newPass)) {
				$msg = "<p style='color:red'>Field must not be empty</p>";
				return $msg;
			}else{

			$adminPass = md5($_POST['adminPass']);
			$newPass   = md5($_POST['newPass']);

			$query = "SELECT * FROM tbl_admin WHERE adminId =$adminId AND adminPass = '$adminPass'";
			$result = $this->db->select($query);
			if ($result) {
				$uquery = "UPDATE `tbl_admin`
								SET 
							`adminPass` = '$newPass'
							WHERE `adminId` = '$adminId'";
				$qresult = $this->db->update($uquery);
				if ($qresult) {
				$msg = "<p style='color:green'>Password has Changed</p>";
				return $msg;
				}
			}else{
				$msg = "<p style='color:red'>Old password is wrong</p>";
				return $msg;
			}

		  }
		}


	}
 ?>