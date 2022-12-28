<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabel extends Model
{
    use HasFactory;
    protected $table = 'tabel';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
