<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- load MUI -->
    <link href="//cdn.muicss.com/mui-0.10.3/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.10.3/js/mui.min.js"></script>
<style>
.accordion2 {
  background-color: #3f50b5;
  color: #fff;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion2:hover {
  background-color: #757ce8;
}

.accordion2:after {
  content: '\002B';
  color: #fff;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
</style>
</head>
<body>
<div class="mui-container">
      <div class="mui-panel">
<?php
error_reporting(0);
include_once "Online_Registraion_University_System/Student/studentClass.php";

$studs =student::allStudentsInfo();
$allstuds =student::allCoursesofStudentsInfo($studs);

for($i=0;$i<sizeof($allstuds);$i++){
    $name=$allstuds[$i]->get_name();
    $id=$allstuds[$i]->get_id();
    $courses="";
    $dept_id=$allstuds[$i]->get_deptID();
    for($j=0;$j<sizeof($allstuds[$i]->get_courses());$j++){
        $courses=$courses.$allstuds[$i]->get_courses()[$j].", ";
    }
    //echo $courses;
    if(sizeof($allstuds[$i]->get_courses())==0){
        $courses="No registered Courses Yet";
    }
    echo "<button style='font-size:170%' class='accordion2'>Student Name: $name</button>
    <div class='panel'>
    <table class='mui-table mui-table--bordered'>
    <tr>
        <td>Student ID</td>
        <td>$id </td>
    </tr>
    <tr>
        <td>Department ID</td>
        <td>$dept_id</td>
    </tr>
    <tr>
        <td>Courses</td>
        <td>$courses</td>
    </tr>
   </table>
    </div>";
}
?>



</div>
</div>
<script>
var acc = document.getElementsByClassName("accordion2");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
</body>
</html>
