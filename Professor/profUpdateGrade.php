<?php
error_reporting();
 if (!session_id()) session_start();
     $userID = $_SESSION['userID'];
     $username = $_SESSION['username'];
     $course_id = $_SESSION['course_id'];
 $sn =$_GET['sn'];
 $si =$_GET['si'];
 $g =$_GET['g'];
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
<body style="text-align: center; justify-content: center; align-items: center;">
<div class="mui-container">
      <div class="mui-panel">
      <h1 style="text-align:center; padding-bottom:7%;">Online Registration University System</h1>
        <h2 style="text-align:center; padding-bottom:5%;">Update Grade</h2>
      <form class="mui-form" method="POST" action="#">
      <table class='mui-table mui-table--bordered'>
       <tr>
           <td>Student Name</td>
           <td><div name="sn"><?php echo $sn ?></div></td>
       </tr>
       <tr>
           <td>Student ID</td>
           <td><div name="si"><?php echo $si ?></div></td>
       </tr>
       <tr>
           <td>Grade</td>
           <td><input type="text" value="<?php echo $g ?>" name="g" required></td>
       </tr>
       <tr>
           <td colspan="2" align="center">
           <button style="font-size:100%;" type="submit" class="mui-btn mui-btn--primary mui-btn--raised">Update</button>
           </td>    
        </tr>
      </table>
      </form>
<?php

   if(isset($_POST['g'])){
    $g =$_POST['g'];
    if(is_numeric($g)){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "UPDATE student_has_course set grade = '".$g."' where student_id = '".$si."' and course_id ='".$course_id ."'";
    $result = mysqli_query($connect,$query);
    if($result){
        echo "<script>alert('Grade updated successfully')</script>";
        echo("<script>window.location = 'profHome.php';</script>");
       // header('Location:profHome.php');
    }
    else{
        echo "<script>alert('Failed to update')</script>";
    }
   }
   else{
       echo "<script>alert('Please Enter a valid grade')</script>";
   }
   }
     
     
?>
    
      </div>
    </div>
</body>
</html>

