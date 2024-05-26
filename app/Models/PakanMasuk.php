<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakanMasuk extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "pakan_masuks";
    protected $primaryKey = "idPakanMasuk";
    protected $fillable = ['idPakan', 'penerima', 'qtyMasuk'];
}
