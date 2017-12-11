<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="css/leaflet.css" />
        <link rel="stylesheet" type="text/css" href="css/qgis2web.css">
        <link rel="stylesheet" href="css/MarkerCluster.css" />
        <link rel="stylesheet" href="css/MarkerCluster.Default.css" />
        <link rel="stylesheet" href="css/L.Control.MousePosition.css" />
        <link rel="stylesheet" href="css/leaflet.defaultextent.css" />
        <link rel="stylesheet" href="css/leaflet-search.css" />
        <link rel="stylesheet" href="css/leaflet.css"><link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css"><link rel="stylesheet" href="css/L.Control.Locate.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
    integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
    integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
    crossorigin=""></script>
        <script src="https://unpkg.com/esri-leaflet@2.1.1/dist/esri-leaflet.js"
    integrity="sha512-ECQqaYZke9cSdqlFG08zSkudgrdF6I1d8ViSa7I3VIszJyVqw4ng1G8sehEXlumdMnFYfzY0tMgdQa4WCs9IUw=="
    crossorigin=""></script>
        <style>
        html, body, #map {
            width: 100%;
            height: 100%;
            margin: 0px;
            position: relative;
        }
        </style>
 

<title>Fishing Base</title>
<link href="img/ub.jpg" rel="shortcut icon">
</head>

