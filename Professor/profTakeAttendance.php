
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
<div class="mui-textfield" style="margin-top:10%">
  <input type="date" name="date"  required/>
  <label>Date for Lesson</label>
  </div>
<div class="mui-container" style="margin:5%;">
      <div class="mui-panel">
<?php
    if (!session_id()) session_start();
    $userID = $_SESSION['userID'];
    $username = $_SESSION['username'];
    $course_id = $_SESSION['course_id'];
// check if the 'Student' folder exists in the current directory
// while it doesn't exist in the current directory, move current 
// directory up one level.
//
// This while loop will keep moving up the directory tree until the
// current directory contains the 'Student' folder.
//
    while (! file_exists('Student') )
    chdir('..');

    include_once "Student/studentClass.php";

// ...
    while (! file_exists('Online_Registraion_University_System') )
    chdir('..');

    include_once "Online_Registraion_University_System/Course.php";
    $arrStuds=[];
    $arrc=[];
    $c=0;
    $student = new student();
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "SELECT student.stud_name , student_has_course.student_id,student_has_course.absense_times from student_has_course, student where student_has_course.student_id = student.stud_id and student_has_course.course_id ='".$course_id ."'";
    $result = mysqli_query($connect,$query);
        echo "<table class='mui-table mui-table--bordered'>
                    <thead>
                    <tr>
                   <th>Student Name</th>
                   <th>Student ID</th>
                   <th>Present</th>
                    </tr>
                    </thead>
                    <tbody>";
        while($row = mysqli_fetch_array($result)){
                $student = new student();
                $student->set_name($row[0]);
                $student->set_id($row[1]);
                $cour = new course();
                $cour->set_id($course_id);
                $cour->set_absense($row[2]);
                $student->set_present(0);
                $sn = $student->get_name();
                $si = $student->get_id();
               // $p = $student->get_present();
                    echo "
                    <tr>
                      <td>$sn</td>
                      <td>$si</td>
                      <td>
                      <div class='mui-checkbox'>
                      <label>
                        <input type='checkbox' name='checks[]' value='$c' checked>
                      </label>
                    </div></td>
                      </tr>
                       ";
                      
           $c++;
           array_push($arrc,$cour);
           $student->set_courses($cour);
           array_push($arrStuds,$student);
        }
        //var_dump($arrStuds);
        if(mysqli_num_rows($result)==0){
              echo "<tr><h3>No Students Found</h3></tr>";
        }
        echo "</tbody>
        </table>";
        
        //Updating Attendance Table Based on Specific Date &Specific Course ID
        // first, we set students with check mark as attended the lesson
        if(isset($_POST['submitAttendance'])){
            if(!empty($_POST['checks'])) {
            foreach($_POST['checks'] as $value){
                $arrStuds[$value]->set_present(1);
            }
          
        }
        //echo sizeof($arrStuds);
         // second, we set students with no check mark as absent students and add 1 to its absense times
        for($i=0;$i<sizeof($arrStuds);$i++){
            if($arrStuds[$i]->get_present()==0){
                $arrStuds[$i]->get_courses()->addAbsense();
            }
        }
       // 3,save the lesson attended and absent students into db
       //in table lesson
      
       $date =$_POST['date'];
       $connect2= mysqli_connect("localhost","root","","RegistrationUniSys");
       $query2 = "INSERT into lesson (`lesson_id`, `date`, `prof_id`, `course_id`) VALUES (NULL,'". $date."','".$userID."','".$course_id."')";
       $result2 = mysqli_query($connect2,$query2);
       if($result2){
        $connect3= mysqli_connect("localhost","root","","RegistrationUniSys");
        $query3 = "SELECT `lesson_id` from lesson where date='". $date."'and prof_id='".$userID."'and course_id='".$course_id."'";
        $result3 = mysqli_query($connect3,$query3);
        if($result3){
            $row2 = $result3 -> fetch_row();
            //echo "<script>alert($row2[0])</script>";
            //echo("<script>window.location = 'profHome.php';</script>");
           // echo sizeof($arrStuds);
        for($i=0;$i<sizeof($arrStuds);$i++){
            //echo "nnnnnnn";
            $connect4= mysqli_connect("localhost","root","","RegistrationUniSys");
            $query4 = "INSERT into attendance (`attendance_id`, `lesson_id`, `stud_id`, `present`) VALUES (NULL,'".$row2[0]."','".$arrStuds[$i]->get_id()."','".$arrStuds[$i]->get_present()."')";
            $result4 = mysqli_query($connect4,$query4);
           // echo $result4;
            if($result4){
                $connect5= mysqli_connect("localhost","root","","RegistrationUniSys");
                $query5 = "UPDATE student_has_course set absense_times = '".$arrStuds[$i]->get_courses()->get_absense()."' where student_id = '".$arrStuds[$i]->get_id()."' and course_id ='".$course_id ."'";
                $result5 = mysqli_query($connect5,$query5);
            }
            else{
                echo "<script>alert('Can't Take Attendance')</script>";
                echo("<script>window.location = 'profHome.php';</script>");
               // echo "Error: " . $query . "<br>" . mysqli_error($connect4);
            }
       
         //   echo "present: ".$arrStuds[$i]->present."            ";
         //   echo "abs: ".$arrStuds[$i]->absenseTimes;
        }    
        echo "<script>alert('Attendance has been taken successfully')</script>";
        echo("<script>window.location = 'profHome.php';</script>");
       }
    }
       else{
        echo "<script>alert('Can't Take Attendance')</script>";
        echo("<script>window.location = 'profHome.php';</script>");
       }
        
         
        }
        
     
?>
    
      </div>
    </div>
    <div style="text-align: center; justify-content: center; align-items: center;">
    <input style="font-size:150%;" type="submit" class="mui-btn mui-btn--primary mui-btn--raised" name="submitAttendance" value="Submit This Week Attendance" />
    </div>    
</form>
</body>
</html>

