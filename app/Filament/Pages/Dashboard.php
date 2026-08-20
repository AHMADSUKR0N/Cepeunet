<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\ClientChart;
use App\Filament\Widgets\PetaClientOdp;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ClientChart::class,
            PetaClientOdp::class,
        ];
    }
}