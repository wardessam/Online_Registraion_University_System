<?php
class ituser{
    private $id;
    private $name;
//Setters
    function set_id($id) {
        $this->id = $id;
      }
      function set_name($name) {
        $this->name = $name;
      }
//Getters
public function get_id() {
    return $this->id;
  }
  public function get_name() {
    return $this->name;
  }
//
public static function getInfo($id){
    $connect= mysqli_connect("localhost","root","","RegistrationUniSys");
    $query = "select user_name from ituser where user_id ='".$id ."'";
    $result = mysqli_query($connect,$query);
    $ituser = new ituser();
    if(mysqli_num_rows($result)==1){
        $row = $result -> fetch_row();
        $ituser->set_name($row[0]);
    } 
    return $ituser;
}
}


?>