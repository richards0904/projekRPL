<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    public $timestamps = false;
    protected $table = "pesanans";
    protected $primaryKey = "idPesanan";
    protected $fillable = ['id', 'idAyam', 'tglPesan', 'jumlahBeli', 'status', 'total'];
}
