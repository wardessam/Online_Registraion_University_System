<?php
error_reporting();
 if (!session_id()) session_start();
     $userID = $_SESSION['userID'];
     $username = $_SESSION['username'];
 
 $stud_i =$_GET['si'];
 $cour_id =$_GET['ci'];
 $cour_name=$_GET['cn'];
 $prof=$_GET['pn'];
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
        <h2 style="text-align:center; padding-bottom:5%;">Are You Sure You want to register in <?php echo $cour_name ?>?</h2>
      <form class="mui-form" method="POST" action="#">
      <table class='mui-table mui-table--bordered'>
       <tr>
           <td>Course ID</td>
           <td><div name="ci"><?php echo $cour_id ?></div></td>
       </tr>
       <tr>
           <td>Course Name</td>
           <td><div name="cn"><?php echo $cour_name ?></div></td>
       </tr>
       <tr>
           <td>Professor of the course</td>
           <td><div name="pi"><?php echo $prof ?></div></td>
       </tr>
       <tr>
           <td colspan="2" align="center">
           <input name="submit" style="font-size:100%;" type="submit" class="mui-btn mui-btn--primary mui-btn--raised"></input>
           </td>    
        </tr>
      </table>
      </form>
<?php
   error_reporting(0);
   include_once "../course.php";
   if(isset($_POST['submit'])){
    $result1=course::register_course($cour_id,$stud_i);
    $result2=course::minus_avSeats($cour_id);
    if($result1&&$result2){
        echo "<script>alert('Course Registered successfully')</script>";
        echo("<script>window.location = 'studentHome.php';</script>");
    }
    else{
        echo "<script>alert('Failed to register course')</script>";
    }
   }
 
   
     
     
?>
    
      </div>
    </div>
</body>
</html>

