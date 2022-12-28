<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baris extends Model
{
    use HasFactory;
    protected $table = 'baris';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
