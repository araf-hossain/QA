<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USER DASHBOARD</title>
    <!-- Bootstrap core CSS-->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <!--<link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion" style="margin-top: 0;">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="usr-img">
                <a class="nav-link" href="include.php?&page=profile">
                    <!--                  <i class="fa fa-user-circle"></i>-->
                    <img src="../../img/user_img/usr1.png" class="img-responsive" alt="" style="width: 100%;">
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Post questions">
                <a class="nav-link" href="include.php?&page=postQuestion">
                    <i class="fa fa-fw fa-pencil"></i>
                    <span class="nav-link-text text-capitalize">Post questions</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Answer to the questions">
                <a class="nav-link" href="include.php?&page=listOfAllQuestions">
                    <i class="fa fa-fw fa-reply-all"></i>
                    <span class="nav-link-text text-capitalize">Answer to the questions</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Modify/Delete questions">
                <a class="nav-link" href="include.php?&page=listOfAllQuestions">
                    <i class="fa fa-fw fa-pencil"></i>
                    <span class="nav-link-text text-capitalize">Modify/Delete questions</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="list of all users">
                <a href="include.php?&page=listOfUsers" class="nav-link">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text text-capitalize">list of all users</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
                    <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">New Alerts:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Question</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">20+ demo word
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems
                            are online.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="include.php?&page=viewAllNotification">View all notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0 mr-lg-2">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for...">
                        <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <!--<ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">My Dashboard</li>
        </ol>-->
        <!-- Icon Cards-->
        <!-- Example DataTables Card-->
        <?php
        $page=isset($_GET['page']) ? $_GET['page'] : 'error';
        switch ($page) {
            case 'listOfAllQuestions':
                include_once ("listOfAllQuestions.php");
                break;
            case 'listOfUsers':
                include_once ("listOfAllUsers.php");
                break;
            case 'viewAnswers':
                include_once ("viewAnswers.php");
                break;
            case 'postQuestion':
                include_once ("postQuestion.php");
                break;
            case 'editQuestion':
                include_once ("editQuestion.php");
                break;
            case 'answerToTheQuestion':
                include_once ("answerToTheQuestion.php");
                break;
            case 'error':
                include_once ("error.php");
                break;
        }
        ?>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Your Website 2018</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../js/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <!--<script src="vendor/chart.js/Chart.min.js"></script>-->
    <script src="../../js/jquery.dataTables.js"></script>
    <script src="../../js/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../../js/sb-admin-datatables.js"></script>
    <script src="../../js/sb-admin-charts.min.js"></script>
</div>
</body>

</html>
