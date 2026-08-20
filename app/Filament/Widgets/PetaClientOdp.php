<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Odp;
use Filament\Widgets\Widget;

class PetaClientOdp extends Widget
{
    protected string $view = 'filament.widgets.peta-client-odp';

    protected int | string | array $columnSpan = 'full';

    public function getMarkers(): array
    {
        $markers = [];

        // Ambil data ODP yang kolom 'location'-nya tidak kosong
        $odps = Odp::whereNotNull('location')->get();
        foreach ($odps as $odp) {
            // Kolom 'location' biasanya berupa array ['lat' => ..., 'lng' => ...] 
            // atau string JSON jika belum di-cast di Model
            $loc = is_array($odp->location) ? $odp->location : json_decode($odp->location, true);

            if (!empty($loc['lat']) && !empty($loc['lng'])) {
                $markers[] = [
                    'nama' => $odp->nama ?? 'ODP ' . $odp->id,
                    'lat' => (float) $loc['lat'],
                    'lng' => (float) $loc['lng'],
                    'tipe' => 'odp',
                ];
            }
        }

        // Ambil data Client
        $clients = Client::whereNotNull('location')->get();
        foreach ($clients as $client) {
            $loc = is_array($client->location) ? $client->location : json_decode($client->location, true);

            if (!empty($loc['lat']) && !empty($loc['lng'])) {
                $markers[] = [
                    'nama' => $client->nama,
                    'lat' => (float) $loc['lat'],
                    'lng' => (float) $loc['lng'],
                    'tipe' => 'client',
                ];
            }
        }

        return $markers;
    }

    protected function getViewData(): array
    {
        return [
            'markers' => $this->getMarkers(),
        ];
    }
}