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
TextColumn::make('location')
    ->label('Lokasi')
    ->getStateUsing(function ($record) {
        $loc = $record->location;

        if (is_string($loc)) {
            $loc = json_decode($loc, true);
        }

        $lat = $loc['lat'] ?? $loc['latitude'] ?? null;
        $lng = $loc['lng'] ?? $loc['longitude'] ?? null;

        if ($lat && $lng) {
            return "{$lat}, {$lng}";
        }

        return 'Belum diatur';
    })
    ->url(function ($record) {
        $loc = $record->location;

        if (is_string($loc)) {
            $loc = json_decode($loc, true);
        }

        $lat = $loc['lat'] ?? $loc['latitude'] ?? null;
        $lng = $loc['lng'] ?? $loc['longitude'] ?? null;

        if (!$lat || !$lng) {
            return null;
        }

        // Format URL Google Maps yang akurat
        return "https://www.google.com/maps/search/?api=1&query={$lat},{$lng}";
    })
    ->openUrlInNewTab()
    ->color(fn ($record) => !empty($record->location) ? 'primary' : 'gray')
    ->icon(fn ($record) => !empty($record->location) ? 'heroicon-m-map-pin' : null),
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