<?php
 class Student
 {
     private string $name;
     private array $grades = [];
     private string $studentNumber;

     public function __construct(string $name, string $studentNumber)
     {
         $this->name = $name;
         $this->studentNumber = $studentNumber;

     }

     public function getName(): string
     {
         return $this->name;
     }

     public function setName(string $name): void
     {
         $this->name = $name;
     }

     public function getStudentNumber(): string
     {
         return $this->studentNumber;
     }

     public function setStudentNumber(string $studentNumber): void
     {
         $this->studentNumber = $studentNumber;
     }

     public function addGrade(Subject  $subject ,float $grade): void
     {
         $courseCode = $subject->getCourseCode();
         $this->grades[$courseCode] = $grade;
     }

     public function getGrades(): array
     {
         return $this->grades;
     }

     public function getGrade(string $courseCode): ?float
     {
         return $this->grades[$courseCode] ?? null;
     }
     public function getAvgGrade(): ?float {
         if (empty($this->grades)) {
             return  null;
         }
         return array_sum($this->grades) / count($this->grades);
     }
     public function printGrades(array $subjects): void  {
         echo "Grades for " . $this->getName();
         foreach ($subjects as $subject) {
             $courseCode = $subject->getCourseCode();
             $grade = $this->getGrade($courseCode);
             if($grade !== null) {
                 echo $subject->getName(). "-" . $grade . "<br>";

             }
         }
     }
     public static function sortStudentsByAvgGrade(array $students): array {
        $avgGrades = [];
            foreach ($students as $student) {
                $avgGrades[] = $student->getAvgGrade();
            }
            array_multisort($avgGrades, SORT_DESC, $students);

            return $students;
     }
 }

