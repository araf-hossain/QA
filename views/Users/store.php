<?php
include_once ("../../vendor/autoload.php");
use App\Users\Users;
use App\Validation\Validation;
use App\Questions\Questions;

if (isset($_POST)) {
    session_start();
    $users = new Users();
    $qa = new Questions();
    $validation = new Validation();
    $queId = isset($_GET['queId']) ? $_GET['queId'] : null;

    $page = $_GET['page'];
    switch ($page) {
        case 'create':
            $validation = $validation->checking($_POST,array(
                'first' => array(
                    'required' => true,
                    'min' =>2,
                    'max' => 255
                ),
                'last' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 255
                ),
                'email' => array(
                    'required' => true,
                    'min' => 6,
                    'max' => 255,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 4
                ),
                'confirmPassword' => array(
                    'required' => true,
                    'matches' => 'password'
                )
            ));

            if ($validation->passed()) {
                $users->create($_POST);
            } else {
                $_SESSION['err'] = $validation->errors();
                header("location: create.php");
            }
            break;
        case 'login':
            $validation = $validation->checking($_POST,array(
                'email' => array(
                    'required' => true,
                    'min' => 6,
                    'max' => 255
                ),
                'password' => array(
                    'required' => true,
                    'min' => 4
                )
            ));

            if ($validation->passed()) {
                $users->checkLogin($_POST);
            } else {
                $_SESSION['err'] = $validation->errors();
                echo "<script type='text/javascript'>document.location.href='login.php';</script>";

            }
            break;
        case 'postQuestion':
            $validation = $validation->checking($_POST, [
                'title' => [
                    'required' => true,
                    'W_min' => 5,
                    'W_max' => 50
                ],
                'description' => [
                    'required' => true,
                    'W_min' => 10,
                    'W_max' => 20000
                ]
            ]);

            if ($validation->passed()) {
                $qa->insertQue($_POST);
            } else {
                $_SESSION['err'] = $validation->errors();
                echo "<script type='text/javascript'>document.location.href='include.php?&page=postQuestion';</script>";

            }
            break;
        case 'answerToTheQuestion':
            $validation = $validation->checking($_POST,[
                'answer' => [
                    'required' => true,
                    'W_min' => 5,
                    'W_max' => 20000
                ]
            ]);
            if ($validation->passed()) {
                $email = $qa->email();
                $qa->ansQue($email,$queId,$_POST);
            } else {
                $_SESSION['err'] = $validation->errors();
                echo "<script type='text/javascript'>document.location.href='include.php?&page=answerToTheQuestion&queId={$queId}';</script>";
            }

            break;
        case 'deleteQue':
            $delId = isset($_GET['delId']) ? $_GET['delId'] : null;
            if (isset($delId) && !empty($delId)) {
                $qa->delete('post_que',$delId,$queId);
            }
            break;
        case 'edit':
            $ansId = isset($_GET['ansId']) ? $_GET['ansId'] : null;

            if ((isset($queId) && !empty($queId) && (!isset($ansId) && empty($ansId))) ) {

                $validation = $validation->checking($_POST, [
                    'title' => [
                        'required' => true,
                        'W_min' => 5,
                        'W_max' => 50
                    ],
                    'description' => [
                        'required' => true,
                        'W_min' => 10,
                        'W_max' => 20000
                    ]
                ]);
                if ($validation->passed()) {
                    $qa->edit('post_que',$queId,$_POST);
                } else {
                    $_SESSION['err'] = $validation->errors();
                    echo "<script type='text/javascript'>document.location.href='include.php?&page=editQuestion&queId={$queId}';</script>";
                }
            } else if ((isset($ansId) && !empty($ansId)) && (isset($queId) && !empty($queId))) {
                $validation = $validation->checking($_POST,[
                    'answer' => [
                        'required' => true,
                        'W_min' => 5,
                        'W_max' => 20000
                    ]
                ]);
                if ($validation->passed()) {
                    $qa->edit('ans_que', $ansId, $_POST);
                } else {
                    $_SESSION['err'] = $validation->errors();
                    echo "<script type='text/javascript'>document.location.href='include.php?&page=editQuestion&queId={$queId}&ansId={$ansId}';</script>";
                }
            }

                break;
        case 'deleteAns':
            $delId = isset($_GET['delId']) ? $_GET['delId'] : null;
            if (isset($delId) && !empty($delId)) {
                $qa->delete('ans_que',$delId,$queId);
            }
            break;


    }

} else {
    $_SESSION['msg']= "Something went wrong";
    echo "<script type='text/javascript'>document.location.href='login.php';</script>";
}

?>