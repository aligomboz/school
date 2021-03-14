<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['name_section'];
    protected $fillable=['name_section','grade_id','class_id'];
    
    public function my_classs()
    {
        return $this->belongsTo(Classroom::class, 'class_id' , 'id');
    }
}
