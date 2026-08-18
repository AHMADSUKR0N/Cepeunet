<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

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

                Select::make('paket')
                    ->options([
                        '5 Mbps' => '5 Mbps',
                        '15 Mbps' => '15 Mbps',
                        '20 Mbps' => '20 Mbps',
                        '25 Mbps' => '25 Mbps',
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