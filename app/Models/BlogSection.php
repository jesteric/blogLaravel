<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogSection extends Model
{
    protected $fillable = [
        'title',
        'description',
        'parent_id'
    ];
}
