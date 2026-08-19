<?php

namespace App\Filament\Resources\Odps\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Afsakar\LeafletMapPicker\LeafletMapPicker;

class OdpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_odp')
                    ->required(),
                TextInput::make('wilayah')
                    ->required(),
                TextInput::make('kapasitas')
                    ->required()
                    ->numeric()
                    ->default(8),
                Textarea::make('keterangan')
                    ->default(null)
                    ->columnSpanFull(),
                LeafletMapPicker::make('location')
                  ->label('Titik Lokasi Client')
                  ->height('400px')
                  ->defaultLocation(['lat' => -6.5900, 'lng' => 110.6700]) // koordinat default: Jepara
                  ->defaultZoom(13)
                  ->draggable()
                  ->clickable()
                  ->showCoordinateInputs() // munculkan input lat/lng manual juga, jaga-jaga GPS gagal
                  ->myLocationButtonLabel('Ambil Lokasi Saya (GPS)')
                  ->geolocationHighAccuracy()
                  ->geolocationTimeout(10000)
                  ->tileProvider('openstreetmap')
                  ->columnSpanFull(),
            ]);
    }
}
