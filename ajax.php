<?php
    include 'koneksi.php';
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['fullname'])) {

        $id = substr(str_shuffle("0123456789"), 0, 5);


        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        
    if (empty('name') || empty($username) || empty($password)){
        echo "Please Fill Out The Form!";
        exit;
    }

    $user = mysqli_query($connect, "SELECT * FROM canvas WHERE username = '$username'");
    if(mysqli_num_rows($user) > 0){
        echo "username Has Already Taken";
        exit;
    }

    $Sql = 'INSERT into canvas (username,password,fullname) VALUES("'.$username.'","'.$password.'","'.$fullname.'")';
    if (mysqli_query($connect, $Sql)) {
        echo "successs";
    }
    }

    else if(isset($_POST['username']) && isset($_POST['password'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
        
        $Sql = "Select * from canvas where username ='$username' && password = '$password'";
        $res = mysqli_query($connect,$Sql);
        
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['id'] = $row['id'];
            
            $arr = array("status" => 'success', 'message' => 'Logged Successfully');
        }else if (empty('fullname') || empty($username) || empty($password)){
            $arr = array("status" => 'errors', 'message' => 'Fill out the form');
        } else {
            
            $arr = array("status" => 'error', 'message' => 'Password wrong');
        }
        echo  json_encode($arr);
	}