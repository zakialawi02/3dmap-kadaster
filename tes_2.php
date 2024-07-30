<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- mapSystem -->
    <script src=" https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.css " rel="stylesheet">
    <script src="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Cesium.js"></script>
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.rawgit.com/mrdoob/three.js/r128/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.rawgit.com/mrdoob/three.js/r128/examples/js/loaders/OBJLoader.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #cesiumMap {
            height: 100vh;
            width: 100%;
        }

        .input-container {
            position: absolute;
            top: 10px;
            left: 10px;
            background: white;
            padding: 10px;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <div class="input-container">
        <div class="mb-0">
            <label for="formFileSm" class="form-label">File input</label>
            <div class="input-group">
                <input class="form-control form-control-sm" id="formFileSm" type="file">
            </div>
            <div class="mt-2 d-flex justify-content-end">
                <button class="btn xs-btn btn-secondary" id="cek3d" type="button">Cek</button>
            </div>
        </div>

        <div id="coordinateInputs" style="display: none;">
            <label for="latitude" class="form-label">Latitude</label>
            <input class="form-control form-control-sm" id="latitude" type="number" step="any">
            <label for="longitude" class="form-label">Longitude</label>
            <input class="form-control form-control-sm" id="longitude" type="number" step="any">
        </div>
    </div>
    <div class="map" id="cesiumMap"></div>


    <script>
        // inisiasi cesium token
        Cesium.Ion.defaultAccessToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxODQyMzk1MS1iNWUxLTRhNGQtYTI1OS02OTUzNzI1ZDcwN2MiLCJpZCI6MTcxMjA2LCJpYXQiOjE2OTcwMTI5Mjh9.qk3jXULVR5DGxNlgFOR0aHWgT-1xmz50zY4gE63tXMY";
        // Cesium.Ion.defaultAccessToken =
        //   "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJjYzM3MWVhMC05NTVmLTQwZDQtYjVlYS04MGY2NjFhZWJjZTIiLCJpZCI6MTc0NTY5LCJpYXQiOjE2OTg1MDA4NDd9.CJSLBba2oVAnchzPeMZpazEs2EdocRFKSdoRYXy7gBg";

        // Initialize the Cesium Viewer in the HTML element with the `cesiumMap` ID.
        const viewer = new Cesium.Viewer("cesiumMap", {
            // terrain: Cesium.Terrain.fromWorldTerrain(),
            animation: false,
            timeline: false,
            homeButton: false,
            geocoder: false,
            sceneModePicker: false,
            baseLayerPicker: false,
            fullscreenButton: false,
        });

        viewer.clock.currentTime = new Cesium.JulianDate(9107651.04167);
        viewer.scene.globe.enableLighting = true;
        viewer.scene.highDynamicRange = true;
        // viewer.scene.globe.atmosphereLightIntensity = 5.0;
        viewer.scene.postProcessStages.fxaa.enabled = true;
        viewer.scene.globe.baseColor = Cesium.Color.ALICEBLUE;
        viewer.scene.globe.undergroundColor = Cesium.Color.TRANSPARENT;
        viewer.scene.globe.depthTestAgainstTerrain = true;
        viewer.scene.screenSpaceCameraController.enableCollisionDetection = true;
        viewer.scene.globe.translucency.frontFaceAlphaByDistance = new Cesium.NearFarScalar(400.0, 0.0, 800.0, 1.0);


        // Fungsi untuk menghitung bounding box dari model GLB
        function computeBoundingBoxFromGLB(uint8Array) {
            return new Promise((resolve, reject) => {
                const loader = new THREE.GLTFLoader();
                const blob = new Blob([uint8Array], {
                    type: 'model/gltf-binary'
                });
                const url = URL.createObjectURL(blob);

                loader.load(url, (gltf) => {
                    const bbox = new THREE.Box3().setFromObject(gltf.scene);
                    URL.revokeObjectURL(url);
                    resolve(bbox);
                }, undefined, (error) => {
                    reject(error);
                });
            });
        }

        // Fungsi untuk menghitung bounding box dari model OBJ
        function computeBoundingBoxFromOBJ(uint8Array) {
            return new Promise((resolve, reject) => {
                const loader = new THREE.OBJLoader();
                const blob = new Blob([uint8Array], {
                    type: 'text/plain'
                });
                const url = URL.createObjectURL(blob);

                loader.load(url, (obj) => {
                    const bbox = new THREE.Box3().setFromObject(obj);
                    URL.revokeObjectURL(url);
                    resolve({
                        obj,
                        bbox
                    });
                }, undefined, (error) => {
                    reject(error);
                });
            });
        }

        // Fungsi untuk mengonversi OBJ ke GLTF menggunakan obj2gltf
        function convertOBJtoGLTF(uint8Array) {
            console.log("1");
            return new Promise((resolve, reject) => {
                const obj2gltf = new obj2gltf({
                    binary: true // Menerima output binary GLTF
                });
                console.log("2");
                obj2gltf.convert(uint8Array, (gltf) => {
                    resolve(gltf);
                }, (error) => {
                    console.log("3");
                    reject(error);
                });
            });
        }

        // Fungsi untuk mendapatkan tinggi objek dari bounding box
        function getObjectHeight(bbox) {
            const height = bbox.max.y - bbox.min.y;
            return height;
        }

        // Update fungsi handleFileUpload untuk menghitung bounding box
        async function handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = async function(e) {
                    const arrayBuffer = e.target.result;
                    const uint8Array = new Uint8Array(arrayBuffer);

                    if (file.name.endsWith('.glb')) {
                        try {
                            const bbox = await computeBoundingBoxFromGLB(uint8Array);
                            const height = getObjectHeight(bbox);
                            alert('Tinggi objek: ' + height + ' meters');

                            // Tampilkan input koordinat
                            document.getElementById('coordinateInputs').style.display = 'block';

                            // Simpan data file dan bounding box untuk digunakan saat update posisi
                            window.uploadedFile = uint8Array;
                            window.uploadedFileType = 'glb';
                            window.uploadedFileBBox = bbox;
                        } catch (error) {
                            alert('Gagal memparsing model GLB');
                        }
                    } else if (file.name.endsWith('.obj')) {
                        try {
                            const {
                                obj,
                                bbox
                            } = await computeBoundingBoxFromOBJ(uint8Array);
                            const height = getObjectHeight(bbox);
                            alert('Tinggi objek: ' + height + ' meters');

                            // Konversi OBJ ke GLTF menggunakan obj2gltf
                            const gltf = await convertOBJtoGLTF(uint8Array);

                            // Tampilkan input koordinat
                            document.getElementById('coordinateInputs').style.display = 'block';

                            // Simpan data GLTF dan bounding box untuk digunakan saat update posisi
                            window.uploadedFile = gltf;
                            window.uploadedFileType = 'gltf';
                            window.uploadedFileBBox = bbox;
                        } catch (error) {
                            alert('Gagal memparsing model OBJ');
                        }
                    } else {
                        alert('Format file tidak valid. Hanya mendukung GLB atau OBJ.');
                    }
                };
                reader.readAsArrayBuffer(file);
            }
        }

        // Fungsi untuk menampilkan model dan mengupdate posisinya
        function updateModelPosition() {
            const latitude = parseFloat(document.getElementById('latitude').value);
            const longitude = parseFloat(document.getElementById('longitude').value);
            if (isNaN(latitude) || isNaN(longitude)) {
                alert('Masukkan koordinat yang valid.');
                return;
            }

            const position = Cesium.Cartesian3.fromDegrees(longitude, latitude, 0);
            let model;

            if (window.uploadedFileType === 'glb') {
                model = viewer.entities.add({
                    position: position,
                    model: {
                        uri: URL.createObjectURL(new Blob([window.uploadedFile])),
                        scale: 1.0
                    }
                });
            } else if (window.uploadedFileType === 'gltf') {
                const gltfBlob = new Blob([JSON.stringify(window.uploadedFile)], {
                    type: 'application/json'
                });
                model = viewer.entities.add({
                    position: position,
                    model: {
                        uri: URL.createObjectURL(gltfBlob),
                        scale: 1.0
                    }
                });
            }

            viewer.flyTo(model, {
                duration: 2
            });
        }

        // Event listeners
        document.getElementById('formFileSm').addEventListener('change', handleFileUpload);
        document.getElementById('cek3d').addEventListener('click', updateModelPosition);
    </script>

</body>

</html>