<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable=['name','note'];

    public function sections(){
        return $this->hasMany(Section::class , 'grade_id' , 'id');
    }
}
