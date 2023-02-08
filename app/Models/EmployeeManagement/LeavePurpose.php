<?php

namespace App\Models\EmployeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavePurpose extends Model
{
    use HasFactory;
    protected $fillable=['purpose_name'];
}
