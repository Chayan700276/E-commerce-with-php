<?php include 'inc/header.php'; ?>
		<?php 
			$login =Session::get("cuslog");
			if ($login==true) {
				header("Location:order.php");
			}
		 ?>
	    		<?php 
    			if($_SERVER['REQUEST_METHOD']=='POST'  && isset($_POST['login'])) {
    				$customerLog = $cmr->customerLogin($_POST); 
    			}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<?php 
	        	if (isset($customerLog)) {
	    				echo $customerLog;
	    			}  ?>
        	<form action="" method="POST">
                	<input name="email" type="text" placeholder="Enter your Email">
                    <input name="password" type="password" placeholder="Enter Your password">
                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>
            </form>
    	<div class="register_account">
    		<h3>Register New Account</h3>

    		<?php 
    			if($_SERVER['REQUEST_METHOD']=='POST'  && isset($_POST['register'])) {
    				$customerReg = $cmr->customerRegistration($_POST); 
    			}

    			if (isset($customerReg)) {
    				echo $customerReg;
    			}
    		 ?>
    		<form action="" method="POST" id="member">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="E-mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="address">
						</div>
		    		     <div>
							<input type="text" name="country" placeholder="Country">
						</div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="passoword" placeholder="passoword"/>
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
