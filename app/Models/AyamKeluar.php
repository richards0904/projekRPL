<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyamKeluar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ayam_keluars";
    protected $primaryKey = "idAyamKeluar";
    protected $fillable = ['idAyam', 'penjual', 'qtyKeluar'];
}
