<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Course extends Model
{

    protected $table = "course";
    protected $primaryKey = "id";

    protected $fillable = [
        'course_name', 'course_code', 'credits', 'course_fee'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, Enrollment::class);
    }

}
