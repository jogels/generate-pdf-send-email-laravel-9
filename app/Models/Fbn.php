<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fbn extends Model
{
    use HasFactory;
    protected $table = 'fbn';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
