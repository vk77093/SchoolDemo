<?php

namespace App\Models\StudentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassManagement extends Model
{
    use HasFactory;
    protected $fillable=['class_name'];
}