<body>
        <div id="map"></div>
        <script src="js/qgis2web_expressions.js"></script>
        <script src="js/multi-style-layer.js"></script>
        <script src="js/leaflet-heat.js"></script>
		<script src="js/L.Control.Locate.min.js"></script>
        <script src="js/leaflet-svg-shape-markers.min.js"></script>
        <script src="js/leaflet.rotatedMarker.js"></script>
        <script src="js/OSMBuildings-Leaflet.js"></script>
        <script src="js/leaflet-hash.js"></script>
        <script src="js/leaflet-tilelayer-wmts.js"></script>
        <script src="js/Autolinker.min.js"></script>
        <script src="js/leaflet.markercluster.js"></script>
        <script src="js/L.Control.MousePosition.js"></script>
        <script src="js/leaflet.defaultextent.js"></script>
        <script src="js/leaflet-search.js"></script>
        <script src="js/leaflet.latlng-graticule.js"></script>
        <script src="data/FishingBase_0.js"></script>
        <!--Masukkan lokasi data peta-->
        <!--Mulai-->
        <!--Selesai-->
        <script>
        var highlightLayer;
        function highlightFeature(e) {
            highlightLayer = e.target;

            if (e.target.feature.geometry.type === 'LineString') {
              highlightLayer.setStyle({
                color: '#ffff00',
              });
            } else {
              highlightLayer.setStyle({
                fillColor: '#ffff00',
                fillOpacity: 1
              });
            }
        }
        L.ImageOverlay.include({
            getBounds: function () {
                return this._bounds;
            }
        });
        var map = L.map('map', {
            zoomControl:true, defaultExtentControl:true, maxZoom:17, minZoom:2
        }).setView([-6.956, 112.981], 8); //titik tengah dan level zoom awal
        var hash = new L.Hash(map);
        map.attributionControl.addAttribution('&copy; 2017 <b>BURHAN FAUZI SALAM</b>');
        var bounds_group = new L.featureGroup([]);
        var basemap1 =  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; 2017 <b>BURHAN FAUZI SALAM</b>',
            maxZoom: 28
        });
        basemap1.addTo(map);
        var basemap2 = L.esri.basemapLayer('Imagery');
        basemap2.addTo(map);
        var basemap2 = L.esri.basemapLayer('ImageryLabels');
        basemap2.addTo(map);
        function setBounds() {
        }
        function geoJson2heat(geojson, weight) {
          return geojson.features.map(function(feature) {
            return [
              feature.geometry.coordinates[1],
              feature.geometry.coordinates[0],
              feature.properties[weight]
            ];
          });
        }
        
        //Masukkan function tampilan data peta
        //Mulai
        function pop_FishingBase_0(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    for (i in e.target._eventParents) {
                        e.target._eventParents[i].resetStyle(e.target);
                    }
                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">Kabupaten</th>\
                        <td>' + (feature.properties['Kabupaten'] !== null ? Autolinker.link(String(feature.properties['Kabupaten'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nama Fishing Base</th>\
                        <td>' + (feature.properties['Nama Fishing Base'] !== null ? Autolinker.link(String(feature.properties['Nama Fishing Base'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Longitude</th>\
                        <td>' + (feature.properties['Longitude'] !== null ? Autolinker.link(String(feature.properties['Longitude'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Latitude</th>\
                        <td>' + (feature.properties['Latitude'] !== null ? Autolinker.link(String(feature.properties['Latitude'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Keterangan Lokasi</th>\
                        <td>' + (feature.properties['Keterangan Lokasi'] !== null ? Autolinker.link(String(feature.properties['Keterangan Lokasi'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Kelas</th>\
                        <td>' + (feature.properties['Kelas'] !== null ? Autolinker.link(String(feature.properties['Kelas'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Jenis Alat Penangkap Ikan</th>\
                        <td>' + (feature.properties['Jenis Alat Penangkap Ikan'] !== null ? Autolinker.link(String(feature.properties['Jenis Alat Penangkap Ikan'])) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_FishingBase_0_0(feature) {
            switch(String(feature.properties['Kabupaten'])) {
                case 'Tuban':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(73,234,97,1.0)',
            }
                    break;
                case 'Lamongan':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(212,40,83,1.0)',
            }
                    break;
                case 'Gresik':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(189,137,234,1.0)',
            }
                    break;
                case 'Sidoarjo':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(235,96,217,1.0)',
            }
                    break;
                case 'Pasuruan':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(57,69,237,1.0)',
            }
                    break;
                case 'Kota Pasuruan':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(30,149,212,1.0)',
            }
                    break;
                case 'Probolinggo':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(24,214,167,1.0)',
            }
                    break;
                case 'Kota Probolinggo':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(127,204,63,1.0)',
            }
                    break;
                case 'Situbondo':
                    return {
                pane: 'pane_FishingBase_0',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(0,0,0,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fillOpacity: 1,
                fillColor: 'rgba(225,160,124,1.0)',
            }
                    break;
            }
        }
        map.createPane('pane_FishingBase_0');
        map.getPane('pane_FishingBase_0').style.zIndex = 400;
        map.getPane('pane_FishingBase_0').style['mix-blend-mode'] = 'normal';
        var layer_FishingBase_0 = new L.geoJson(json_FishingBase_0, {
            attribution: '<a href=""></a>',
            pane: 'pane_FishingBase_0',
            onEachFeature: pop_FishingBase_0,
            pointToLayer: function (feature, latlng) {
                var context = {
                    feature: feature,
                    variables: {}
                };
                return L.circleMarker(latlng, style_FishingBase_0_0(feature));
            },
        });
        bounds_group.addLayer(layer_FishingBase_0);
        map.addLayer(layer_FishingBase_0);
        //Selesai

        var baseMaps = {'OSM': basemap1, 'Imagery': basemap2,};
        L.control.layers(baseMaps,{'Fishing Base<br /><table><tr><td style="text-align: center;"><img src="legend/FishingBase_0_Tuban0.png" /></td><td>Tuban</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_Lamongan1.png" /></td><td>Lamongan</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_Gresik2.png" /></td><td>Gresik</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_Sidoarjo3.png" /></td><td>Sidoarjo</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_Pasuruan4.png" /></td><td>Pasuruan</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_KotaPasuruan5.png" /></td><td>Kota Pasuruan</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_Probolinggo6.png" /></td><td>Probolinggo</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_KotaProbolinggo7.png" /></td><td>Kota Probolinggo</td></tr><tr><td style="text-align: center;"><img src="legend/FishingBase_0_Situbondo8.png" /></td><td>Situbondo</td></tr></table>': layer_FishingBase_0,
        //Masukkan lokasi legenda peta
        },{collapsed:false}).addTo(map);
		
        L.latlngGraticule({
            showLabel: true,
            zoomInterval: [
                {start: 2, end: 3, interval: 30},
                {start: 4, end: 4, interval: 10},
                {start: 5, end: 7, interval: 5},
                {start: 8, end: 8, interval: 1},
                {start: 9, end: 9, interval: 0.5},
                {start: 10, end: 13, interval: 0.25},
            ]
        }).addTo(map);

        L.control.scale({position: 'bottomleft', maxWidth: 100, metric: true, imperial: true, updateWhenIdle: true}).addTo(map);
        L.control.mousePosition().addTo(map);
        L.control.locate().addTo(map);
        setBounds();
        map.addControl(new L.Control.Search({
            layer: layer_FishingBase_0, //layer untuk pencarian
            initial: false,
            hideMarkerOnCollapse: true,
            propertyName: 'Nama Fishing Base'})); //masukkan field untuk pencarian
        </script>
    </body>

</html>