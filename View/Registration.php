<!DOCTYPE html>
<html lang="en">
<?php
require_once('Header.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../Model/DatabaseSMS.php');
require_once('../Model/Admin.php');
$db = new DatabaseSMS();
$Admin = new Admin($db);

$semester = $Admin->getSemesters();

$course = $Admin->getCourses();

$teacher = $Admin->getTeachers();

$schedule = $Admin->getSchedules();

$class = $Admin->getClasses();

?>
<script>
    /* first Way
 $(document).ready(function(){
  $("#delete").click(function(){
	  $.get("Check_course_registration_form.php?id="+ classID, function(data, status){
		  if(data==1){
			    alert("The class is deleted");
			}else{
				var answer=confirm( "has been registred in this class, Are you sure you want to delete this class" );
				if(answer){
						$.get("Delete_course_registration_form.php?id="+ classID, function(data, status){});
				}
			}
			);
   });
}); */
    // AJax function to delete class.
    function deleteClass(classID) {
        $.get("../Controller/Check_course_registration_form.php?id=" + classID, function(data, status) {
            var myResult = data;
            //check if the choosen class has student regsitered on it
            //if no
            if (myResult.error == 0) {
                if (myResult.result == 1) {
                    alert("The class is deleted");
                } else { //if yes
                    var answer = confirm("There are has been registred in this class, Are you sure you want to delete this class");
                    if (answer) {
                        $.get("../Controller/Delete_course_registration_form.php?id=" + classID, function(data, status) {});
                    }
                }
            } else {
                alert("Error Try Again");
            }
            location.reload();
        });
    }
</script>

<body>
    <div class=" register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
                <h3 style="font-family:Times New Roman, Times, serif; size:16px">Welcome To</h3>
                <h3 style="font-family:Times New Roman, Times, serif; size:16px"><b>Time Travel University</b></h3>
            </div>
            <div class="col-md-9 register-rights">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Instructor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Table</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Registration Form </h3>
                                <div class="row col-md-2">

                                    <ul>
                                        <li style='display: unset;position: absolute;margin: 72px;margin-left: 78px;margin-bottom: 79px;'><a href="../View/Choose_Directory.php"><i class="fa fa-arrow-left" style="font-size:35px; color:white"></i></a></li>
                                    </ul>
                                </div>
                                <form action="../Controller/Verify_Insert_Course.php" method="POST" class="form" id="form">
                                    <div class="row register-forms mx-0 px-0 col-md-12">
                                        <div class="centering col-md-6">
                                            <div class="form-group">
                                                <div class="input-container">
                                                    <i class="fa fa-building icon"></i>
                                                    <input type="text" class="form-control" id="Classname" name="Classname" placeholder="Classname" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-container">
                                                    <i class="fa fa-graduation-cap icon"></i>
                                                    <select class="custom-select" name="semester" id="semester" required>
                                                        <option disabled value="" selected hidden>Select Semester</option>
                                                        <?php
                                                        for ($i = 0; $i < count($semester); $i++) {
                                                        ?>
                                                            <option value="<?php echo $semester[$i]["SemesterId"] ?>"><?php echo $semester[$i]["SName"] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-container">
                                                    <i class="fa fa-book icon" aria-hidden="true"></i>
                                                    <select class="custom-select" name="Course" id="Course" required>
                                                        <option disabled value="" selected hidden>Select Course</option>
                                                        <?php
                                                        for ($i = 0; $i < count($course); $i++) {
                                                        ?>
                                                            <option value="<?php echo $course[$i]["CourseId"] ?>"><?php echo $course[$i]["CourseName"] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-container">
                                                    <i class="fa fa-user icon" aria-hidden="true"></i>
                                                    <!-- <i class="fas fa-chalkboard-teacher aria-hidden='true' icon"></i> -->
                                                    <select class="custom-select" name="teacher" id="teacher" required>
                                                        <option disabled value="" selected hidden>Select Instructor</option>
                                                        <?php
                                                        for ($i = 0; $i < count($teacher); $i++) {
                                                        ?>
                                                            <option value="<?php echo $teacher[$i]["TeacherId"] ?>"><?php echo $teacher[$i]["TFirstName"] . " " . $teacher[$i]["TLastName"] ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-container">
                                                    <i class="fa fa-calendar icon" aria-hidden="true"></i>
                                                    <select class="custom-select" name="schedule" id="schedule" required>
                                                        <option disabled value="" selected hidden>Schedule Time</option>
                                                        <?php
                                                        for ($i = 0; $i < count($schedule); $i++) {
                                                        ?>
                                                            <option value="<?php echo $schedule[$i]["ScheduleId"] ?>"><?php echo $schedule[$i]["Time"] ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="courseMessage">
                                            </div>
                                            <input type="submit" class="btnRegister" id="registerButton" value="Register" />

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="register-heading">Table</h3>
                        <div class=" register-forms">

                            <div class="form-group">
                                <table class="table table-hover" id="Registration_table" style="color:white">
                                    <thead>
                                        <tr>
                                            <th scope="col">Class Name</th>
                                            <th scope="col"> Semester</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Instructor</th>
                                            <th scope="col">Schedule</th>
                                            <th scope="col">Delete</th>
                                            <th scope="col">Edit </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($class); $i++) {
                                    ?>
                                        <tr>
                                            <td><?php echo $class[$i]['ClassName']; ?> </td>
                                            <td><?php echo $class[$i]['SName']; ?> </td>
                                            <td><?php echo $class[$i]['CourseName']; ?> </td>
                                            <td><?php echo $class[$i]['TFirstName'] . " " . $class[$i]['TLastName']; ?> </td>
                                            <td><?php echo $class[$i]['Time']; ?> </td>
                                            <td id="delete"><a href="#" ; onclick="deleteClass(<?php echo $class[$i]['ClassId']; ?> )"><i class="fa fa-trash icons" aria-hidden="true"></i></a> </td>
                                            <td><a href="../View/EditCourse.php?id=<?php echo $class[$i]['ClassId']; ?>"><i class="fa fa-edit icons" aria-hidden="true"></i></a> </td>
                                        </tr> <?php } ?>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <script>
            document.getElementById("registerButton").addEventListener("click", function(event) {
                event.preventDefault();
                var data = {
                    Classname: $("#Classname").val(),
                    semester: $("#semester").val(),
                    Course: $("#Course").val(),
                    teacher: $("#teacher").val(),
                    schedule: $("#schedule").val(),
                };

                $.post("../Controller/Verify_Insert_Course.php", data, function(result) {
                    $("#courseMessage").html(result.Message);
                    setTimeout(() => {
                        $("#courseMessage").html(" ");
                    }, 4000);
                });
            });
        </script>

        <?php
        require_once('Footer.php'); ?>

</body>

</html>