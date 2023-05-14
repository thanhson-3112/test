<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Update Student</title>

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
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Thông tin sinh viên</h3>
        <a href="../index.php" class="btn btn-primary">Quay lại</a>
    </div>
    <?php
    require_once('StudentDAO.php');
    $studentDAO = new StudentDAO('../data/Student.csv');
    $students = $studentDAO->getListStudent();
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Tìm sinh viên theo ID
        $studentToEdit = null;
        foreach ($students as $student) {
            if ($student->getId() == $id) {
                $studentToEdit = $student;
                break;
            }
        }
    }
    if ($studentToEdit) {
    ?>
    <form action="updateStudent.php" method="post">

        <div class="form-group mb-3">
            <input type="hidden" name="id" id="id" class="form-control" value="<?= $studentToEdit->getId() ?>">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $studentToEdit->getName() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="score">Score</label>
            <input type="text" id="score" name="score" class="form-control" value="<?= $studentToEdit->getScore() ?>">
        </div>
        <div class="form-group mb-3">
            <label for="group">Group</label>
            <input type="text" id="group" name="group" class="form-control" value="<?= $studentToEdit->getGroup() ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>

        <form/>
        <?php } ?>


</div>
</body>

</html>