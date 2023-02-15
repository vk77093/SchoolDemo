<?php

namespace App\Models\MarksManagement;

use App\Models\StudentManagement\AssignSubject;
use App\Models\StudentManagement\ClassManagement;
use App\Models\StudentManagement\ExamType;
use App\Models\StudentManagement\Year;
use App\Models\StudentReg\AssignStudent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StudentMarks extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    
    public function UserName(){
        return $this->belongsTo(User::class,'stu_id','id');
    }
    public function AssignedSubjectName(){
        return $this->belongsTo(AssignSubject::class,'assign_subject_id','id');
    }
    public function YearName(){
        return $this->belongsTo(Year::class,'year_id','id');
    }
    public function ExamTypeName(){
        return $this->belongsTo(ExamType::class,'exam_type_id','id');
    }
    public function AssignedStudent(){
        return $this->belongsTo(AssignStudent::class,'stu_id','stu_id');
    }
    public function ClassName(){
        return $this->belongsTo(ClassManagement::class,'class_id','id');
    }
}
