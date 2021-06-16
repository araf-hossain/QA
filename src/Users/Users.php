<?php
/**
 * Created by PhpStorm.
 * User: noob
 * Date: 3/26/18
 * Time: 12:10 PM
 */

namespace App\Users;

use PDO;

class Users
{
    private $conn = null,$_passed = false;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=que_ans', 'root', '');
    }

    public function sessionEmail()
    {
        try {
            $checkEmail = isset($_SESSION['loginInfo']) ? $_SESSION['loginInfo'] : null;
            if (isset($checkEmail) && !empty($checkEmail)) {
                if (filter_var($checkEmail, FILTER_VALIDATE_EMAIL)) {
                    return [$this->_passed = true,$email = $checkEmail];
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
    public function passed() {
        $this->sessionEmail();
        return $this->_passed;
    }

    public function email() {
        $email = $this->sessionEmail();
        return $email[1];
    }

    public function create($data)
    {
        try {
            $firstName = $data['first'];
            $lastName = $data['last'];
            $username = $firstName . " " . $lastName;
            $email = $data['email'];
            $confirmPassword = $data['confirmPassword'];

            date_default_timezone_set('Asia/Dhaka');
            $createdTime = date('Y-m-d H:i:s');
            $updatedTime = date('Y-m-d H:i:s');

            $query = "INSERT INTO users(name,email,password,created_at,updated_at) VALUES (:usr,:email,:pass,:create_at,:updated_at)";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute(array(
                ':usr' => $username,
                ':email' => $email,
                ':pass' => $confirmPassword,
                ':create_at' => $createdTime,
                ':updated_at' => $updatedTime
            ));

            if ($result) {
                $_SESSION['success'] = "Successfully registered, Please Login!";
                header('location:login.php');
            }

        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function checkLogin($data)
    {
        try {
            $username = $data['email'];
            $password = $data['password'];
            if (filter_var($username,FILTER_VALIDATE_EMAIL)) {
                $query = "SELECT email,password FROM users WHERE email = '{$username}'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                $fetchData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($fetchData as $items) {
                    foreach ($items as $item => $value) {
                        switch ($item) {
                            case 'password':
                                if ($value === $password) {
                                    $_SESSION['loginInfo'] = $username;
                                    header("location: dashboard.php");
                                } else {
                                    $_SESSION['err'] = ["Password is not matching with DB password"];
                                    header("location: login.php");
                                }
                                break;
                        }
                    }
                }
            } else {
                $_SESSION['err'] = ["Please, enter valid email address!"];
                header("location: login.php");
            }

        } catch (\PDOException $e) {
            die("Errors: " . $e->getMessage());
        }
    }

    private function action($selectColumn,$table,$column,$id)
    {
        if($this->passed()) {
            $query = "SELECT {$selectColumn} FROM {$table} WHERE {$column} = '{$id}'";
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

    public function viewUser($selectColumns,$column,$id) {
        $fetchData = $this->action($selectColumns,'users',$column, $id);
//        print_r($fetchData);
//        die();
        return $fetchData;
    }


}