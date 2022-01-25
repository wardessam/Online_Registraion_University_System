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
<form class="mui-form" method="post" action="#">
<div class="mui-container" style="margin:5%;">
      <div class="mui-panel">
<?php
if (!session_id()) session_start();
$stud_id = $_SESSION['userID'];
$username = $_SESSION['username'];
$dept_id = $_SESSION['dept_id'];
$paid=$_SESSION['paid'];
if($paid=='N') $paid="No";
else $paid="Yes";
?>
 <table class='mui-table mui-table--bordered'>
       <tr>
           <td>Student Name</td>
           <td><div name="sn"><?php echo $username ?></div></td>
       </tr>
       <tr>
           <td>Student ID</td>
           <td><div name="si"><?php echo $stud_id ?></div></td>
       </tr>
       <tr>
           <td>Department ID</td>
           <td><div name="di"><?php echo $dept_id ?></div></td>
       </tr>
       <tr>
           <td>Paid Tuition</td>
           <td><div name="paid"><?php echo $paid ?></div></td>
       </tr>
      </table>
</div>
</div>
</form>
</body>
</html>

