<?php

namespace App\BO\Services;

use App\Student;
use App\CommonBase\Service;
use App\BO\Repositories\StudentRepository;
use App\BO\Transformations\StudentTransformable;

class StudentService extends Service {

    use StudentTransformable;
    protected $studentRepo;
    public function __construct(StudentRepository $studentRepository) {
        $this->studentRepo = $studentRepository;
    }
 
    public function getStudentById($student_id){
        return $this->transformStudentDet($this->studentRepo->getStudentById($student_id));
    }

    public function allStudents(){
        $students = $this->studentRepo->allStudents();
        $studentArr = array();
        foreach($students as $student){
            $studentArr[] = $this->transformStudentDet($student);
        }
        return $studentArr;
    }

    public function verifyStudent(int $student_id){
        $status = $this->studentRepo->verifyStudent($student_id);
        return $status;
    }

    public function deleteStudent(int $student_id){
        return  $this->studentRepo->deleteStudent($student_id);
    }

    public function getCoursesByStudentId(int $student_id){
        $student = $this->studentRepo->getStudentById($student_id);
        if(isset($student->courses)){
            return $this->transformStudentDetApi($student);
        } else {
            return null;
        }
    }
}