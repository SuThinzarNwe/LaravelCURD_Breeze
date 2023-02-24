<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsToMany(Student::class, 'students_categories');
        //return $this->belongsToMany(Student::class, 'category_student', 'category_id', 'student_id');
    }
}
