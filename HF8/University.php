<?php

class University extends AbstractUniversity
{
    public $subjects = [];
    public string $courseCode;

    public function addSubject(string $code, string $name,string $courseCode): Subject
    {
        $subject = new Subject($code, $name,$courseCode);
        $this->subjects[$code] = $subject;
        return $subject;
    }

    public function addStudentOnSubject(string $subjectCode, Student $student)
    {    if ($student === null) {
        echo "Student cannot be null." . PHP_EOL;
        return;
    }
        foreach($this->subjects as $subject){
            if($subject->getCode() == $subjectCode) {
                $subject->addStudent($student->getName(), $student->getStudentNumber());
            }
        }
    }

    public function getStudentsForSubject(string $subjectCode): array
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $subjectCode) {
                return $subject->getStudents();
            }
        }
        return [];
    }

    private function isSubjectExists(string $code, string $name): bool
    {
        if (isset($this->subjects[$code])) {
            return $this->subjects[$code]->getName() === $name;
        }
        return false;
    }

    public function getNumberOfStudents(): int
    {
        $totalStudents = 0;
        foreach ($this->subjects as $subject) {
            $totalStudents += count($subject->getStudents());
        }
        return $totalStudents;
    }
        public function print()
        {
            if (empty($this->subjects)) {
                echo "No subjects available." . PHP_EOL;
                return;
            }

            foreach ($this->subjects as $subject) {
                echo "Subject Code: " . $subject->getCode() .PHP_EOL;
                echo "Subject Name: " . $subject->getName() . PHP_EOL;
                echo "Students: " . PHP_EOL>

            $students = $subject->getStudents();
                if (empty($students)) {
                    echo "  No students enrolled." .PHP_EOL;
        } else {
            foreach ($students as $student) {
            }
        }
        echo PHP_EOL;
        }
    }
    public function deleteSubject(Subject $subject)
    {
        if (count($subject->getStudents()) > 0) {
            throw new NoStudentsAssignedException("You cannot delete the subject because it is assigned to a student");
        }
        $index = array_search($subject, $this->subjects, true);
        if ($index !== false) {
            unset($this->subjects[$index]);
            echo " The subject has been deleted: " . $subject->getName() . PHP_EOL;
        } else {
            echo "The subject does not exist" . PHP_EOL;
        }
    }

    public function getSubject(): string
    {
        // TODO: Implement getSubject() method.
    }
}

