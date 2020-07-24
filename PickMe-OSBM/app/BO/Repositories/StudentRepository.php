<?php

namespace App\BO;
use App\Student;

class StudentRepository{

    protected $studentModel;
    public function __construct(Student $studentModel) {
        $this->studentModel = $studentModel;
    }

    

    public function allStudents(){
        return $this->studentModel->all();
    }
}