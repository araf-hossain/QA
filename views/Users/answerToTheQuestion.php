<?php
include_once ("../../vendor/autoload.php");
use App\Questions\Questions;
use \App\Users\Users;

$que = new Questions();
$usr = new Users();
$id = isset($_GET['queId']) ? $_GET['queId'] : null;
$viewData = $que->view($id);
$viewUserData = $usr->viewUser('name,email','id',isset($viewData[1][0]['user_id']) ? $viewData[1][0]['user_id'] : null);
//echo "<pre>";print_r($viewData);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
</head>
<body>
<div class="container">
    <!--    <div class="col-lg-4">-->
    <!-- Example Notifications Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> Answer to the question
        </div>
        <div class="list-group list-group-flush">
            <div class="media p-3">
                <img class="align-self-start mr-3 img-thumbnail" src="../../img/user_img/<?php echo $viewUserData[0]['email']; ?>.png"
                     style="width:20%" alt="">
                <div class="media-body">
                    <h4 class="mt-0"><?php echo $viewData[1][0]['title']?></h4>
                    <?php echo $viewData[1][0]['description']?>
                    <div class="text-muted smaller"><?php echo $viewData[0]?></div>
                    <div class="mt-2">
                        <form method="post" action="store.php?&page=answerToTheQuestion&queId=<?php echo $id;?>">
                            <div class="form-group">
                                <label for="exampleInputName"><strong>Answer to the question:</strong></label>
                                <textarea class="form-control" name="answer" rows="8">Enter the answer...</textarea>
                            </div>
                            <div class="form-group">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Submit Answer</button>
                        </form>
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