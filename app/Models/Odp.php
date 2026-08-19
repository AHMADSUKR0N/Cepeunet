<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Odp extends Model
{
    protected $fillable = [
    'nama_odp', 'wilayah', 'lokasi', 'location', 'kapasitas', 'keterangan',
];

protected $casts = [
    'location' => 'array',
];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    // Helper: sisa slot yang masih kosong di ODP ini
    public function getSisaSlotAttribute(): int
    {
        return $this->kapasitas - $this->clients()->count();
    }
}