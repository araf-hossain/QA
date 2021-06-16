<?php

include_once ('../../vendor/autoload.php');
use \App\Questions\Questions;
$que = new Questions();
$que->checkLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
</head>

<body class="bg-dark">
<div class="container">
    <?php

    if (isset($_SESSION['err']) && !empty($_SESSION['err']))
    {
        foreach ($_SESSION['err'] as $msg) {
            echo "<span class='text-danger'> * ".$msg."</span><br>";
        }
        unset($_SESSION['err']);
    } else if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
        echo "<span class='text-success'>".$_SESSION['success']."</span>";
        unset($_SESSION['success']);
    }
    ?>
    <div class="card card-register mx-auto mt-4 mb-5">
        <div class="card-header">Post Questions</div>
        <div class="card-body">
            <form method="post" action="store.php?&page=postQuestion">
                <div class="form-group">
                    <label for="exampleInputName">Title</label>
                    <input class="form-control" name="title" id="exampleInputName" type="text" aria-describedby="nameHelp"
                           placeholder="Enter title">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="description" rows="8">Enter your question details in here....... </textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit Question</button>
            </form>
        </div>
    </div>
</div>
</body>

</html>
