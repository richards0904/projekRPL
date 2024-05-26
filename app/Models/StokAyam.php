<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokAyam extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    public $timestamps = false;
    protected $table = "stok_ayams";
    protected $primaryKey = "idAyam";
    protected $fillable = ['jenisAyam', 'deskripsi', 'stok', 'hargajual', 'image'];
}
