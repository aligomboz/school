<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasTranslations;
    public $translatable = ['NameFather','JobFather','NameMother','JobMother'];
    protected $table = 'my_parents';
    protected $guarded=[];

}
