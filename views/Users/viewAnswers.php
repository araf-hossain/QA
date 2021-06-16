<?php
include_once("../../vendor/autoload.php");

use App\Questions\Questions;
use \App\Users\Users;

$que = new Questions();
$usr = new Users();
$id = isset($_GET['queId']) ? $_GET['queId'] : null;

$viewData = $que->view($id);
/*echo "<pre>";
print_r($viewData);
die();*/
$viewUserData = $usr->viewUser('id,name,email', 'id', isset($viewData[1][0]['user_id']) ? $viewData[1][0]['user_id'] : null);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> Question Details & Answers
            <?php
            if (isset($_SESSION['err']) && !empty($_SESSION['err'])) {
                echo "<br>";
                foreach ($_SESSION['err'] as $msg) {
                    echo "<span class='text-danger'> * " . $msg . "</span><br>";
                }
                unset($_SESSION['err']);
            } else if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                echo "<span class='text-success font-weight-bold'>" . $_SESSION['success'] . "</span>";
                unset($_SESSION['success']);
            }
            ?>
        </div>
        <div class="list-group list-group-flush">
            <div class="media p-3">
                <img class="align-self-start mr-3 img-thumbnail"
                     src="../../img/user_img/<?php echo $viewUserData[0]['email']; ?>.png"
                     style="width:20%" alt="">

                <div class="media-body">
                    <h4 class="mt-0"><?php echo $viewData[1][0]['title']; ?></h4>
                    <?php echo $viewData[1][0]['description']; ?>
                    <div class="text-muted smaller"><?php echo $viewData[0]; ?></div>
                    <div class="mt-4">
                        <a href="include.php?&page=answerToTheQuestion&queId=<?php echo $id; ?>"
                           class="btn btn-outline-secondary p-sm-1 mb-3"><i
                                    class="fa fa-fw fa-reply"></i>Want To Answer</a>
                        <h3><strong>Answers Below</strong></h3>
                        <?php
                        $viewAns = $que->viewAns($id);
                        //                        echo '<pre>';
                        foreach ($viewAns as $items) {
//                            print_r($items);
                            $givenDate = date_create($items['given_at']);
                            $given = date_format($givenDate, 'g:ia \o\n l jS F Y');
                            $viewUserData = $usr->viewUser('id,name,email', 'id', $items['user_id']);

//                        die();
                            /*print_r($viewAns);
                            die();*/
                            ?>
                            <div class="media">
                                <img class="mr-3" src="../../img/user_img/<?php echo $viewUserData[0]['email']; ?>.png"
                                     width="4.8%">
                                <div class="media-body">
                                    <h5 class="mt-0"><?php echo $viewUserData[0]['name']; ?></h5>
                                    <div class="text-muted small mb-3"><?php echo $given; ?></div>
                                    <?php echo $items['answer'];
                                    if ($viewUserData[0]['email'] === $que->email()) {
                                    ?>
                                    <div class="sticky-footer">
<!--                                    <form action="store.php" method="post">-->
                                        <a class="text-danger mr-3"
                                           href="store.php?&page=deleteAns&queId=<?php echo $id; ?>&delId=<?php echo $items['id']; ?>">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                        <a class="text-info "
                                           href="include.php?&page=editQuestion&queId=<?php echo $id; ?>&ansId=<?php echo $items['id']; ?>">
                                            <i class="fa fa-trash-o"></i> Edit
                                        </a>
<!--                                    </form>-->
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">

        </div>
    </div>
    <!--    </div>-->
</div>
</body>
</html>