<?php

namespace App\Models\MarksManagement;

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
}
