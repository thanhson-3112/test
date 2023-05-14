<?php
require_once 'Student.php';
require_once 'StudentDAO.php';
//Lấy các giá trị mới từ form
$id = $_POST['id'];
$name = $_POST['name'];
$score = $_POST['score'];
$group = $_POST['group'];
// Tạo đối tượng Student mới
$updatedStudent = new Student($id, $name, $score, $group);
// Cập nhật thông tin sinh viên
$studentDAO = new StudentDAO('../data/Student.csv');
$studentDAO->updateStudent($updatedStudent);
// Thực hiện các hành động tiếp theo (ví dụ: chuyển hướng người dùng đến trang danh sách sinh viên)
header('Location: ../index.php');
