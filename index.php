<?php
	session_start(); 

	if (!empty($_POST)) {
		$nama  = $_POST['nama'];
		$email = $_POST['email'];
		$pwd   = $_POST['password'];

		 $error = array();
        if (empty($nama)) {
            $error['nama'] = 'User name tidak boleh kosong';
        }

        if (empty($email)) {
            $error['email'] = 'Email tidak boleh kosong';
        }

        if (empty($pwd)) {
            $error['pwd'] = 'Password tidak boleh kosong';
        } 

        if (empty($error)) {
        			$_SESSION['login_masuk']=1;
           			$_SESSION['nama']     = $nama;
           			$_SESSION['email']    = $email;
           			$_SESSION['password'] = $pwd;
           			// true
                    header('Location: http://localhost/email/sendMail.php');
            }else{
            		// false
                    header('Location: http://localhost/email/index.php');
                    
            }
             
        } // state ditutup valudasinya

	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Email</title>

	<!-- Import Bootstrap -->
		<!-- Css -->
		<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
		<!-- JavaScript -->
		<!--<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>-->
	
	<!-- Import Material -->
		<!-- Css -->
			<link rel="stylesheet" href="node_modules/material/dist/css/material.min.css">
			<!-- JavaScript -->
			<!--<script type="text/javascript" src="node_modules/material/dist/js/material.min.js"></script>-->
			
	<!-- Import JQuery -->
			<script type="text/javascript" src="node_modules/dist/jquery.js"></script>
			<script src="node_modules/ckeditor/ckeditor.js"></script>
	<!-- Costume Css -->
			<style type="text/css" media="screen">
				#input .inputs {
			      width: 80%;
			    }
			    #input .form-control-wrapper {
			      margin: 30px 0;
			    }
			</style>
	<!-- End Import -->

</head>
<body>
	<div class="container-fluid">

		<!-- Header -->
		<div class="navbar navbar-primary">
		    <div class="navbar-header"></div>
		</div>
		
		<div class="container">
			<div class="row">
				<!--<div class="col-md-6 col-md-push-6">
				col-md-5 col-md-push-7 -->
					
     			<!--</div>  end -col-md-5 col-md-push-7 -->


                <div class="col-md-5 col-md-push-3">
                <!--col-md-5 col-md-pull-5 -->
                	<div class="panel panel-primary">
                		<div class="panel-heading">
                			<h3 class="panel-title">Login</h3>
                		</div>
                		<form action="" method="POST">
                			<div class="panel-body">
                			<div class="form-group">
	                	       	<label>User Name</label>
			                		<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
									  <input type="text" class="form-control" name="nama" placeholder="User Name" aria-describedby="sizing-addon1">
									</div>
			                	</div>
	                	       	<div class="form-group">
	                	       	<label>Your Email</label>
			                		<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon1">@</span>
									  <input type="email" class="form-control" name="email" placeholder="Your Email" aria-describedby="sizing-addon1">
									</div>
			                	</div>
			                	<div class="form-group">
			                	<label>Password</label>
			                		<div class="input-group">
									  <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
									  <input type="password" class="form-control" name="password" placeholder="Your Password" aria-describedby="sizing-addon2">
									</div>
			                	</div>
			                	<input type="submit" class="btn btn-primary" name="submit" value="login">
	                		</div>
                		</form>
                		
                   	</div> <!-- end panel col-md-5 col-md-pull-5-->
 					
                </div>
			</div>
		</div>
	</div>
</body>
</html>
