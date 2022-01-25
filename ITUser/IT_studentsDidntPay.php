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
$it_id = $_SESSION['userID'];
$username = $_SESSION['username'];

include_once "../Student/studentClass.php";
$studs =student::listOfUnpaidStuds();
echo "<table class='mui-table mui-table--bordered'>
                    <thead>
                    <tr>
                   <th>Student ID</th>
                   <th>Student Name</th>
                   <th>Department ID</th>
                    </tr>
                    </thead>
                    <tbody>";
for($i=0;$i<sizeof($studs);$i++){
    $id=$studs[$i]->get_id();
    $name=$studs[$i]->get_name();
    $deptID=$studs[$i]->get_deptID();
    
    echo "
    <tr>
      <td>$id</td>
      <td>$name</td>
      <td>$deptID</td>
      </tr>
       ";
   
}
if(sizeof($studs)==0){
    echo "<tr><td><h3>There're No Students Who Didn't pay the tuition</h3></td></tr>";
}
echo "</tbody>
</table>";
?>
   </div>
    </div>  
</form>
</body>
</html>

