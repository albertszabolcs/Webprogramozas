<?php
class Subject
{
    private string $code;
    private string $name;
    private string $courseCode;

    private array $students;

    public function __construct(string $code, string $name,string $courseCode, array $students = [])
    {
        $this->code = $code;
        $this->name = $name;
        $this->courseCode = $courseCode;
        $this->students = $students;

    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function setStudents(string $students): void
    {
        $this->students = $students;
    }

    public function addStudent(string $name, string $studentNumber): Student
    {
        if (!$this->isStudentExists($studentNumber)) {
            $student = new Student($name, $studentNumber);
            $this->students[$studentNumber] = $student;
            return $student;
        } else {
            throw new Exception("Student exists!");
        }
    }

    public function __toString(): string
    {
        $studentsList = implode('<br>', array_map(function ($student) {
            return $student->getName() . " (" . $student->getStudentNumber() . ")";
        }, $this->students));

        return "Subject Code: " . $this->code . "<br>Name: " . $this->name . "<br>Students:<br>" . $studentsList;
    }

    private function isStudentExists($studentNumber): bool
    {
        if (count($this->students) == 0) return false;
        foreach ($this->students as $student) {
            if ($student->getStudentNumber() == $studentNumber) {
                return true;
            }
        }
        return false;
    }

    public function deleteStudent(string $studentNumber): bool
    {
        if (empty($this->students)) {
            return false;
        }
        foreach ($this->students as $key => $student) {
            if ($student->getStudentNumber() == $studentNumber) {
                unset($this->students[$key]);
                return true;
            }
        }
        return false;
    }

    public function getCourseCode(): string
    {
        return $this->courseCode;
    }
}
