<?php

namespace App\Filament\Resources\Odps;

use App\Filament\Resources\Odps\Pages\CreateOdp;
use App\Filament\Resources\Odps\Pages\EditOdp;
use App\Filament\Resources\Odps\Pages\ListOdps;
use App\Filament\Resources\Odps\Pages\ViewOdp;
use App\Filament\Resources\Odps\Schemas\OdpForm;
use App\Filament\Resources\Odps\Schemas\OdpInfolist;
use App\Filament\Resources\Odps\Tables\OdpsTable;
use App\Models\Odp;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OdpResource extends Resource
{
    protected static ?string $model = Odp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return OdpForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OdpInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OdpsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOdps::route('/'),
            'create' => CreateOdp::route('/create'),
            'view' => ViewOdp::route('/{record}'),
            'edit' => EditOdp::route('/{record}/edit'),
        ];
    }
}
