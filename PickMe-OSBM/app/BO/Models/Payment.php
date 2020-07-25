<?php

namespace App\BO\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = "payment";
    protected $primaryKey = "id";

    protected $fillable = [
        'enrollment_id', 'collected_by', 'is_paid', 'paid_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

}
