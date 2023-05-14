<?php
require_once './StudentDAO.php';
$id = $_GET['id'];
$dao = new StudentDAO('../data/Student.csv');
$dao->deleteStudent($id);
header("location: ../index.php");
?>