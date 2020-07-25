<?php

namespace App\BO\Repositories;
use App\Student;
use Illuminate\Database\QueryException;

class StudentRepository{

    protected $studentModel;
    public function __construct(Student $studentModel) {
        $this->studentModel = $studentModel;
    }

    public function getStudentById($student_id){
        return $this->studentModel->find($student_id);
    }

    public function allStudents(){
        return $this->studentModel->where(["is_deleted" => 0])->get();
    }

    public function verifyStudent(int $student_id){
        try{
            $student = $this->getStudentById($student_id);
            $student->update(array(
                "is_verified" => 1
            ));
            return $this->getStudentById($student_id);
            // dd($student);
        } catch (QueryException $ex){
            return false;
        }
    }

    public function deleteStudent(int $student_id){
        try{
            $student = $this->getStudentById($student_id);
            $student->update(array(
                "is_deleted" => 1
            ));
            return true;
            // dd($student);
        } catch (QueryException $ex){
            return false;
        }
    }
}