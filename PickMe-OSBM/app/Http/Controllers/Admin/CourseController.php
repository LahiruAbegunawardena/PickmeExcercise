<?php

namespace App\Http\Controllers\Admin;

use App\BO\Services\CourseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller {

    protected $courseService;
    public function __construct(CourseService $courseService) {
        $this->courseService = $courseService;
    }

    public function index(){

        $data['courseData'] = $this->courseService->allCourses();
        // dd($data);
        return view('admin.course.index', $data);
    }

    public function create(){
        return view('admin.course.create');
    }

    public function store(Request $request){

        $validation = Validator::make($request->all(), [
            'course_name' => 'required|string|max:255',
            'course_code' => 'required',
            'credits' => 'required'
        ]);
        if($validation->fails()){
            // dd($validation->errors());
            return response()->json([
                'message' => 'validation failed',
                'data' => $validation->errors()
            ]); 

        } else {
            $newCourse = $this->courseService->storeCourse($request);
            if(isset($newCourse)){
                return redirect()->route('courseMgt')->with('success', 'New Course created..');
            } else {
                return redirect()->route('courseCreate')->with('warning', 'Failed course creation..');
            }
        }
        
    }
}