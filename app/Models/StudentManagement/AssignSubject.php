<?php

namespace App\Models\StudentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function ClassName(){
        return $this->belongsTo(ClassManagement::class,'class_id','id');
    }
    public function SubjectName(){
        return $this->belongsTo(SubjectType::class,'subject_id','id');
    }
}
