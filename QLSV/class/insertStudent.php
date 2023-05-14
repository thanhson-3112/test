<?php
session_start();
require_once './StudentDAO.php';

function is_text($text, int $min = 0, int $max = 1000): bool
{
    $length = mb_strlen($text);
    return ($length >= $min && $length <= $max);
}

function is_valid_score($score): bool
{
    $floatValue = filter_var($score, FILTER_VALIDATE_FLOAT);
    return ($floatValue !== false && $floatValue >= 0 && $floatValue <= 10);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $score = isset($_POST['score']) ? $_POST['score'] : '';
    $group = isset($_POST['group']) ? trim($_POST['group']) : '';

    $validName = is_text($name, 3, 50);
    $validScore = is_valid_score($score);
    $validGroup = is_text($group, 3, 50);

    if (!$validName) {
        $_SESSION['eName'] = 'Username must be 3-50 characters';
    }

    if (!$validScore) {
        $_SESSION['eScore'] = 'Score must be a number between 0 and 10';
    }

    if (!$validGroup) {
        $_SESSION['eGroup'] = 'Group must be 3-50 characters';
    }

    if ($validName && $validScore && $validGroup) {
        $student = new Student(null, $name, $score, $group);

        // Thêm sinh viên mới vào file CSV
        $newStudent = new StudentDAO('../data/Student.csv');
        $new_student = $newStudent->addStudent($student);

        header('Location: ../index.php');
        exit;
    } else {
        header('Location: ../index.php');
        exit;
    }
}

?>
