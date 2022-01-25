<?php
 include_once "studentClass.php";
 $student= new student();
//Open session to get user ID from previous page
   session_start(); 
   $userID=$_SESSION['userID'];
   $student=student::studentInfo($userID);
   $student->set_id($userID);
   $username =$student->get_name();
   $dept_id = $student->get_deptID();
   $paid = $student->get_paid_tuition();
   $_SESSION['username'] = $username;
     $_SESSION['dept_id'] = $dept_id;
    $_SESSION['paid'] = $paid;
       
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
        <h1 style="text-align:center; padding-bottom:5%;">Online Registration University System</h1>
        <h2 style="text-align:center; padding-bottom:2%;">Hello Student <?php echo $username ?>!</h2>
<div class="mui-container-fluid">
<div class="mui-row">
<ul class="mui-tabs__bar mui-tabs__bar--justified">
<div class="mui-col-md-3">
  <li class="mui--is-active"><a data-mui-toggle="tab" data-mui-controls="pane-default-1">Your Info</a></li>
</div>
<div class="mui-col-md-3">
  <li><a data-mui-toggle="tab" data-mui-controls="pane-default-2">Register In Available Courses</a></li>
</div>
<div class="mui-col-md-3">
  <li><a data-mui-toggle="tab" data-mui-controls="pane-default-3">Show Absense Times</a></li>
</div>
<div class="mui-col-md-3">
  <li><a data-mui-toggle="tab" data-mui-controls="pane-default-4">Show Available Courses</a></li>
</div>
</ul>
</div>

<div class="mui-tabs__pane mui--is-active" id="pane-default-1">
<?php include('studentInfo.php'); ?>
</div>
<div class="mui-tabs__pane" id="pane-default-2">
<?php include('studentRegisterAcourses.php'); ?>
</div>
<div class="mui-tabs__pane" id="pane-default-3">
<?php include('studentShowAbsenseTimes.php'); ?>
</div>
<div class="mui-tabs__pane" id="pane-default-4">
<?php include('studentShowAcourses.php'); ?>
</div>
 
    </div> 
 </div>
</div>
</body>
</html>
