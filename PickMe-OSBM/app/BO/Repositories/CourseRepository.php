<?php

namespace App\BO\Repositories;

use App\BO\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CourseRepository {
 
    protected $courseModel;
    public function __construct(Course $courseModel) {
        $this->courseModel = $courseModel;
    }

    public function allCourses(){
        return $this->courseModel->all();
    }

    public function storeCourse(Request $request){
        try {
            $courseData = array(
                "course_name" => isset($request->course_name) ? $request->course_name : "",
                "course_code" => isset($request->course_code) ? $request->course_code : "",
                "course_fee" => isset($request->course_fee) ? (double)$request->course_fee : null,
                "credits" => isset($request->credits) ? (int)$request->credits : 2
            );
            $newCourse = $this->courseModel->create($courseData);
            if(isset($newCourse)){
                return $newCourse;
            } else {
                return null;
            }
        } catch (QueryException $ex) {
            throw $ex;
        }
        
    }
}