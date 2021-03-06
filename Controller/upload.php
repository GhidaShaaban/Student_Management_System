<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../Model/DatabaseSMS.php");
$db = new DatabaseSMS();
require_once('../Model/Teacher.php');

$Teacher = new Teacher($db);

// File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["userfile"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$ClassID=$_GET["ClassID"];

if(!empty($_FILES["userfile"]["name"])){
    // Allow certain file formats
    $allowTypes = array('doc','ppt','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $targetFilePath)){
            // Insert file name into database
			$result = $Teacher->insertFile($ClassID, $fileName);
            if($result){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}
header("Location:../View/RegistredStudents.php?ClassID=" .$ClassID);
?>
