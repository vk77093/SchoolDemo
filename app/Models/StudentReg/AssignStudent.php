<?php

namespace App\Models\StudentReg;

use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\ShiftManagement;
use App\Models\StudentManagement\StudentGroup;
use App\Models\StudentManagement\Year;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AssignStudent extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function YearName(){
        return $this->belongsTo(Year::class,'year_id','id');
    }
    public function ClassName(){
        return $this->belongsTo(ClassManagement::class,'class_id','id');
    }
    public function UserName(){
        return $this->belongsTo(User::class,'stu_id','id');
    }
    public function GroupName(){
        return $this->belongsTo(StudentGroup::class,'group_id','id');
    }
    public function ShiftName(){
        return $this->belongsTo(ShiftManagement::class,'shift_id','id');
    }
    public function discount(){
    	return $this->belongsTo(Discount::class,'id','ass_stu_id');
    }
}
