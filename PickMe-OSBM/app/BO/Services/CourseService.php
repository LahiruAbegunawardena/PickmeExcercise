<?php

namespace App\BO\Services;

use App\Student;
use App\CommonBase\Service;
use App\BO\Repositories\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\BO\Transformations\CourseTransformable;

class CourseService extends Service {

    use CourseTransformable;
    protected $courseRepo;
    public function __construct(CourseRepository $courseRepository) {
        $this->courseRepo = $courseRepository;
    }
 
    public function allCourses(){
        $courses = $this->courseRepo->allCourses();
        $courseData = [];
        foreach($courses as $course){
            $courseData[] = $this->transformCoursetDet($course);
        }
        return $courseData;
    }

    public function storeCourse(Request $request){
        $courses = $this->courseRepo->storeCourse($request);
        return $courses;
    }
}