<?php

namespace App\BO\Services;

use App\Student;
use App\BO\Models\Enrollment;
use App\BO\Models\Course;
use App\CommonBase\Service;
use App\BO\Repositories\StudentRepository;
// use App\BO\Repositories\EnrollmentRepository;
use App\BO\Transformations\StudentTransformable;
use App\BO\Transformations\PaymentTransformable;

class StudentService extends Service {

    use StudentTransformable;
    use PaymentTransformable;
    protected $studentRepo;
    // protected $enrollmentRepository;
    public function __construct(StudentRepository $studentRepository) {
        $this->studentRepo = $studentRepository;
        // $this->enrollmentRepository = $enrollmentRepository;
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

    public function getPaymentListByStudentId(int $student_id){
        $student = $this->studentRepo->getStudentById($student_id);
        $returnData = [];
        foreach ($student->courses as $key => $followedCourse) {
            $enrollId = $followedCourse->pivot->id;
            $enrollmentData = Enrollment::find($followedCourse->pivot->id);
            $paymentData = $enrollmentData->payments;
            $returnData[] = $this->transformPaymentDetApi($followedCourse, $paymentData);
        }
        return $returnData;
    }
}