<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'transaksi';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'keterangan',
        'jumlah',
        'jenis',
        'tanggal',
    ];
}
