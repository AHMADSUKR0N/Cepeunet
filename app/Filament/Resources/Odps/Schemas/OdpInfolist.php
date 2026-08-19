<?php

namespace App\Filament\Resources\Odps\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OdpInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_odp')->label('Nama ODP'),
                TextEntry::make('wilayah'),
                TextEntry::make('lokasi'),
                TextEntry::make('kapasitas'),
                TextEntry::make('clients_count')
                    ->label('Client Terpasang')
                    ->state(fn ($record) => $record->clients()->count()),
                TextEntry::make('keterangan'),
            ]);
    }
}