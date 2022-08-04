<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientMainModel extends Model
{
    use HasFactory;
    protected $table = 'clientmains';
    public $timestamps = false;
    protected $guarded = [];
}
