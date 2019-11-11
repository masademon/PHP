<?php
session_start();
class Database{
    public $con;
    public $error;

    public function __construct(){
        $this->con=mysqli_connect("localhost","root","root","db_login");
        if (!$this->con){
            echo"Database connection error",mysqli_connect_error($this->con);
        }
    }
    public function login($data){
        $username=$data["username"];
        $password=$data["password"];

        if($username=="" || $password==""){
            $msg="<span style='color:red;font-size:18px'>Field must not be empty</span>";
            return $msg; 
        }else{
            $query="SELECT*from tbl_user WHERE username='$username' AND password='$password'";
            $result=mysqli_query($this->con,$query);
            $row=mysqli_fetch_array($result);
            $user=$row["username"];
            $pass=$row["password"];

            if($username=$user && $password=$pass){
                $_SESSION['username']=$row["username"];
                $_SESSION['email']=$row["email"];
                $_SESSION['image']=$row["image"];
                header("location:index.php");
            }else{
                $msg="<span style='color:red;font-size:18px'>Username and password not matched!</span>";
            return $msg;
            }
        }
    }
}
?>