<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		/* ------------------------------- 
		Harith Dilshan S.A
		IT16034228
		--------------------------------*/	
	-->

	<title>User Profile</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
	.center {
	    
	}
	</style>
</head>
<body>
	<?php	
		if(isset($_POST['submit']))
		{
    		ob_end_clean(); 
    
    
		//loggin user
    		if($_POST['user_name'] =="admin@admin.com" && $_POST['user_pswd'] =="admin123") 
    		{
				
				//Create session in  browser
				session_start();

				
				//Setting and storing session ID
				$sessionID = session_id(); 
			
				
				if(empty($_SESSION['key']))
				{
					$_SESSION['key']=bin2hex(random_bytes(32));
				}
			
				//generate CSRF token
				$token = hash_hmac('sha256',$sessionID,$_SESSION['key']);

				//Setting 2 cookies
				setcookie("session_id_ass2",$sessionID,time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
				
				//csrf token cookie    				
				setcookie("csrf_token",$token,time()+3600,"/","localhost",false,true); 

				

				echo ' <div style="margin: auto;width: 50%;border: 3px solid #73AD21;padding: 10px;">
					<form  method="POST" action="server.php">
					<div style=" margin: auto;width: 50%;">
						<span>
							<h2 style="padding: 10px;width:70%;argin-left:20%;">Enter Comment Here!</h2>
						</span>
						</br>
						<div>
							<input style="padding: 10px;width:70%;argin-left:20%;"  type="text" name="user_name"  placeholder="Your Comment">
					
						</div>
						</br>
						<div>
							<button style="padding: 10px;width:70%;argin-left:20%;"  type="submit" name="submit">
								submit
							</button>
						</div>
						</br>
						<div class="spacing"><input type="hidden" id="csToken" name="CSR" value="'.$token.'"/></div>
					</div>
					</form>
					</div>
					';
					


				
    		}
    		else
    		{
				header( "Location:other/errorlogin.html" );
    		}

		}


?>

</body>
</html>
