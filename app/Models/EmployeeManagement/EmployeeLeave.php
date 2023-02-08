<?php

namespace App\Models\EmployeeManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function PurposeName(){
        return $this->belongsTo(LeavePurpose::class,'leave_purpose_id','id');

    }
    public function EmployeeName(){
        return $this->belongsTo(User::class,'emp_id','id');
    }
}
