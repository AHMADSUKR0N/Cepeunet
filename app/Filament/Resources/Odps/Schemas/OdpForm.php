<?php

namespace App\Filament\Resources\Odps\Schemas;

use Afsakar\LeafletMapPicker\LeafletMapPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OdpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nama_odp')
                    ->label('Nama ODP')
                    ->required()
                    ->maxLength(255),

                TextInput::make('wilayah')
                    ->label('Wilayah')
                    ->required()
                    ->maxLength(255),

                TextInput::make('kapasitas')
                    ->label('Kapasitas Port')
                    ->required()
                    ->numeric()
                    ->default(8),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull(),

                LeafletMapPicker::make('location')
                    ->label('Titik Lokasi ODP')
                    ->helperText(
                        'Gunakan GPS jika berada di lokasi ODP, atau pilih titik secara manual pada peta.'
                    )
                    ->height('400px')
                    ->defaultLocation([
                        'lat' => -6.5900,
                        'lng' => 110.6700,
                    ])
                    ->defaultZoom(13)
                    ->draggable()
                    ->clickable()
                    ->showCoordinateInputs()
                    ->myLocationButtonLabel('Ambil Lokasi Saya (GPS)')
                    ->geolocationHighAccuracy()
                    ->geolocationTimeout(10000)
                    ->tileProvider('openstreetmap')
                    ->columnSpanFull(),

            ]);
    }
}