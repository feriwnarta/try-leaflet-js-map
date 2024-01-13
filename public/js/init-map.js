$(() => {
    initMaps();

});


function initMaps() {
    // Buat map dengan posisi awal dan zoom level yang sesuai
    var map = L.map('map', {
        renderer: L.svg(),
        center: [-6.2, 106.8], // Posisi awal di Indonesia
        zoom: 8,
        // Set tinggi dan lebar peta

    });

// Tambahkan tile layer OpenStreetMap
    L.tileLayer.provider('OpenStreetMap.HOT').addTo(map);

// Buat instance RoutingMachine
    var routingControl = L.Routing.control({
        profile: "cycling",
        options: {
            weighting: "fastest",
        },
        waypoints: [
            L.latLng(-6.171220, 106.681664), // Waypoint pertama
            L.latLng(-6.152721, 106.62), // Waypoint kedua
            L.latLng(-6.153290, 106.624580) // Waypoint ketiga

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
        draggableWaypoints: false,
    });

    routingControl.addTo(map).hide();



    routingControl.on('routesfound', function(e) {
        var routes = e.routes;
        var summary = routes[0].summary;

        console.log(routes);



        // alert distance and time in km and minutes
        console.log('Total distance is ' + summary.totalDistance / 1000 + ' km and total time is ' + Math.round(summary.totalTime % 3600 / 60) + ' minutes');
    });



    document.addEventListener("getCurrentLocation", (event) => {
        getLocation(routingControl);
    });
}


function getLocation(routingControl) {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition((position) => {

            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            const newWayPoint = L.latLng(latitude, longitude);

            // Get existing waypoints
            const existingWaypoints = routingControl.getWaypoints();

            // Sort the waypoints by distance from the last waypoint
            existingWaypoints.sort((a, b) => b.distance - a.distance);

            // Check if the new waypoint is already the first
            if (existingWaypoints[0] !== newWayPoint) {
                existingWaypoints.splice(1, 0, newWayPoint);
            }

            // Set the updated waypoints
            routingControl.setWaypoints(existingWaypoints);


            const existingWaypointsWithDistances = existingWaypoints.map(waypoint => {
                let distance = (waypoint.latLng !== undefined) ? waypoint.latLng : waypoint;
                return  newWayPoint.distanceTo(distance);
            });

            const filteredDistance = existingWaypointsWithDistances.filter(distance => distance !== 0);
            console.log(filteredDistance);


            const closestWaypoint = filteredDistance.reduce((closest, waypoint) => {
                if (waypoint < closest) {
                    return waypoint;
                }
                return closest;
            });

            alert(closestWaypoint);

        });
    } else {
        alert('error');
    }
}



