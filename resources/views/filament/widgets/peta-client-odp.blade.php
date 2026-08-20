<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Peta Client & ODP
        </x-slot>

        <div 
            x-data="{
                markers: @js($markers),
                initMap() {
                    if (typeof L === 'undefined') {
                        setTimeout(() => this.initMap(), 200);
                        return;
                    }

                    const el = this.$refs.mapContainer;
                    if (!el || el._leaflet_id) return;

                    const map = L.map(el).setView([-6.5900, 110.6700], 12);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(map);

                    setTimeout(() => { map.invalidateSize(); }, 300);

                    const bounds = [];

                    if (Array.isArray(this.markers) && this.markers.length > 0) {
                        this.markers.forEach((m) => {
                            if (!m.lat || !m.lng) return;

                            const color = m.tipe === 'odp' ? '#f59e0b' : '#ef4444';

                            const icon = L.divIcon({
                                className: '',
                                html: `<div style='background:${color};width:16px;height:16px;border-radius:50%;border:2px solid white;box-shadow: 0 0 4px rgba(0,0,0,0.4);'></div>`,
                                iconSize: [16, 16],
                            });

                            L.marker([m.lat, m.lng], { icon })
                                .addTo(map)
                                .bindPopup(`<strong>${m.nama}</strong><br>Tipe: ${m.tipe.toUpperCase()}`);

                            bounds.push([m.lat, m.lng]);
                        });

                        if (bounds.length > 0) {
                            map.fitBounds(bounds, { padding: [40, 40] });
                        }
                    }
                }
            }"
            x-init="initMap()"
            wire:ignore
        >
            <div x-ref="mapContainer" style="height: 450px; width: 100%; border-radius: 0.5rem; z-index: 1;"></div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>