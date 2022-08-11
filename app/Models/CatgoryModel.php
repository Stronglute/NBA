<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatgoryModel extends Model
{
    use HasFactory;
    protected $table = 'catgory';
    public $timestamps = false;
    protected $guarded = [];
}
