<?php

namespace App\Filament\Resources\Clients\Schemas;

use Afsakar\LeafletMapPicker\LeafletMapPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // =========================
                // DATA CLIENT
                // =========================
                Section::make('Data Client')
                    ->description('Informasi dasar pelanggan')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Client')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('no_hp')
                            ->label('Nomor HP')
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('wilayah')
                            ->label('Wilayah')
                            ->maxLength(255),

                        Textarea::make('alamat')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                // =========================
                // LOKASI CLIENT
                // =========================
                Section::make('Lokasi Client')
                    ->description('Tentukan lokasi client menggunakan GPS atau pilih titik secara manual pada peta.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([

                        LeafletMapPicker::make('location')
                            ->label('Titik Lokasi Client')
                            ->helperText(
                                'Jika berada di lokasi client, gunakan tombol GPS. Jika tidak, klik atau geser marker ke lokasi rumah client.'
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

                    ]),

                // =========================
                // LAYANAN INTERNET
                // =========================
                Section::make('Layanan Internet')
                    ->description('Informasi paket dan ODP client')
                    ->icon('heroicon-o-wifi')
                    ->schema([

                        Select::make('odp_id')
                            ->label('ODP')
                            ->relationship('odp', 'nama_odp')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([

                                TextInput::make('nama_odp')
                                    ->label('Nama ODP')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('wilayah')
                                    ->label('Wilayah')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('lokasi')
                                    ->label('Deskripsi Lokasi')
                                    ->columnSpanFull(),

                                LeafletMapPicker::make('location')
                                    ->label('Titik Lokasi ODP')
                                    ->height('300px')
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

                                TextInput::make('kapasitas')
                                    ->label('Kapasitas Port')
                                    ->numeric()
                                    ->required()
                                    ->default(8),

                                Textarea::make('keterangan')
                                    ->label('Keterangan')
                                    ->columnSpanFull(),

                            ])
                            ->createOptionModalHeading('Tambah ODP Baru'),

                        Select::make('paket')
                            ->label('Paket Internet')
                            ->options([
                                '5 Mbps' => '5 Mbps',
                                '15 Mbps' => '15 Mbps',
                                '20 Mbps' => '20 Mbps',
                                '25 Mbps' => '25 Mbps',
                                '30 Mbps' => '30 Mbps',
                                '35 Mbps' => '35 Mbps',
                                '40 Mbps' => '40 Mbps',
                            ])
                            ->required(),

                        TextInput::make('harga')
                            ->label('Harga Langganan')
                            ->numeric()
                            ->prefix('Rp'),

                        Select::make('status')
                            ->label('Status Client')
                            ->options([
                                'aktif' => 'Aktif',
                                'nonaktif' => 'Non-aktif',
                                'suspend' => 'Suspend',
                            ])
                            ->default('aktif')
                            ->required(),

                        DatePicker::make('tanggal_pasang')
                            ->label('Tanggal Pasang'),

                    ])
                    ->columns(2),

                // =========================
                // PERANGKAT
                // =========================
                Section::make('Perangkat')
                    ->description('Informasi perangkat yang digunakan client')
                    ->icon('heroicon-o-server')
                    ->schema([

                        TextInput::make('no_sn_modem')
                            ->label('Nomor SN Modem')
                            ->maxLength(255),

                        Textarea::make('catatan')
                            ->label('Catatan')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

            ]);
    }
}