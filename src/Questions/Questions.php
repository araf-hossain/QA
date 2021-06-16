<?php
/**
 * Created by PhpStorm.
 * User: noob
 * Date: 3/26/18
 * Time: 12:10 PM
 */

namespace App\Questions;

use PDO;

class Questions
{
    private $conn = null, $_passed = false;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=que_ans', 'root', '');
    }

    public function insertQue($data)
    {
        try {
            if ($this->passed()) {
                $title = $data['title'];
                $description = $data['description'];

                date_default_timezone_set('Asia/Dhaka');
                $createdTime = date('Y-m-d H:i:s');
                $updatedTime = date('Y-m-d H:i:s');
                $slctUserID = "SELECT id FROM users WHERE email ='{$this->email()}'";
                $stmt = $this->conn->prepare($slctUserID);
                $stmt->execute();
                $fetchData = $stmt->fetch(PDO::FETCH_ASSOC);

                $query = "INSERT INTO post_que(user_id,title,description,created_at,updated_at) VALUES (:usr_id,:title,:des,:create_at,:updated_at)";
                $stmt = $this->conn->prepare($query);
                $result = $stmt->execute(array(
                    ':usr_id' => $fetchData['id'],
                    ':title' => $title,
                    ':des' => $description,
                    ':create_at' => $createdTime,
                    ':updated_at' => $updatedTime
                ));

                if ($result) {
                    $_SESSION['success'] = "New question has been posted";
                    header("location: include.php?&page=postQuestion");
                }
            } else {
                $_SESSION['err'] = ['You are not logged in! or This is not valid email address'];

                echo "<script type='text/javascript'>document.location.href='login.php';</script>";
            }
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function passed()
    {
        $this->checkLogin();
        return $this->_passed;
    }

    public function checkLogin()
    {
        try {
            $checkEmail = isset($_SESSION['loginInfo']) ? $_SESSION['loginInfo'] : null;
            if (isset($checkEmail) && !empty($checkEmail)) {
                if (filter_var($checkEmail, FILTER_VALIDATE_EMAIL)) {
                    return [$this->_passed = true, $email = $checkEmail];
                } else {
                    $_SESSION['err'] = ['This is not valid email address'];
//                    using both redirect option for if javascript disable in browser meta tag will redirect the page
                    echo "<script type='text/javascript'>document.location.href='login.php';</script>";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=login.php">';
                }
            } else {
                $_SESSION['err'] = ['You are not logged in! Please Login.'];
//                print_r($_SESSION['err']);
//                die();
                echo "<script type='text/javascript'>document.location.href='login.php';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=login.php">';
            }
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function email()
    {
        $email = $this->checkLogin();
        return $email[1];
    }

    public function getQue()
    {
        try {
            if ($this->passed()) {
                $slctQue = "SELECT * FROM post_que";
                $stmt = $this->conn->prepare($slctQue);
                $stmt->execute();
                $fetchAllQue = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $fetchAllQue;

            } else {
                $_SESSION['err'] = ['You are not logged in! or This is not valid email address'];
                echo "<script type='text/javascript'>document.location.href='login.php';</script>";

            }


        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function view($id)
    {
        $viewQue = $this->action('user_id,title,description,created_at', 'post_que', 'id', $id);

        $createdDate = date_create(isset($viewQue[0]['created_at']) ? $viewQue[0]['created_at'] : null);
        $created = date_format($createdDate, 'g:ia \o\n l jS F Y');

        return [$created, $viewQue];
    }

    private function action($selectColumn, $table, $column, $id)
    {
        if ($this->passed()) {
            $query = "SELECT {$selectColumn} FROM {$table} WHERE {$column} = '{$id}' AND status = 1";
            $stmt = $this->conn->prepare($query);
//            print_r($stmt);
            $stmt->execute();
            $fetchData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchData;
        } else {
            $_SESSION['err'] = ['You are not logged in! or This is not valid email address'];
            echo "<script type='text/javascript'>document.location.href='login.php';</script>";
        }
    }

    public function ansQue($userEmail, $queId, $answer)
    {
        try {
            if ($this->passed()) {
                $answer = $answer['answer'];

                date_default_timezone_set('Asia/Dhaka');
                $givenTime = date('Y-m-d H:i:s');
                $updatedTime = date('Y-m-d H:i:s');
                $slctUserID = "SELECT id FROM users WHERE email ='{$userEmail}'";
                $stmt = $this->conn->prepare($slctUserID);
                $stmt->execute();
                $fetchData = $stmt->fetch(PDO::FETCH_ASSOC);

                $query = "INSERT INTO ans_que(user_id,que_id,answer,given_at,updated_at) VALUES (:usr_id,:queID,:answer,:given_at,:updated_at)";
                $stmt = $this->conn->prepare($query);
                $result = $stmt->execute(array(
                    ':usr_id' => $fetchData['id'],
                    ':queID' => $queId,
                    ':answer' => $answer,
                    ':given_at' => $givenTime,
                    ':updated_at' => $updatedTime
                ));

                if ($result) {
                    $_SESSION['success'] = "Submitted you answer";
                    header("location: include.php?&page=viewAnswers&queId=$queId");
                }
            } else {
                $_SESSION['err'] = ['You are not logged in! or This is not valid email address'];
                echo "<script type='text/javascript'>document.location.href='login.php';</script>";
            }
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function viewAns($id)
    {
        try {
            $data = $this->action('id,user_id,answer,given_at', 'ans_que', 'que_id', $id);
            return $data;
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function edit($table,$id,$data)
    {
        date_default_timezone_set('Asia/Dhaka');
        $updatedTime = date('Y-m-d H:i:s');
        $updateQuery=null;
        if ($table == 'ans_que') {
            $updateQuery = "UPDATE {$table} SET answer='{$data['answer']}',updated_at='{$updatedTime}' WHERE id = '{$id}'";
        } else if ($table == 'post_que') {
            $updateQuery = "UPDATE {$table} SET title='{$data['title']}',description='{$data['description']}',updated_at='{$updatedTime}' WHERE id = '{$id}'";
        }
        $stmt = $this->conn->prepare($updateQuery);
        $result = $stmt->execute();
        if ($result) {
            $_SESSION['success'] = 'Updated Successfully';
            echo "<script type='text/javascript'>document.location.href='include.php?&page=listOfAllQuestions';</script>";
        }
    }

    public function delete($table, $delId, $queId)
    {
        try {
            date_default_timezone_set('Asia/Dhaka');
            $deletedTime = date('Y-m-d H:i:s');
            $delQuery = "UPDATE {$table} SET que_ans.ans_que.status = 0, que_ans.ans_que.deleted_at = '{$deletedTime}' WHERE que_ans.ans_que.id = '{$delId}'";
            $stmt = $this->conn->prepare($delQuery);
            $result = $stmt->execute();
            if ($result) {
                $_SESSION['success'] = 'Deleted Successfully';
                echo "<script type='text/javascript'>document.location.href='include.php?&page=viewAnswers&queId=$queId';</script>";
            }
        } catch (\PDOException $e) {
            die("ERROR: ".$e->getMessage());
        }
//        header();
    }


}