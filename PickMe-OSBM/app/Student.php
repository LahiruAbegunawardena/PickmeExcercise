<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\BO\Models\Course;
use App\BO\Models\Enrollment;

class Student extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'student';
    protected $guard = 'student';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_verified', 'is_deleted'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, Enrollment::class);
    }
}
