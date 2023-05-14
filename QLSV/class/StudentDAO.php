<?php
require_once 'Student.php';

class StudentDAO
{
    private $filename;
    private $listStudent;

    public function getListStudent()
    {
        return $this->listStudent;
    }

    public function setListStudent($listStudent)
    {
        $this->listStudent = $listStudent;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->getAll();
    }

    public function getAll()
    {
        // Đọc toàn bộ dữ liệu từ file CSV
        $data = array_map('str_getcsv', file($this->filename));

        // Loại bỏ phần tử đầu tiên trong mảng (tên cột)
        array_shift($data);

        // Tạo danh sách sinh viên
        $this->listStudent = array();
        foreach ($data as $row) {
            $student = new Student($row[0], $row[1], $row[2], $row[3]);
            array_push($this->listStudent, $student);
        }

    }

    public function addStudent($student)
    {
        // Đọc toàn bộ dữ liệu từ file CSV
        $data = array_map('str_getcsv', file($this->filename));
        // Tìm ID lớn nhất hiện có
        $max_id = 0;
        foreach ($data as $row) {
            if ($row[0] > $max_id) {
                $max_id = intval($row[0]);
            }
        }
        // Tạo ID mới và đặt cho sinh viên mới
        $new_id = $max_id + 1;
        $student->setId($new_id);

        // Thêm thông tin của sinh viên mới vào mảng dữ liệu
        $newData = array(
            $student->getId(),
            $student->getName(),
            $student->getScore(),
            $student->getGroup()
        );
        array_push($data, $newData);

        // Ghi mảng dữ liệu vào file CSV
        $file = fopen($this->filename, 'w');
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
    }

    public function updateStudent($student)
    {
        // Đọc toàn bộ dữ liệu từ file CSV
        $data = array_map('str_getcsv', file($this->filename));

        // Tạo một mảng để lưu trữ dữ liệu đã được sửa
        $updatedData = array();

        // Duyệt qua mảng dữ liệu và sửa thông tin sinh viên
        foreach ($data as $row) {
            if ($row[0] == $student->getId()) {
                $updatedData[] = array(
                    $student->getId(),
                    $student->getName(),
                    $student->getScore(),
                    $student->getGroup()
                );
            } else {
                $updatedData[] = $row;
            }
        }

        // Ghi mảng dữ liệu đã sửa vào file CSV
        $file = fopen($this->filename, 'w');
        foreach ($updatedData as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    }

    public function deleteStudent($id)
    {
        // Đọc toàn bộ dữ liệu từ file CSV vào mảng
        $students = array_map('str_getcsv', file($this->filename));

        // Tạo một mảng mới, chỉ chứa các bản ghi không có id bằng với id muốn xóa
        $newStudents = array();
        foreach ($students as $student) {
            if ($student[0] != $id) {
                array_push($newStudents, $student);
            }
        }

        // Ghi mảng mới vào file CSV
        $file = fopen($this->filename, 'w');
        foreach ($newStudents as $student) {
            fputcsv($file, $student);
        }
        fclose($file);
    }
}