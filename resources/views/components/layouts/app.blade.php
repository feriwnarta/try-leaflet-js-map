<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/icon.css')}}">
        <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <style>
            .map {
                position: absolute;
                width: 100%;
                height: 100%;
            }
        </style>
    </head>
    <body>
        {{ $slot }}
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="{{ asset('leaflet/leaflet.js') }}"></script>
        <script src="{{ asset('leaflet/routing-machine.js') }}"></script>
        <script src="{{ asset('js/maps-template.js') }}"></script>

        <script>
            var map = L.map('map', {
                renderer: L.svg(),
                center: [-6.2, 106.8], // Posisi awal di Indonesia
                zoom: 8,
            });

            L.tileLayer.provider('OpenStreetMap.HOT').addTo(map);



            // Buat instance RoutingMachine
            var routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(-6.171220, 106.681664), // Waypoint pertama
                    L.latLng(-6.152721, 106.62), // Waypoint kedua
                    L.latLng(-6.153290, 106.624580) // Waypoint kedua
                ],
                routeWhileDragging: true,

                allowNegativeLat: true, // Aktifkan dukungan nilai latitude negatif

                // Ubah warna rute menjadi biru
                lineOptions: {
                    styles: [{
                        color: 'blue'
                    }]
                },
                // Set showInstructions ke false
                showInstructions: false,
                // Set draggable waypoint ke false
                draggableWaypoints: false
            }).addTo(map).hide();









        </script>
    </body>
</html>
