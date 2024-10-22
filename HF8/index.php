<?php
global $students;
$students = [];

include "AbstractUniversity.php";
include "Student.php";
include "University.php";
include "Subject.php";
include "NoStudentsAssignedException.php";

$university = new University();
$student = new Student('Alice','5597');
$students[] = $student;
$subject = $university->addSubject('Math001','Mathematics','asasa');
$university->addStudentOnSubject('Math001',$student);

$subject = new Subject("654854","Mathematics",'math456',[]);
$subject2 = new Subject(789121,"Physics",'Physics56',[]);
$student1 = new Student("Kristian",'958452');
$students[] = $student1;
$student->addGrade($subject, 6 );
$student->addGrade($subject,8.5);
$student->addGrade($subject,7.3);
$grades = $student ->getGrades($subject);
print_r($grades);
$grade = $student->getGrade($subject);
echo "Grade for course 102: ". $grade;
$student->getName();
$math = $university->addSubject('Math001','Mathematics','6554112');
$university->print();
$student->getStudentNumber();
$university->getNumberOfStudents();
$subject->getCode();
$subject->addStudent("Bob","12331");
$subject->deleteStudent("5597");
$avgGrade = $student->getAvgGrade();
$student->printGrades([$subject,$subject2]);
echo  "Average grade for " . $student->getName() . ": " . ($avgGrade !== null ? $avgGrade : "No grades available")."<br>";
try {
    $university->deleteSubject($subject);
} catch (NoStudentsAssignedException $e) {
    echo $e->getMessage()."<br>";
}
$students = [$student,$student1];
$sortedStudents = Student::sortStudentsByAvgGrade($students);
echo "=== Sorted Students by Average Grade ==="."<br>";
foreach ($students as $student) {
    echo $student->getName(). " - Average  Grade: " .($student->getAvgGrade()!== null ? $student->getAvgGrade() : "No grades")."<br>";
}







