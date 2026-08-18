<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama'),
                TextEntry::make('no_hp'),
                TextEntry::make('email'),
                TextEntry::make('alamat'),
                TextEntry::make('paket')->badge(),
                TextEntry::make('harga')->money('IDR'),
                TextEntry::make('tanggal_pasang')->date('d M Y'),
                TextEntry::make('status')->badge(),
                TextEntry::make('no_sn_modem')->label('No. SN Modem'),
                TextEntry::make('catatan'),
            ]);
    }
}