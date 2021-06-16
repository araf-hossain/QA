<?php
include_once("../../vendor/autoload.php");

use App\Questions\Questions;
use \App\Users\Users;

$que = new Questions();
$usr = new Users();

$queId = isset($_GET['queId']) ? $_GET['queId'] : null;
$ansId = isset($_GET['ansId']) ? $_GET['ansId'] : null;


//print_r($fetchQue);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
</head>
<body>
<div class="container">
    <div class="card card-register mx-auto mt-4 mb-5">
        <div class="card-header">Edit In Here</div>
        <div class="card-body">
            <?php
            if ((isset($queId) && !empty($queId) && (!isset($ansId) && empty($ansId)))) {
                $fetchQue = $que->view($queId);
                ?>
                <form method="post" action="store.php?&page=edit&queId=<?php echo $queId;?>">
                    <div class="form-group">
                        <label for="exampleInputName">Edit Title</label>
                        <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp"
                               placeholder="Enter update title in here" name="title" value="<?php echo $fetchQue[1][0]['title'] ?>">
                    </div>
                    <div class="form-group">
                        <textarea rows="8" name="description"><?php echo $fetchQue[1][0]['description'] ?></textarea>
                    </div>
                    <button class="btn btn-outline-primary">Edit Question</button>
                </form>
                <?php
            } else if ((isset($ansId) && !empty($ansId)) && (isset($queId) && !empty($queId))) {
                $fetchAns = $que->viewAns($queId);
                ?>
                <form method="post" action="store.php?&page=edit&queId=<?php echo $queId; ?>&ansId=<?php echo $ansId?>">
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <textarea rows="8" name="answer"><?php echo $fetchAns[0]['answer']; ?></textarea>
                    </div>
                    <button class="btn btn-outline-primary">Edit Answer</button>
                </form>
                <?php
            }
            ?>
        </div>
        <div class="col-5 mb-3">
        </div>
    </div>
</div>
</body>
</html>
