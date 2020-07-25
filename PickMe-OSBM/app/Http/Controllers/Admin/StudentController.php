<?php

namespace App\Http\Controllers\Admin;

use App\BO\Services\StudentService;
use App\BO\Services\CourseService;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use App\BO\Models\Enrollment;
use App\BO\Models\Payment;

class StudentController {

    protected $studentService, $courseService;
    public function __construct(StudentService $studentService, CourseService $courseService) {
        $this->studentService = $studentService;
        $this->courseService = $courseService;
    }

    public function index(){

        $data['studentData'] = $this->studentService->allStudents();
        return view('admin.student.index', $data);
    }

    public function verifyStudent(int $student_id){

        $verifyStatus = $this->studentService->verifyStudent($student_id);
        if($verifyStatus){
            return redirect()->route('studentMgt')->with('success', 'Student verified..');
        } else {
            return redirect()->route('studentMgt')->with('success', 'Student verification failed..');
        }
    }

    public function deleteStudent(int $student_id){

        $verifyStatus = $this->studentService->deleteStudent($student_id);
        if($verifyStatus){
            return redirect()->route('studentMgt')->with('success', 'Student verified..');
        } else {
            return redirect()->route('studentMgt')->with('success', 'Student verification failed..');
        }
    }

    public function enrollStudentToCourses(int $student_id){
        $data['studentData'] = $this->studentService->getStudentById($student_id);
        $data['courses'] = $this->courseService->allCourses();
        // dd($data);
        return view('admin.student.enroll', $data);
    }

    public function completeEnrollment(int $student_id, int $course_id, Request $request){
        $slctdStudent = $this->studentService->getStudentById($student_id);
        $slctdStudent->courses()->attach([
            "course_id" => $course_id 
        ]);

        $enrollment = Enrollment::where(["student_id" => $student_id, "course_id" => $course_id])->get();
        if(isset($enrollment[0])){
            $enrollment[0]->update([
                "year" => $request->year,
                "enrolled_by" => Auth::user()->id,
                "enrollment_date" => new DateTime('now'),
                "marks" => null
            ]);
            Payment::create([
                "enrollment_id" => $enrollment[0]->id
            ]);
        }
        return redirect()->route('studentMgt')->with('success', 'Student verification failed..');
        
    }
}