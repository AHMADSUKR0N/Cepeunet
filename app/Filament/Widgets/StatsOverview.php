<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Odp;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalClient = Client::count();
        $clientAktif = Client::where('status', 'aktif')->count();
        $totalOdp = Odp::count();

        return [
            Stat::make('Total Client', $totalClient)
                ->description('Semua client terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Client Aktif', $clientAktif)
                ->description('Client dengan status aktif')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Total ODP', $totalOdp)
                ->description('Titik distribusi terpasang')
                ->descriptionIcon('heroicon-m-signal')
                ->color('warning'),
        ];
    }
}