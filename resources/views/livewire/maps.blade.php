<x-page-layout>
    <div id="map" class="map"></div>
    <button id="currentLocation" type="button" class="btn btn-primary" @click="$dispatch('getCurrentLocation')">Current location</button>
</x-page-layout>
