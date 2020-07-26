<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;
use App\BO\Models\Payment;

class Enrollment extends Model
{

    protected $table = "enrollment";
    protected $primaryKey = "id";

    protected $fillable = [
        'student_id', 'course_id', 'enrolled_by', 'year', 'enrollment_date', 'marks'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

}
