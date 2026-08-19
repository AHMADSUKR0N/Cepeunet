<?php

namespace App\Filament\Resources\Odps\Pages;

use App\Filament\Resources\Odps\OdpResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOdp extends ViewRecord
{
    protected static string $resource = OdpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
