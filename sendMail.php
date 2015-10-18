<?php 
  session_start();
  	$login_masuk = $_SESSION['login_masuk'];
  	$userName	 = $_SESSION['nama'];
  	$email 		 = $_SESSION['email'];
  	$password    = $_SESSION['password'];
 
    if($login_masuk != '1'){
       session_destroy();
      header('Location: http://localhost/email/index.php');
    } 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Email Send</title>

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
			<!--<script src="//cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script> -->
	<!-- Costume Css -->
			<style type="text/css" media="screen">
				#input .inputs {
			      width: 80%;
			    }
			    #input .form-control-wrapper {
			      margin: 30px 0;
			    }

			    p .btn-danger{
			    	margin-top: -1pc;
			    	height: 40px auto;
			    }
			</style>
	<!-- End Import -->
</head>
<body>
	<div class="container-fluid">

		<!-- Header -->
		<div class="navbar navbar-default">
		    <div class="navbar-header"></div>
		</div>
		
		<div class="container">
			<div class="row">
				<!--<div class="col-md-6 col-md-push-6">
				col-md-5 col-md-push-7 -->
					
     			<!--</div>  end -col-md-5 col-md-push-7 -->

                <div class="col-md-8 col-md-push-2">
                <!--col-md-5 col-md-pull-5 -->
                	<div class="panel panel-primary">
                		<div class="panel-heading">
                			<h3 class="panel-title">Login From <span class="label label-success"><?php echo "$email / $userName"; ?></span><p align="right"><a href="logout.php" class="btn btn-danger">Logout</a></p>
                			</h3>
                		</div>
                		<form method="POST" action="">
                			<div class="panel-body">
	                			<div class="form-group">
			                		<label >From <sup style="color:blue;">*[harus diisi]</sup></label>
			                		<input type="text" disabled="" class="form-control" value="<?php echo $email ?>" placeholder="Your Email Name">
			                	</div>
			                	<div class="form-group">
			                		<label >Nama Penerima <sup style="color:blue;">*[harus diisi]</sup></label>
			                		<input type="text" name="nameRecipient" class="form-control" placeholder="Name Recipient">
			                	</div>
			                	<div class="form-group">
			                		<label >To <sup style="color:blue;">*[harus diisi]</sup></label>
			                		<input type="text" name="toForm" class="form-control" placeholder="To Mail Send">
			                	</div>
			                <!--	<div class="form-group">
			                		<label >Cc </label>
			                		<input type="text" class="form-control" placeholder="">
			                	</div>
			                	<div class="form-group">
			                		<label >Bcc </label>
			                		<input type="text" class="form-control" placeholder="">
			                	</div> -->
			                	<div class="form-group">
			                		<label >Subject <sup style="color:blue;">*[harus diisi]</sup></label>
			                		<input type="text" name="subject" class="form-control" placeholder="Subject Mail">
			                	</div>
			                	<div class="form-group">
			                		<label >Article</label>
			                		<textarea name="article" rows="8" cols="20" class="ckeditor">
									<script>
										CKEDITOR.replace('editor1', {
											skin: 'monocolor,/myskins/monocolor/'
										});
									</script>
								    </textarea>
		                	    </div>
		                	    <div class="form-group">
									<input type="submit" class="btn btn-primary" name="submit" value="Send Mail">
								</div>
           			        </div>
                		</form> <!-- end form-->
                	</div> <!-- end panel col-md-5 col-md-pull-5-->
                	<!-- begin validation -->

                	<?php 
                		if ($_POST) {
								$formMail      = $email;
								$nameRecipient = $_POST['nameRecipient'];
								$toForm        = $_POST['toForm'];
								$subject       = $_POST['subject'];
								$article       = $_POST['article'];
							
                	 ?>

                	 <?php if (empty($formMail) || empty($toForm) || empty($subject)): ?>
                   	                 	 
                		<!-- false validation -->
                		<div class="alert alert-dismissable alert-warning">
							    <button type="button" class="close" data-dismiss="alert">×</button>
							    <strong>Warning!</strong><p>Data Masih ada yang kosong</p>
						</div>
                		<!-- end false validation -->
                	<?php else: ?>
                		
                			<?php
									include('node_modules/phpmailer/PHPMailerAutoload.php');
									$mail = new PHPMailer();
									$mail->Host     = "ssl://smtp.gmail.com"; // SMTP server Gmail
									$mail->Mailer   = "smtp";
									$mail->SMTPAuth = true; // turn on SMTP authentication

									$mail->Username = $email;
									$mail->Password = $password; // SMTP password

									$webmaster_email = $toForm; //Reply to this email ID
									$email = $toForm; // Recipients email ID
									$name = $nameRecipient; // Recipient's name

									$mail->From = $webmaster_email;
									$mail->FromName = $userName;

									$mail->AddAddress($email,$name);
									$mail->AddReplyTo($webmaster_email,"namawebmaster");
									$mail->WordWrap = 50; // set word wrap

									//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
									//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
									$mail->IsHTML(true); // send as HTML

									$mail->Subject = $subject;
									$mail->Body = $article; 
									$mail->AltBody = $article;  
							?>
							<?php if (!$mail->Send()): ?>
								<div class="alert alert-dismissable alert-warning">
								    <button type="button" class="close" data-dismiss="alert">×</button>
								    <strong>Warning!</strong><p>Email gagal kirim <?php echo $mail->ErrorInfo; ?></p>
								</div>
							<?php else: ?>
								<div class="alert alert-dismissable alert-success">
								    <button type="button" class="close" data-dismiss="alert">×</button>
								    <strong>Well done!</strong> You successfully send Email to <?php echo "<h5>$email</h5>"; ?>
								</div>
							<?php endif ?>
									
                		<!-- true validation -->
                	 <!--   <div class="alert alert-dismissable alert-success">
						    <button type="button" class="close" data-dismiss="alert">×</button>
						    <strong>Well done!</strong> You successfully read
						</div> -->
						<!-- end true validation -->
					<?php endif ?>
				<?php } else { } ?>
					<!-- end validation -->
                </div> <!-- end col-md5 -->
			</div>
		</div>
	</div>
</body>
</html>