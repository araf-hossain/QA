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
    <!-- Page level plugin CSS-->
    <link href="../../css/dataTables.bootstrap4.css" rel="stylesheet">
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
                    <a class="dropdown-item small" href="#">View all alerts</a>
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
        <div class="row">
            <div class="col-xl-4 col-sm-4 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-question-circle"></i>
                        </div>
                        <div class="mr-5">26 New Questions!</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-reply"></i>
                        </div>
                        <div class="mr-5 text-capitalize">22 new answers!</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 mb-3">
                <div class="card text-white bg-dark o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-user"></i>
                        </div>
                        <div class="mr-5 text-capitalize">12 New users</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <!-- Card Columns Example Social Feed-->
                <div class="mb-0 mt-2">
                    <i class="fa fa-newspaper-o"></i> News Feed
                </div>
                <hr class="mt-2">
                <div class="card-columns">
                    <!-- Example Social Card-->
                    <div class="card mb-3">
                        <a href="#">
                            <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=610"
                                 alt="">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title mb-1"><a href="#">Question</a></h6>
                            <p class="card-text small">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda dolores dolorum
                                ducimus eius fuga id illo, ipsam iste molestiae, molestias nostrum qui, quibusdam quidem
                                ratione repellat sint voluptate voluptatum?
                            </p>
                        </div>
                        <hr class="my-0">
                        <div class="card-body py-2 large">
                            <a class="mr-4 d-inline-block" href="include.php?&page=viewAnswers">
                                <i class="fa fa-fw fa-comment"></i>Answers <span class="badge badge-success">20</span>
                            </a>
                            <a class="d-inline-block" href="#">
                                <i class="fa fa-fw fa-share"></i>Share</a>
                        </div>
                        <hr class="my-0">
                        <div class="card-footer small text-muted">Posted 32 mins ago</div>
                    </div>
                    <!-- Example Social Card-->
                </div>
                <!-- /Card Columns-->
            </div>
            <div class="col-lg-4">
                <!-- Example Notifications Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-bell-o"></i> Feed Example
                    </div>
                    <div class="list-group list-group-flush small">

                        <a class="list-group-item list-group-item-action" href="#">
                            <div class="media">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                                <div class="media-body">
                                    <i class="fa fa-user"></i>
                                    <strong>Monica Dennis</strong>forked the
                                    <strong>startbootstrap-sb-admin</strong>repository on
                                    <strong>GitHub</strong>.
                                    <div class="text-muted smaller">Today at 3:54 PM - 2hrs ago</div>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
                    </div>
                    <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
                </div>
            </div>
        </div>
        <!-- Example DataTables Card-->

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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
