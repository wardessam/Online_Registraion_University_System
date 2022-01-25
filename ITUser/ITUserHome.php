<?php
 include_once "ITclass.php";
$ituser = new ituser();
//Open session to get user ID from previous page
if (!session_id()) session_start();
   $userID = $_SESSION['userID'];
   $ituser=ituser::getInfo($userID);
   $ituser->set_id($userID);
   $username =$ituser->get_name();

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
        <h2 style="text-align:center; padding-bottom:2%;">Hello IT <?php echo $username ?>!</h2>
<div class="mui-container-fluid">
<div class="mui-row">
<ul class="mui-tabs__bar mui-tabs__bar--justified">
<div class="mui-col-md-4">
  <li class="mui--is-active"><a data-mui-toggle="tab" data-mui-controls="pane-default-1">List of Students Who didn't Pay</a></li>
</div>
<div class="mui-col-md-4">
  <li><a data-mui-toggle="tab" data-mui-controls="pane-default-2">Student Details</a></li>
</div>
<div class="mui-col-md-4">
  <li><a data-mui-toggle="tab" data-mui-controls="pane-default-3">Professor Details</a></li>
</div>
</ul>
</div>

<div class="mui-tabs__pane mui--is-active" id="pane-default-1">
<?php include('IT_studentsDidntPay.php'); ?>
</div>
<div class="mui-tabs__pane" id="pane-default-2">
<?php include('IT_studentDetails.php'); ?>
</div>
<div class="mui-tabs__pane" id="pane-default-3">
<?php include('IT_profDetails.php'); ?>
</div>
 
    </div> 
 </div>
</div>
</body>
</html>
