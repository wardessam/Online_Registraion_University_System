<?php
class course{
    private $id;
    private $name;
    private $dept_id;
    private $dept_name;
    private $prof_name;
    private $numOfSeats;
    private $avSeats;
    private $grade;
    private $absense;
///Setters
    function set_id($id) {
        $this->id = $id;
      }
      function set_name($name) {
        $this->name = $name;
      }
      function set_deptID($dept_id) {
        $this->dept_id= $dept_id;
      }
      function set_dept_name($dept_name) {
        $this->dept_name= $dept_name;
      }
      function set_profName($prof_name) {
        $this->prof_name= $prof_name;
      }
      function set_numOfSeats($numOfSeats) {
        $this->numOfSeats= $numOfSeats;
      }
      function set_avSeats($avSeats) {
        $this->avSeats= $avSeats;
      }
      function set_grade($grade) {
        $this->grade= $grade;
      }
      function set_absense($absense) {
        $this->absense= $absense;
      }
////Getters
   function get_id() {
    return $this->id;
  }
   function get_name() {
    return $this->name;
  }
  function get_deptID() {
    return $this->dept_id;
  }
  function get_dept_name() {
    return $this->dept_name;
  }
  function get_profName() {
    return $this->prof_name;
  }
  function get_numOfSeats() {
    return $this->numOfSeats;
  }
  function get_avSeats() {
    return $this->avSeats;
  }
  function get_grade() {
    return $this->grade;
  }
  function get_absense() {
    return $this->absense;
  }
  /////
  function addAbsense() {
    $this->absense+=1;
  }
  //Already Registered Courses
  function registered_courses($stud_id){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select course_id from student_has_course where student_id ='".$stud_id ."'";
    $result = mysqli_query($connect,$query); 
    $arrCoursesIDs=[];
    while($row =mysqli_fetch_array($result)){
        array_push($arrCoursesIDs,$row[0]);
    }
    return $arrCoursesIDs;
  }
  //info about Registered Courses
  function infoAboutRegistered_courses($stud_id){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select course.course_name,student_has_course.grade,student_has_course.absense_times from student_has_course,course where student_has_course.student_id ='".$stud_id ."' and course.course_id=student_has_course.course_id";
    $result = mysqli_query($connect,$query); 
    $arrCourses=[];
    while($row =mysqli_fetch_array($result)){
        $course =new course();
        $course->set_name($row[0]);
        $course->set_grade($row[1]);
        $course->set_absense($row[2]);
        array_push($arrCourses,$course);
    }
    return $arrCourses;
  }
  //Available Courses
  function available_courses($dept_id,$CIDs){
    $arrCourses=[];
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select professor.prof_name,course.course_id,course.course_name,course.seats_num,course.available_seats from course, professor where course.dept_id ='".$dept_id ."' and course.available_seats>0 and professor.course_id=course.course_id";
    $result = mysqli_query($connect,$query);
   while($row =mysqli_fetch_array($result)){
        $flag=false;
         //Check the registered courses from the available ones first..
        for($i=0;$i<sizeof($CIDs);$i++){
            if($CIDs[$i]==$row[1]){
            $flag=true;
            break;
            }
         }
         //If the available course ISNT a registered one already, then add it to the list of available courses.
    if(!$flag){
      $course =new course();
      $course->set_profName($row[0]);
      $course->set_id($row[1]);
      $course->set_name($row[2]);
      $course->set_numOfSeats($row[3]);
      $course->set_avSeats($row[4]);
      array_push($arrCourses,$course);
      
    }
}
   
    return $arrCourses;
}
//To register a course, you should do 2 steps.
//1. link the student with the course in student_has_course table
  public static function register_course($courseID,$studID){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "insert into student_has_course (`student_id`, `course_id`, `grade`, `absense_times`) VALUES ('".$studID."','".$courseID."',NULL,'0')";
    $result = mysqli_query($connect,$query);
    if($result) return true;
    else return false;
  }
//2. Minus available seats in this course - 1
  public static function minus_avSeats($courseID){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select available_seats from course where course_id='".$courseID."'";
    $result = mysqli_query($connect,$query); 
    if($result){
      $row = $result -> fetch_row();
      $av =$row[0]-1;
    $query2 = "UPDATE course SET available_seats= '".$av."'WHERE course_id='".$courseID."'";
    $result2 = mysqli_query($connect,$query2);
    }
    if($result2) return true;
    else return false;
  }
}
?>