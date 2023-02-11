<?php

namespace App\Models\AccountManagement;

use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\FeeCategory;
use App\Models\StudentManagement\Year;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StudentFee extends Model
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
    public function FeeCategoryName(){
        return $this->belongsTo(FeeCategory::class,'fee_cate_id','id');
    }
}
