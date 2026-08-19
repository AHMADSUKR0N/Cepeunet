<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Afsakar\LeafletMapPicker\LeafletMapPicker;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),

                TextInput::make('no_hp')
                    ->tel()
                    ->maxLength(20),

                TextInput::make('email')
                    ->email()
                    ->maxLength(255),

                Textarea::make('alamat')
                    ->columnSpanFull(),

                LeafletMapPicker::make('location')
                    ->label('Titik Lokasi Client')
                    ->helperText('Klik tombol GPS untuk mengambil lokasi saat ini, atau geser pin secara manual pada peta.')
                    ->height('300px')
                    ->defaultLocation(['lat' => -6.5900, 'lng' => 110.6700])
                    ->defaultZoom(13)
                    ->draggable()
                    ->clickable()
                    ->myLocationButtonLabel('Ambil Lokasi Saya (GPS)')
                    ->columnSpanFull(),

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
                            ->required()
                            ->maxLength(255),

                        Textarea::make('lokasi')
                            ->label('Deskripsi Lokasi')
                            ->columnSpanFull(),

                        LeafletMapPicker::make('location')
                            ->label('Titik Lokasi ODP')
                            ->height('300px')
                            ->defaultLocation(['lat' => -6.5900, 'lng' => 110.6700])
                            ->defaultZoom(13)
                            ->draggable()
                            ->clickable()
                            ->myLocationButtonLabel('Ambil Lokasi Saya (GPS)')
                            ->columnSpanFull(),

                        TextInput::make('kapasitas')
                            ->label('Kapasitas (jumlah port)')
                            ->numeric()
                            ->required()
                            ->default(8),

                        Textarea::make('keterangan')
                            ->columnSpanFull(),
                    ])
                    ->createOptionModalHeading('Tambah ODP Baru'),

                TextInput::make('wilayah')
                    ->maxLength(255),

                Select::make('paket')
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
                    ->numeric()
                    ->prefix('Rp'),

                DatePicker::make('tanggal_pasang'),

                Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Non-aktif',
                        'suspend' => 'Suspend',
                    ])
                    ->default('aktif')
                    ->required(),

                TextInput::make('no_sn_modem')
                    ->label('No. SN Modem'),

                Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }
}