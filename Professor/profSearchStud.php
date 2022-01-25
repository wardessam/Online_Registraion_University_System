
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
<form style="justify-content: center; align-items: center;" class="mui-form--inline" method="post" action="#">
<div class="mui-textfield mui-textfield--float-label">
  <input type="search" name="search"  required/>
  <label>Enter the Student Name</label>
  </div>
  <button style="margin-left:5%" type="submit" class="mui-btn mui-btn--primary mui-btn--raised">Search</button>
</form>
<?php


    if (!session_id()) session_start();
    $userID = $_SESSION['userID'];
    $username = $_SESSION['username'];
    $course_id = $_SESSION['course_id'];
   

    if( isset($_POST['search'])){
        $sName = $_POST['search'];
        $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
        $query = "SELECT student.stud_name , student_has_course.student_id , student_has_course.grade , student_has_course.absense_times from student_has_course, student where student_has_course.student_id = student.stud_id and student_has_course.course_id ='".$course_id ."' and student.stud_name like '%".$sName."%' ";
        $result = mysqli_query($connect,$query);
        echo "<table class='mui-table mui-table--bordered'>
                    <thead>
                    <tr>
                   <th>Student Name</th>
                   <th>Student ID</th>
                   <th>Grade</th>
                   <th>Absense Times</th>
                   <th>Edit Grade</th>
                    </tr>
                    </thead>
                    <tbody>";
      
 while($row = mysqli_fetch_array($result)){
        $Studname=$row[0];
        $stud_id=$row[1];
        $grade=$row[2];
        $absensetimes=$row[3];
                    echo "
                    <tr>
                      <td>$Studname</td>
                      <td>$stud_id</td>
                      <td>$grade</td>
                      <td>$absensetimes</td>
                      <td><a href='profUpdateGrade.php?sn=$Studname&si=$stud_id&g=$grade'>Edit</td>
                      </tr>
                       ";
                 
    
        }
        
        if(mysqli_num_rows($result)==0){
          echo "<tr><td colspan='2'><h3>No Students Found</h3></td></tr>";
        }
        echo "</tbody>
        </table>";
        
     }
     
?>
    
      </div>
    </div>
</body>
</html>

