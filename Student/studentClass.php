<?php
while (! file_exists('Online_Registraion_University_System') )
chdir('..');
include "Online_Registraion_University_System/Course.php";
class student{
 private $id;
 private $name;
 private $present;
 private $courses=[];
 private $paid_tuition;
 private $dept_id;
 //Setters
 function set_id($id) {
    $this->id = $id;
  }
  function set_name($name) {
    $this->name = $name;
  }
  function set_present($present) {
    $this->present= $present;
  }
  function set_courses($courses){
      $this->courses=$courses;
  }
  function set_paid_tuition($paid_tuition){
    $this->paid_tuition=$paid_tuition;
  }
  function set_deptID($dept_id){
    $this->dept_id=$dept_id;
  }
  //Getters
  public function get_id() {
    return $this->id;
  }
  public function get_name() {
    return $this->name;
  }
  function get_present() {
    return $this->present;
  }
  function get_courses() {
    return $this->courses;
  }
  function get_paid_tuition() {
    return $this->paid_tuition;
  }
  function get_deptID() {
    return $this->dept_id;
  }
  //
 
//Return Info about the student 
  public static function studentInfo($stud_id){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select stud_name,dept_id,paid_tuition from student where stud_id ='".$stud_id ."'";
    $result = mysqli_query($connect,$query);
    if(mysqli_num_rows($result)==1){
        $row = $result -> fetch_row();
        $student = new student();
        $student->set_name($row[0]);
        $student->set_deptID($row[1]);
        $student->set_paid_tuition($row[2]);
    } 
    return $student;
  }

  function showAbsenseTimes($stud_id){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select student_has_course.course_id,student_has_course.grade,student_has_course.absense_times,course.course_name from student_has_course,course where student_id ='".$stud_id ."' and student_has_course.course_id=course.course_id";
    $result = mysqli_query($connect,$query); 
    while($row =mysqli_fetch_array($result)){
        array_push($arrCoursesIDs,$row[0]);
    }
    return $arrCoursesIDs;
  }
  //IT functions
  //List of Unpaid tuition students
  public static function listOfUnpaidStuds(){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select stud_id,stud_name,dept_id from student where paid_tuition ='N'";
    $result = mysqli_query($connect,$query); 
    $arrOfStuds=[];
    while($row =mysqli_fetch_array($result)){
        $stud =new student();
        $stud->set_id($row[0]);
        $stud->set_name($row[1]);
        $stud->set_deptID($row[2]);
        array_push($arrOfStuds,$stud);
    }
    return $arrOfStuds;
  }
  //List of all students
  public static function allStudentsInfo(){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select student.stud_id,student.stud_name,student.dept_id from student";
    $result = mysqli_query($connect,$query);
    $arrOfStuds=[];
    while($row =mysqli_fetch_array($result)){
        $stud =new student();
        $stud->set_id($row[0]);
        $stud->set_name($row[1]);
        $stud->set_deptID($row[2]);
        array_push($arrOfStuds,$stud);
    }
    return $arrOfStuds;
  }
  //List of all courses with students
  public static function allCoursesofStudentsInfo($studs){
    for($i=0;$i<sizeof($studs);$i++){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select course.course_name from course,student_has_course where student_has_course.student_id='".$studs[$i]->get_id()."' and course.course_id=student_has_course.course_id";
    $result = mysqli_query($connect,$query);
    $arrOfco=[];
    while($row =mysqli_fetch_array($result)){
        array_push($arrOfco,$row[0]);
    }
       $studs[$i]->set_courses($arrOfco);
}
    return $studs;
  }
  //Prof Fns
  //1.Search Student with course id and letter or more of his/her name
  /*public static function search_student($course_id,$stud_name){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "SELECT student.stud_name , student_has_course.student_id , student_has_course.grade , student_has_course.absense_times from student_has_course, student where student_has_course.student_id = student.stud_id and student_has_course.course_id ='".$course_id ."' and student.stud_name like '%".$stud_name."%' ";
    $result = mysqli_query($connect,$query);
    $listOfStuds=[];
    $cours=[];
    while($row = mysqli_fetch_array($result)){
      $student=new student();
        $student->set_name($row[0]);
        $student->set_id($row[1]);
        $c =new course();
        $c->set_id($course_id);
        $grade = $row[2];
        if(!isset($grade)){
            $grade="Grade isn't set yet";
        }
        $c->set_grade($grade);
        $c->set_absense($row[3]);
        array_push($cours,$c);
        $student->set_courses($cours);
        array_push($listOfStuds,$student);
    }
    return array($listOfStuds,$cours);
  }
  //2.View all students of his course
  public static function viewAllStudents($course_id){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "SELECT student.stud_name , student_has_course.student_id , student_has_course.grade , student_has_course.absense_times from student_has_course, student where student_has_course.student_id = student.stud_id and student_has_course.course_id ='".$course_id ."'";
    $result = mysqli_query($connect,$query);
    $listOfStuds=[];
    $cours=[];
    while($row = mysqli_fetch_array($result)){
        $student=new student();
        $student->set_name($row[0]);
        $student->set_id($row[1]);
        $c =new course();
        $c->set_id($course_id);
        $grade = $row[2];
        if(!isset($grade)){
            $grade="Grade isn't set yet";
        }
        $c->set_grade($grade);
        $c->set_absense($row[3]);
        array_push($cours,$c);
        $student->set_courses($cours);
        array_push($listOfStuds,$student);
    }
    return array($listOfStuds,$cours);
  }*/
}


?>