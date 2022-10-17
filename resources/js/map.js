import Map from 'ol/Map.js';
import View from 'ol/View.js';
import TileLayer from 'ol/layer/Tile.js';
import Feature from 'ol/Feature';
import VectorSource from 'ol/source/Vector';
import VectorLayer from 'ol/layer/Vector';
import OSM from 'ol/source/OSM.js';
import Point from 'ol/geom/Point';
import { Style, Fill, Stroke, Circle, Text } from 'ol/style.js';

document.addEventListener("alpine:init", () => {
    Alpine.data("map", function (data) {
        return {
            map: {},
            features: [
                new Feature({
                    geometry: new Point([2.2944960089681175, 48.85824068679814]),
                    name: 'Torre Eiffel',
                })

            ],
            init() {
               
                this.map = new Map({
                    target: this.$refs.map,
                    layers: [
                        new TileLayer({
                            source: new OSM(),

                        }),
                        new VectorLayer({
                            source: new VectorSource({
                                features: this.features,
                            }),
                            style: this.styleFunction,
                        })

                    ],
                    
                    view: new View({
                        //set the current location of the user
                        
                        projection: "EPSG:4326",
                        center: [2.2944960089681175, 48.85824068679814],
                        zoom: 15,
                    }),
                });
            },
            styleFunction(feature) {
                return new Style({
                    image: new Circle({
                        radius: 4,
                        fill: new Fill({
                            color: 'rgba(0, 255, 255, 0.5)',
                        }),
                        stroke: new Stroke({
                            color: 'rgba(192, 192, 192, 1)',
                            width: 2
                        }),
                    }),
                    text: new Text({
                        font: '12px sans-serif',
                        textAlign: 'left',
                        text: feature.get('name'),
                        offsetY: -15,
                        offsetX: 5,
                        backgroundFill: new Fill({
                            color: 'rgba(255, 255, 255, 0.5)',
                        }),
                        backgroundStroke: new Stroke({
                            color: 'rgba(227, 227, 227, 1)',
                        }),
                        padding: [5, 2, 2, 5]
                    })
                })
            }
        };

    });
});