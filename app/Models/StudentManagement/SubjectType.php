<?php

namespace App\Models\StudentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectType extends Model
{
    use HasFactory;
    protected $fillable=['subject_name'];
}
