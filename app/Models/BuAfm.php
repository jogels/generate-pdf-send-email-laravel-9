<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuAfm extends Model
{
    use HasFactory;
    protected $table = 'bu_afm';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
