<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends User
{
    use HasFactory;
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('students', function (Builder $builder) {
            $builder->where('role', 'student');
        });
    }

}
