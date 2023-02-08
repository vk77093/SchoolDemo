<?php

namespace App\Models\EmployeeManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendence extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function UserName(){
        return $this->belongsTo(User::class,'emp_id','id');
    }
}
