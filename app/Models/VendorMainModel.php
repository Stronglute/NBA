<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorMainModel extends Model
{
    use HasFactory;
    protected $table = 'vendormains';
    public $timestamps = false;
    protected $guarded = [];
}
