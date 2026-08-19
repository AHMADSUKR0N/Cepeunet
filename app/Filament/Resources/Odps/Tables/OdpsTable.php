<?php

namespace App\Filament\Resources\Odps\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OdpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_odp')
                    ->label('Nama ODP')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('wilayah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kapasitas')
                    ->sortable(),

                TextColumn::make('clients_count')
                    ->counts('clients')
                    ->label('Terpakai')
                    ->badge()
                    ->color(fn ($record) => $record->clients_count >= $record->kapasitas ? 'danger' : 'success'),

                TextColumn::make('lokasi')
    ->label('Lokasi')
    ->limit(30)
    ->formatStateUsing(function ($state, $record) {
    dd('KODE INI JALAN', $state, $record->location);
})
    ->url(function ($record) {
        $loc = $record->location;

        if (is_string($loc)) {
            $loc = json_decode($loc, true);
        }

        if (! is_array($loc) || ! isset($loc['lat'], $loc['lng'])) {
            return null;
        }

        return 'https://www.google.com/maps?q=' . $loc['lat'] . ',' . $loc['lng'];
    })
    ->openUrlInNewTab()
    ->color(fn ($record) => $record->location ? 'primary' : null)
    ->icon(fn ($record) => $record->location ? 'heroicon-m-map-pin' : null),
            ])
            ->filters([
                SelectFilter::make('wilayah')
                    ->options(fn () => \App\Models\Odp::query()->distinct()->pluck('wilayah', 'wilayah')->toArray()),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}