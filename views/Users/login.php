<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body class="login-bg">
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3" style="margin-top: 12%;">
            <form method="post" action="../../views/Users/store.php?&page=login" class="boxShadow create-form-bg">
                <h1 class="text-center">Login</h1>
                <hr style="height: 2px; background: #404040">
                <?php
                if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                    ?>
                    <span class="text-center text-success font-weight-bold"><?php echo $_SESSION['success']; ?></span>
                    <?php
                } else if (isset($_SESSION['err']) && !empty($_SESSION['err'])) {
                    foreach ($_SESSION['err'] as $value) {
                        ?>
                        <span class="text-center text-danger font-weight-bold">* <?php echo $value . '<br>'; ?></span>
                        <?php
                    }
                }
                session_unset();
                session_destroy();
                ?>
                <div class="form-group row">
                    <label for="email" class="col-4 col-form-label-lg text-center">Email</label>
                    <div class="col-8">
                        <input type="text" name="email" class="form-control" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-4 col-form-label-lg text-center">Password</label>
                    <div class="col-8">
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                </div>
                <div class="col-3 offset-9">
                    <button type="submit" class="btn btn-dark btn-lg">Submit</button>
                </div>
                <p class="text-center text-light mt-4 mb-0 bg-primary">If you don't have account <a href="create.php"
                                                                                                    class="btn btn-outline-light">Register</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>