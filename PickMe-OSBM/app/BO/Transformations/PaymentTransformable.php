<?php

namespace App\BO\Transformations;

use App\BO\Models\Payment;
use App\BO\Models\Course;
use App\Student;
use App\BO\Repostories\StudentRepository;

trait PaymentTransformable
{
    
    public function transformPaymentDet(Payment $payment)
    {
        $obj = $payment;
        $enrollment = $payment->enrollment;
        $course = Course::find($enrollment->course_id);
        $student = Student::find($enrollment->student_id);
        $obj->paid_status = ($payment->is_paid == 1) ? "Paid" : "Not Paid";

        $obj->enrollment = $enrollment;
        $obj->enrolledCourse = $course->course_name;
        $obj->enrolledStudent = $student->first_name." ".$student->last_name;

        return $obj;
    }

}
