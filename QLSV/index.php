<?php
session_start();
require_once('./classes/StudentDAO.php');
$studentDAO = new StudentDAO('./data/Student.csv');
$listStudent = $studentDAO->getListStudent();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <h1 class="text-center">Danh sách sinh viên</h1>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
        Thêm mới sinh viên
    </button>
    <br>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th class="text-center">Mã sinh viên</th>
            <th class="text-center">Họ tên</th>
            <th class="text-center">Điểm</th>
            <th class="text-center">Lớp</th>
            <th class="text-center">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listStudent as $student) { ?>
            <tr>
                <td class="text-center"><?= $student->getId() ?></td>
                <td class="text-center"><?= $student->getName() ?></td>
                <td class="text-center"><?= $student->getScore() ?></td>
                <td class="text-center"><?= $student->getGroup() ?></td>
                <td class="text-center">
                    <a href="./classes/editStudent.php?id=<?= $student->getId() ?>" class="btn btn-info">Sửa</a>
                    <a onclick="return confirm('Bạn có muốn xoá sinh viên này không ?')"
                       href="./classes/deleteStudent.php?id=<?= $student->getId() ?>" class="btn btn-danger">Xoá</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Insert Student</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="./classes/insertStudent.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <?php if (isset($_SESSION['eName'])) { ?>
                            <span class="text-danger"><?= $_SESSION['eName'] ?></span>
                            <?php unset($_SESSION['eName']); ?>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="score">Score</label>
                        <input type="text" id="score" name="score" class="form-control">
                        <?php if (isset($_SESSION['eScore'])) { ?>
                            <span class="text-danger"><?= $_SESSION['eScore'] ?></span>
                            <?php unset($_SESSION['eScore']); ?>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="group">Lớp</label>
                        <input type="text" id="group" name="group" class="form-control">
                        <?php if (isset($_SESSION['eGroup'])) { ?>
                            <span class="text-danger"><?= $_SESSION['eGroup'] ?></span>
                            <?php unset($_SESSION['eGroup']); ?>
                        <?php } ?>
                    </div>
                    <button class="btn btn-success">Thêm sinh viên</button>
                </form>
            </div>


            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
</body>
</html>