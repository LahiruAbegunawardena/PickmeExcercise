<?php

namespace App\BO\Repositories;

use Auth;
use Carbon\Carbon;
use App\BO\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EnrollmentRepository {
 
    protected $enrollmentModel;
    public function __construct(Enrollment $enrollmentModel) {
        $this->enrollmentModel = $enrollmentModel;
    }

    public function getEnrollmentById($enrollmentId){
        return Enrollment::find($enrollmentId);
    }
}