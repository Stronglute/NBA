<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapProductionModel extends Model
{
    use HasFactory;
    protected $table = 'capproduction';
    public $timestamps = false;
    protected $guarded = [];
}
