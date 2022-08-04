<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndidvidualVendorModel extends Model
{
    use HasFactory;
    protected $table = 'individualvendors';
    public $timestamps = false;
    protected $guarded = [];
}
