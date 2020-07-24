<?php

namespace App\Http\Controllers\Admin;

use App\BO\StudentRepository;

class AdminController {

    protected $studentRepo;
    public function __construct(StudentRepository $studentRepository) {
        $this->studentRepo = $studentRepository;
    }

    public function index(){

        $data['studentData'] = $this->studentRepo->allStudents();
        return view('admin.home', $data);
    }
}