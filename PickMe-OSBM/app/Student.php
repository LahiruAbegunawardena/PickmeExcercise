<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\BO\Models\Course;
use App\BO\Models\Enrollment;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{
    use Notifiable, HasApiTokens;

    protected $table = 'student';
    protected $guard = 'student';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_verified', 'is_deleted', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Many to Many ralationship with "Course" table and Creates "Enrollment" table
    public function courses()
    {
        return $this->belongsToMany(Course::class, Enrollment::class)->withPivot('id', 'marks', 'year', 'enrollment_date');
    }
}
