<?php
/**
 * Created by PhpStorm.
 * User: noob
 * Date: 3/30/18
 * Time: 8:47 PM
 */

namespace App\Validation;

use PDO;
class Validation
{
    private $_passed = false, $_errors = array(), $conn = null;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=que_ans', 'root', '');
    }

    public function checking($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = $this->test_input(isset($source[$item]) ? $source[$item] : 'SORRY');

                if ($rule === 'required' && empty($value)) {
                    if ($item === 'first') {
                        $field = "First Name";
                    } else if ($item === 'last') {
                        $field = "Last Name";
                    } else if ($item === 'email') {
                        $field = "Email";
                    } else if ($item === 'password') {
                        $field = "Password";
                    } else if ($item === 'confirmPassword') {
                        $field = "Confirm Password";
                    } else if ($item === 'title') {
                        $field = 'Title';
                    } else if ($item === 'description') {
                        $field = 'Description';
                    } else {
                        $field = "<p style='color:red'>PROBLEM</p>";
                    }
                    $this->addError("{$field} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                if ($item === 'first') {
                                    $field = "First Name";
                                } else if ($item === 'last') {
                                    $field = "Last Name";
                                } else if ($item === 'email') {
                                    $field = "Email";
                                } else if ($item === 'password') {
                                    $field = "Password";
                                } else if ($item === 'confirmPassword') {
                                    $field = "Confirm Password";
                                } else {
                                    $field = "<p style='color:red'>PROBLEM</p>";
                                }
                                $this->addError("{$field} must be minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if ($item === 'first') {
                                $field = "First Name";
                            } else if ($item === 'last') {
                                $field = "Last Name";
                            } else if ($item === 'email') {
                                $field = "Email";
                            } else if ($item === 'password') {
                                $field = "Password";
                            } else if ($item === 'confirmPassword') {
                                $field = "Confirm Password";
                            } else {
                                $field = "<p style='color:red'>PROBLEM</p>";
                            }
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$field} must not be maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("Password must match with Confirm Password");
                            }
                            break;
                        case 'unique':
                            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $query = $this->conn->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = '{$value}'
");
                                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                                if (count($data) > 0) {
                                    $this->addError("This email is already exists");
                                }
                            } else {
                                $this->addError("Please, enter valid email address!");
                            }
                            break;
                        case 'W_min':
                            if (str_word_count($value) < $rule_value) {
                                if ($item === 'title') {
                                    $field = "Title";
                                } else if ($item === 'description') {
                                    $field = "Description";
                                } else {
                                    $field = "<p style='color:red'>PROBLEM</p>";
                                }
                                $this->addError("{$field} must be minimum of {$rule_value} words!");
                            }
                            break;
                        case 'W_max':
                            if (str_word_count($value) > $rule_value) {
                                if ($item === 'title') {
                                    $field = "Title";
                                } else if ($item === 'description') {
                                    $field = "Description";
                                } else {
                                    $field = "<p style='color:red'>PROBLEM</p>";
                                }
                                $this->addError("{$field} must not be maximum of {$rule_value} words!");
                            }
                            break;
/*                        case 'qd_min':
                            break;
                        case 'qd_max':
                            break;*/
                    }
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    public function test_input($data)
    {
        $data = trim(isset($data) ? $data : 'Wrong');
        $data = stripslashes(isset($data) ? $data : 'Wrong');
        $data = htmlspecialchars(isset($data) ? $data : 'Wrong');
        return $data;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}