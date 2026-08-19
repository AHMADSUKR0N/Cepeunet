<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    protected $fillable = [
    'odp_id', 'nama', 'no_hp', 'email', 'alamat', 'wilayah',
    'location', 'paket', 'harga', 'tanggal_pasang',
    'status', 'no_sn_modem', 'catatan',
];

protected $casts = [
    'tanggal_pasang' => 'date',
    'harga' => 'decimal:2',
    'location' => 'array', // otomatis di-decode jadi ['lat' => ..., 'lng' => ...]
];

    public function odp(): BelongsTo
    {
        return $this->belongsTo(Odp::class);
    }
}