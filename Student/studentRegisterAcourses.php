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
<div class="mui-container" style="margin:5%;">
      <div class="mui-panel">
<?php
if (!session_id()) session_start();
$stud_id = $_SESSION['userID'];
$username = $_SESSION['username'];
$dept_id = $_SESSION['dept_id'];
error_reporting(0);
include_once "../Course.php";
$courses = new course();
$CIDs =$courses->registered_courses($stud_id);
$arrOfCourses=$courses->available_courses($dept_id,$CIDs);
echo "<table class='mui-table mui-table--bordered'>
                    <thead>
                    <tr>
                   <th>Course ID</th>
                   <th>Course Name </th>
                   <th>Professor of the Course</th>
                   <th>Course Seats Number</th>
                   <th>Course Available Seats</th>
                   <th>Register Course</th>
                    </tr>
                    </thead>
                    <tbody>";
for($i=0;$i<sizeof($arrOfCourses);$i++){
    $id=$arrOfCourses[$i]->get_id();
    $name=$arrOfCourses[$i]->get_name();
    $prof=$arrOfCourses[$i]->get_profName();
    $NofS=$arrOfCourses[$i]->get_numOfSeats();
    $avSeats=$arrOfCourses[$i]->get_avSeats();
    echo "
    <tr>
      <td>$id</td>
      <td>$name</td>
      <td>$prof</td>
      <td>$NofS</td>
      <td>$avSeats</td>
      <td><button name='Register' class='mui-btn mui-btn--raised'><a href='studentRegisterCourse.php?si=$stud_id&ci=$id&cn=$name&pn=$prof'>Register</button></td>
      </tr>
       ";
   // echo $arrOfCourses[$i]->get_id().$arrOfCourses[$i]->get_name();
}
if(sizeof($arrOfCourses)==0){
    echo "<tr><h3>No Available Courses</h3></tr>";
}
echo "</tbody>
</table>";
?>
   </div>
    </div>  

</body>
</html>

