<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nama', 'no_hp', 'email', 'alamat', 'paket',
        'harga', 'tanggal_pasang', 'status', 'no_sn_modem', 'catatan',
    ];

    protected $casts = [
        'tanggal_pasang' => 'date',
        'harga' => 'decimal:2',
    ];
}
