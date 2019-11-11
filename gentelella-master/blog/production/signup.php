<?php
session_start();
class getFormAction{
    public $pdo;

    public function __construct(){
        try{
            $this->pdo=new PDO(PDO_DSN, DATABASE_USER, DATABASE_PASSWORD);
        }catch(PDOException $e){
            echo 'error' . $e->getMessage();
            die();
        }
    }
    public function signup($data){
        $username=$data["username"];
        $email=$data["email"];
        $password=$data["password"];

        $query="SELECT*from tbl_user WHERE username='$username' AND password='$password'";
            
        $result=mysqli_query($this->con,$query);
        $row=mysqli_fetch_array($result);
        $user=$row["username"];
        $pass=$row["password"];
            
        if($username=$user && $password=$pass){
            $_SESSION['username']=$row["username"];
            $_SESSION['email']=$row["email"];
            $msg="<span style='color:red;font-size:18px'>Username and password was already registered!</span>";
        return $msg;

        else:
            if($username=="" || $password==""){
                $msg="<span style='color:red;font-size:18px'>Field must not be empty</span>";
                return $msg; 
            }else{
                $smt = $this->pdo->prepare('insert into post (username,password,email) values(:username,:password,:email');
                $smt->bindParam(':username',$data['username'], PDO::PARAM_STR);
                $smt->bindParam(':password',$data['password'], PDO::PARAM_STR);
                $smt->bindParam(':email',$data['email'], PDO::PARAM_STR);
                $smt->execute();
            
                header(location:"login.php");
        }
    }
}
?>