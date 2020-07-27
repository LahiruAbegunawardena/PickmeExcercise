<?php

namespace App\BO\Transformations;

use App\Student;

trait StudentTransformable
{
    public function transformStudentDet(Student $student)
    {
        $enrolledCourseId = [];
        $obj = new Student();
        $obj->id = $student->id;
        $obj->first_name = $student->first_name;
        $obj->last_name = $student->last_name;
        $obj->email = $student->email;
        $obj->is_verified = $student->is_verified;
        $obj->verify_status = ($student->is_verified == 1) ? "Verified" : "Not Verified";
        $obj->enrolledCourses = $student->courses;
        foreach($student->courses as $course){
            $enrolledCourseId[] = $course->id;
        }

        $obj->enrolledCourseId = $enrolledCourseId;

        return $obj;
    }

    public function transformStudentDetApi(Student $student)
    {
        $selectedCourses = $student->courses;
        
        $returnData = [];
        foreach ($selectedCourses as $key => $course) {
            $returnData[] = [
                "course_id" => $course->id,
                "course_name" => $course->course_name,
                "credits" => $course->credits,
                "course_fee" => $course->course_fee,
                "course_year" => $course->pivot->year,
                "enrolled_date" => $course->pivot->enrollment_date,
                "course_marks" => isset($course->pivot->marks) ? $course->pivot->marks : "Not marked yet"
            ];
        }
        return $returnData;
    }

}
