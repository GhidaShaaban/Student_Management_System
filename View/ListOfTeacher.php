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


<body>
    <div class="register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
                <h3 style="font-family:Times New Roman, Times, serif; size:16px">Welcome To</h3>
                <h3 style="font-family:Times New Roman, Times, serif; size:16px"><b>Time Travel University</b></h3>
                <P style="font-family:Times New Roman, Times, serif; size:16px">We look forward to welcoming you to our campus soon!​</P>
                <div class="col-md-9 register-right">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Instructor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Table</a>
                        </li>
                    </ul>
                    <div class="row col-md-2">
                        <ul>
                            <li style='display: unset;position: absolute;margin: 72px;margin-left: 78px;margin-bottom: 79px;'><a href="Choose_Directory.php"><i class="fa fa-arrow-left" style="font-size:35px"></i></a></li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class=" register-form">

                                <div class="form-group">
                                    <table class="table table-hover" id="Registration_table" style="color:white">
                                        <thead>
                                            <tr>
                                                <th scope="col">Teacher's Name</th>
                                                <th scope="col">Teacher's Email</th>
                                                <th scope="col"> Teacher's PhoneNumber</th>
                                                <th scope="col"> Courses/Semester</th>
                                                <th scope="col"> Delete </th>
                                                <th scope="col">Edit</th>

                                            </tr>
                                        </thead>
                                        <?php
                                        for ($i = 0; $i < count($class); $i++) {
                                        ?>
                                            <tr>
                                                <td><?php echo $class[$i]['TFirstName'] . " " . $class[$i]['TLastName']; ?> </td>
                                                <td><?php echo $class[$i]['TEmail']; ?> </td>
                                                <td><?php echo $class[$i]['TMobileNum']; ?> </td>
                                                <td><?php echo $class[$i]['CourseName'] . "/" . $class[$i]['SName']; ?> </td>
                                                <td id="delete"><a href="#" ; onclick="deleteClass(<?php echo $class[$i]['ClassId']; ?> )">Delete </a> </td>
                                                <td><a href="../View/EditCourse.php?id=<?php echo $class[$i]['ClassId']; ?>">Edit </a> </td>
                                            </tr> <?php } ?>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <?php
            require_once('Footer.php'); ?>

</body>

</html>