<?php

$host= "localhost";
$user="root";
$password="";
$db = "RegistrationUniSys";

$dbhandle=mysqli_connect($host,$user,$password);
mysqli_select_db($dbhandle,$db);

if( isset($_POST['username'])){
  $username = $_POST['username'];
  $pass =$_POST['password'];
  $sql = "select *from Users where Username ='".$username."' and Password='".$pass."'";
  $result = mysqli_query($dbhandle,$sql);
  if(mysqli_num_rows($result)==1){
    $row = $result -> fetch_row();
    $userID=$row[0];
    session_start();
    $_SESSION['userID'] = $userID;
    if($row[3]==0){ 
        //IT User
    header('Location:ITUser/ITUserHome.php');
      exit();
    }
    else if($row[3]==1){
        //Professor
      header('Location:Professor/profHome.php');
      exit();
    }
    else{
        //Student
      header('Location:Student/studentHome.php');
      exit();

    }
    
  }
  else{
     echo '<script>alert("Please Enter a valid username or password!!")</script>'; ;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
     
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- load MUI -->
    <link href="//cdn.muicss.com/mui-0.10.3/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.10.3/js/mui.min.js"></script>
</head>
<body>
<div class="mui-container">
      <div class="mui-panel">
        <h1 style="text-align:center; padding-bottom:7%;">Online Registration University System</h1>
        <h2 style="text-align:center; padding-bottom:5%;">Login Page</h2>
<form class="mui-form" method="post" action="#">
<div class="mui-textfield mui-textfield--float-label">
  <input type="email" name="username"  required/>
  <label>Enter Your Username</label>
  </div>
  <div class="mui-textfield mui-textfield--float-label">
    <input type="password" name="password"  required/>
    <label>Enter Your Password</label>
  </div>
  <div style="text-align: center; justify-content: center; align-items: center; padding-top:7%">
  <button style="font-size:150%;" type="submit" class="mui-btn mui-btn--primary mui-btn--raised">Submit</button>
  </div>
</form>
      </div>
    </div>
</body>
</html>
