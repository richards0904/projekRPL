<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakanKeluar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "pakan_keluars";
    protected $primaryKey = "idPakanKeluar";
    protected $fillable = ['idPakan', 'pemakai', 'qtyKeluar'];
}
