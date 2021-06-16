<?php
include_once ("../../vendor/autoload.php");

session_start();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create User</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body class="create-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-6" style="margin-top: 10%;">
				<form  method="post" action="../../views/Users/store.php?&page=create" class="boxShadow create-form-bg">
					<h1 class="text-center">Sign Up</h1>
					<hr style="height: 2px; background: #404040">
					<div class="form-group row">
						<label for="first" class="col-2 col-form-label-lg">Name</label>
						<div class="col-5">
							<input type="text" name="first" class="form-control" placeholder="First Name">
						</div>
						<div class="col-5">
							<input type="text" name="last" class="form-control" placeholder="Last Name">
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-2 col-form-label">Email</label>
						<div class="col-10">
							<input type="text" name="email" class="form-control" placeholder="Enter email">
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-2 col-form-label">Password</label>
						<div class="col-5">
							<input type="password" name="password" class="form-control" placeholder="Enter password">
						</div>
						<div class="col-5">
							<input type="password" name="confirmPassword" class="form-control" placeholder="Confirm password">
						</div>
					</div>
					<div class="col-4 offset-lg-4 ">
						<button type="submit" class="pl-lg-5 pr-lg-5 text-light btn btn-info">Submit</button>
					</div>
                    <p class="text-center text-light mt-4 mb-0 bg-primary">If you have an account <a href="login.php" class="btn btn-outline-light">Login</a></p>
				</form>
			</div>
            <div class="col-md-6 pl-lg-4 mt-auto">
                <?php
                if (isset($_SESSION['err'])) {
                    foreach ($_SESSION['err'] as $error) {
                ?>
                        <span class="text-left pl-lg-4 h5" style="color: #ff3a3a;"><b>* <?php echo $error;?></b></span><br>
                <?php
                    }
                }
                session_unset();
                session_destroy();
                ?>
            </div>
		</div>
	</div>
	
</body>
</html>
