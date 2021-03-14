<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentAttachment extends Model
{
    protected $fillable = [
        'parent_id' , 'fileName',
    ];
}
