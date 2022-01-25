<?php
class professor{
    private $id;
    private $name;
    private $course_id;
    private $course_name;
    //Setters
    function set_id($id) {
       $this->id = $id;
     }
     function set_name($name) {
       $this->name = $name;
     }
     function set_courseID($course_id) {
        $this->course_id= $course_id;
      }
      function set_course_name($course_name) {
        $this->course_name = $course_name;
      }
 //Getters
 public function get_id() {
    return $this->id;
  }
  public function get_name() {
    return $this->name;
  }
   public function get_courseID() {
    return $this->course_id;
  }
  public function get_course_name() {
    return $this->course_name;
  }
  //Get prof data for his/her home page
  function profInfo($prof_id){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select prof_name,course_id from professor where prof_id ='".$prof_id ."'";
    $result = mysqli_query($connect,$query);
    if(mysqli_num_rows($result)==1){
        $row = $result -> fetch_row();
        $prof = new professor();
        $prof->set_name($row[0]);
        $prof->set_CourseID($row[1]);
    } 
    return $prof;
  }
  //IT Function - Get all profs info
  public static function allProfsInfo(){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select professor.prof_id,professor.prof_name,professor.course_id,course.course_name from professor,course where professor.course_id=course.course_id";
    $result = mysqli_query($connect,$query);
    $arrOfProfs=[];
    while($row =mysqli_fetch_array($result)){
        $prof =new professor();
        $prof->set_id($row[0]);
        $prof->set_name($row[1]);
        $prof->set_courseID($row[2]);
        $prof->set_course_name($row[3]);
        array_push($arrOfProfs,$prof);
    }
    return $arrOfProfs;
  }
}

?>