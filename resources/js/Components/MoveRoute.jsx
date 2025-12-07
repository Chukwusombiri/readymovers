import React, { useEffect, useRef, useState } from 'react'
import mapboxgl from 'mapbox-gl'
import 'mapbox-gl/dist/mapbox-gl.css';


export default function MoveRoute({ pickUpCord, deliveryCord }) {
    const [geometry, setGeometry] = useState(null);
    const mapRef = useRef()
    const mapContainerRef = useRef()
    /* get routes geometry */
    useEffect(() => {
        async function getMapRoutes(start, end) {
            const accessToken = 'pk.eyJ1IjoiYm91bnR5LW1hbm55IiwiYSI6ImNsb2J6dmFlZDB2eHkybXBlb2M3ZXl4NWMifQ.OI1uIFwZ_lp2pK4yYXdmdA'
            const resp = await fetch(`https://api.mapbox.com/directions/v5/mapbox/driving/${start[0]},${start[1]};${end[0]},${end[1]}?geometries=geojson&access_token=${accessToken}`);
            const data = await resp.json();
            if (data.routes && data.routes.length > 0) {
                const route = data.routes[0];
                const distanceInMeters = route.distance;
                const distanceInKm = (distanceInMeters / 1000).toFixed(2);                
                setGeometry(route.geometry.coordinates);
            } else {
                console.error("No routes found:", data.message);
            }
        }
        if (pickUpCord.length > 0 && deliveryCord.length > 0) {
            getMapRoutes(pickUpCord, deliveryCord);
        }
    }, [pickUpCord, deliveryCord])
    /* intialize map of UK */
    useEffect(() => {
        mapboxgl.accessToken = 'pk.eyJ1IjoiYm91bnR5LW1hbm55IiwiYSI6ImNsb2J6dmFlZDB2eHkybXBlb2M3ZXl4NWMifQ.OI1uIFwZ_lp2pK4yYXdmdA'
        mapRef.current = new mapboxgl.Map({
            container: mapContainerRef.current,
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [-5.00864, 54.58965],
            zoom: 6.14,
            terrain: undefined
        });

        return () => {
            mapRef.current.remove()
        }
    }, [])

    /* draw route */
    useEffect(() => {
        async function getRoute() {
            const route = geometry;
            const geojson = {
                type: 'Feature',
                properties: {},
                geometry: {
                    type: 'LineString',
                    coordinates: route
                }
            };
            // if the route already exists on the map, we'll reset it using setData
            if (mapRef.current.getSource('route')) {
                mapRef.current.getSource('route').setData(geojson);
            }
            // otherwise, we'll make a new request
            else {
                mapRef.current.addLayer({
                    id: 'route',
                    type: 'line',
                    source: {
                        type: 'geojson',
                        data: geojson
                    },
                    layout: {
                        'line-join': 'round',
                        'line-cap': 'round'
                    },
                    paint: {
                        'line-color': '#3887be',
                        'line-width': 5,
                        'line-opacity': 0.75
                    }
                });
            }
        }

        function setMapStyle(isDarkMode) {
            const style = isDarkMode ? 'mapbox://styles/mapbox/dark-v10' : 'mapbox://styles/mapbox/streets-v12';
            if (mapRef.current.isStyleLoaded()) { // Ensure the style is loaded
                mapRef.current.setStyle(style);
            }
        }


        if (geometry && mapRef.current) {
            setMapStyle(localStorage.getItem('theme') && localStorage.getItem('theme') === 'dark');
            // Listen for changes in system theme
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
                setMapStyle(event.matches);
            });

            mapRef.current.on('load', () => {
                // make an initial directions request that
                // starts and ends at the same location
                getRoute();

                // Remove the layer and source if they exist
                if (mapRef.current.getLayer('point')) {
                    mapRef.current.removeLayer('point');
                }
                if (mapRef.current.getSource('point')) {
                    mapRef.current.removeSource('point');
                }

                // Add starting point to the map
                mapRef.current.addLayer({
                    id: 'point',
                    type: 'circle',
                    source: {
                        type: 'geojson',
                        data: {
                            type: 'FeatureCollection',
                            features: [{
                                type: 'Feature',
                                properties: {},
                                geometry: {
                                    type: 'Point',
                                    coordinates: pickUpCord
                                }
                            }]
                        }
                    },
                    paint: {
                        'circle-radius': 10,
                        'circle-color': '#3887be'
                    }
                });
            });
        }
    }, [geometry])

    return (
        <div ref={mapContainerRef} className='w-full h-full'></div>
    )
}
