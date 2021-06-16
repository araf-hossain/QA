<?php
include_once("../../vendor/autoload.php");

use App\Questions\Questions;
use App\Users\Users;

$que = new Questions();
$usr = new Users();

$fetchAllQue = $que->getQue();

?>
<!doctype html>
<html lang="en">

<body>
<div class="container">
    <!--    <div class="col-lg-4">-->
    <!-- Example Notifications Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> List of all questions
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
        <?php
        $id = $user_id = $title = $description = $created = $updated = $status = $email = null;
        //        $email = isset($_SESSION['loginInfo']) ? $_SESSION['loginInfo'] : null;

        foreach ($fetchAllQue as $items => $item) {
            foreach ($item as $field => $value) {
                switch ($field) {
                    case 'id':
                        $id = $value;
                        break;
                    case 'user_id':
                        $email = $usr->viewUser('id,name,email','id',$value);
//                        echo "<pre>";
//                        print_r($email);
//die();
//                        $email = $user_id[0][]
//                        echo $title;
                        break;
                    case 'title':
                        $title = $value;
//                        echo $title;
                        break;
                    case 'description':
//                        $description = $que->readMoreFunction($value,'include.php?&page=viewAnswers&queId','page',$id);
//                        echo $title;
//                        $description = substr($value,0,5000)."<a href='include.php?&page=answerToTheQuestion'>Read more</a>";
//                        $description=$value;
                        $description = strip_tags($value);
//                        50 length of text limit change it
                        if (strlen($description) > 200) {

                            // truncate string
                            $stringCut = substr($description, 0, 200);

                            // make sure it ends in a word so assassinate doesn't become ass...
                            $description = substr($stringCut, 0, strrpos($stringCut, ' ')) . '<span class="text-info">... Read Mores</span>';
                        }
//                        echo $string;
                        break;
                    case 'created_at':
                        $createdDate = date_create($value);
                        $created = date_format($createdDate, 'g:ia \o\n l jS F Y');
//                        echo $title;
                        break;
                    case 'updated_at':
                        $updatedDate = date_create($value);
                        $updated = date_format($updatedDate, 'g:ia \o\n l jS F Y');
                        break;
                    case 'status':
                        $status = $value;
//                        echo $title;
                        break;
                }
            }


            ?>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action"
                   href="include.php?&page=viewAnswers&queId=<?php echo $id; ?>">
                    <div class="media">
                        <img class="align-self-start mr-3 img-thumbnail"
                             src="../../img/user_img/<?php echo $email[0]['email']; ?>.png"
                             style="width:10%" alt="">
                        <div class="media-body">
                            <h5 class="mt-0"><?php echo $title; ?></h5>
                            <?php echo $description; ?>
                            <div class="text-muted smaller"><?php echo $created ?></div>
                        </div>
                    </div>
                </a>

                    <form class="form-control" action="store.php?&page=listOfAllQuestions" method="post">
                        <ul class="list-inline mb-0 mt-1 ml-2">
                            <?php
                            if ($email[0]['email'] != $que->email()) {
                            ?>
                            <li class="list-inline-item ">
                                <a href="include.php?&page=answerToTheQuestion&queId=<?php echo $id; ?>"
                                   class="btn btn-outline-secondary p-sm-1"><i
                                            class="fa fa-fw fa-reply"></i>Answer</a>
                            </li>
                            <?php
                            }
                            else if ($email[0]['email'] === $que->email()) {
                            ?>
                            <li class="list-inline-item ">
                                <a href="include.php?&page=editQuestion&queId=<?php echo $id; ?>"
                                   class="btn btn-outline-secondary p-sm-1">
                                    <i class="fa fa-fw fa-pencil"></i>Edit</a>
                            </li>
                            <li class="list-inline-item ">
                                <a href="include.php?&page=deleteQue&delId=<?php echo $id; ?>" class="btn btn-outline-danger p-sm-1"><i
                                            class="fa fa-fw fa-bitbucket"></i>Delete</a>
                            </li>
                                <?php
                            }
                            ?>
                            <li class="list-inline-item float-right">
                                <a href="include.php?&queId=<?php echo $email[0]['id']; ?>" class="btn text-muted">By:
                                    <strong><?php echo $email[0]['name']; ?></strong></a>
                            </li>
                        </ul>
                    </form>

            </div>
            <?php
        }
        ?>
        <div class="card-footer">

        </div>
    </div>
    <!--    </div>-->
</div>
</body>
</html>