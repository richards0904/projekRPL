<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokPakan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "stok_pakans";
    protected $primaryKey = "idPakan";
    protected $fillable = ['merekPakan', 'deskripsi', 'stokPakan'];
}
