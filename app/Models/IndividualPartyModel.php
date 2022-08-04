<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualPartyModel extends Model
{
    use HasFactory;
    protected $table = 'individualparty';
    public $timestamps = false;
    protected $guarded = [];
}
