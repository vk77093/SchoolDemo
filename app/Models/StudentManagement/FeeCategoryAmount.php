<?php

namespace App\Models\StudentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    use HasFactory;
    protected $fillable=['class_id','cate_amount','fee_cate_id'];
    public function Category(){
        return $this->belongsTo(FeeCategory::class,'fee_cate_id','id');
    }
    public function ClassName(){
        return $this->belongsTo(ClassManagement::class,'class_id','id');
    }
    
}
