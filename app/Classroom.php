<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['NameClass'];
    protected $fillable=['NameClass','grade_id'];

    public function grades()
    {
        return $this->belongsTo(Grade::class , 'grade_id' , 'id');
    }
}
