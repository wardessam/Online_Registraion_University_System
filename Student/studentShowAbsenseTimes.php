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
error_reporting(0);
include_once "../Course.php";
$courses = new Course();
$arrOfCourses =$courses->infoAboutRegistered_courses($stud_id);
echo "<table class='mui-table mui-table--bordered'>
                    <thead>
                    <tr>
                   <th>Course Name </th>
                   <th>Grade</th>
                   <th>Absense Times</th>
                    </tr>
                    </thead>
                    <tbody>";
for($i=0;$i<sizeof($arrOfCourses);$i++){
    $name=$arrOfCourses[$i]->get_name();
    if($arrOfCourses[$i]->get_grade()==NULL){
        $grade="Not Set Yet";
    }
    else{
    $grade=$arrOfCourses[$i]->get_grade();
    }
    $absense=$arrOfCourses[$i]->get_absense();
    echo "
    <tr>
      <td>$name</td>
      <td>$grade</td>
      <td>$absense</td>
      </tr>
       ";
   // echo $arrOfCourses[$i]->get_id().$arrOfCourses[$i]->get_name();
}
if(sizeof($arrOfCourses)==0){
    echo "<tr><h3>You have no Registered Courses</h3></tr>";
}
echo "</tbody>
</table>";
?>
   </div>
    </div>  
</form>
</body>
</html>

