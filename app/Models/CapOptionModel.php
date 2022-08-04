<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapOptionModel extends Model
{
    use HasFactory;
    protected $table = 'capoption';
    public $timestamps = false;
    protected $guarded = [];
}
