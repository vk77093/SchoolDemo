<?php

namespace App\Models\AccountManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountEmployeeSalary extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    
    public Function EmployeeName(){
        return $this->belongsTo(User::class,'emp_id','id');
    }
    
}
