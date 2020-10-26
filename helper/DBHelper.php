<?php

class DBHelper
{
    /* Singleton Design Pattern */
    private $con;
    private static $instance = null;

    private function __construct()
    {
        $this->con = mysqli_connect("localhost", "root", "", "leaders_pro_db");
        if (!$this->con) {
            die("Can't Connect To Server");
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DBHelper();
        }
        return self::$instance;
    }

    public function login($email, $password)
    {
        $query = "select * from user where email='" . $email . "' AND password='" . $password . "'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }

    public function register($fullName, $birth, $email, $password)
    {
        $query = "INSERT INTO user( `full_name`, `birth_date`, `email`, `password`) VALUES ('$fullName','$birth','$email','$password')";
        return mysqli_query($this->con, $query);
    }

    public function getTasksByUserId($id)
    {
        $query = "SELECT * FROM `user_task` WHERE `user_id` = '$id'";
        return mysqli_query($this->con, $query);
    }

    public function deleteTask($id)
    {
        $query = "DELETE FROM `user_task` WHERE `id` = '$id'";
        return mysqli_query($this->con, $query);
    }

    public function findTask($id)
    {
        $query = "SELECT * FROM `user_task` WHERE `id` = '$id'";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_assoc($result);
    }

    public function updateTask($id, $task)
    {
        $query = "UPDATE `user_task` SET `task`='$task' WHERE `id`=$id";
        return mysqli_query($this->con, $query);
    }

    public function addTask($task, $userId)
    {
        $query = "INSERT INTO `user_task`( `task`, `user_id`) VALUES ('$task',$userId)";
        return mysqli_query($this->con, $query);
    }

    public function updateUser($id, $fullName, $birth, $email, $password)
    {
        if ($password != null) {
            $query = "UPDATE `user` SET `full_name`='$fullName' SET `birth_date`='$birth' SET `email`='$email' WHERE `id`=$id";
        } else {
            $query = "UPDATE `user` SET `full_name`='$fullName' SET `birth_date`='$birth' SET `email`='$email' SET `password`='$password' WHERE `id`=$id";
        }
        return mysqli_query($this->con, $query);
    }

}