<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugModel extends Model
{
    use HasFactory;
    protected $table = 'slug';
    public $timestamps = false;
    protected $guarded = [];
}
