<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyamMasuk extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ayam_masuks";
    protected $primaryKey = "idAyamMasuk";
    protected $fillable = ['idAyam', 'penerima', 'qtyMasuk'];
}
