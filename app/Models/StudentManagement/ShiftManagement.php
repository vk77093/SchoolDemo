<?php

namespace App\Models\StudentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftManagement extends Model
{
    use HasFactory;
    protected $fillable=['shift_name'];
}
