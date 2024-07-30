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

        // viewer.camera.flyTo({
        //     destination: Cesium.Cartesian3.fromDegrees(112.73677426629814, -7.259593062440535, 20000),
        //     orientation: {
        //         heading: Cesium.Math.toRadians(0.0),
        //         pitch: Cesium.Math.toRadians(-90.0),
        //     },
        // });

        // function createModel(url, height) {
        //     viewer.entities.removeAll();

        //     const position = Cesium.Cartesian3.fromDegrees(
        //         112.0744619,
        //         -7.0503706,
        //         height
        //     );
        //     const heading = Cesium.Math.toRadians(135);
        //     const pitch = 0;
        //     const roll = 0;
        //     const hpr = new Cesium.HeadingPitchRoll(heading, pitch, roll);
        //     const orientation = Cesium.Transforms.headingPitchRollQuaternion(
        //         position,
        //         hpr
        //     );

        //     const entity = viewer.entities.add({
        //         name: url,
        //         position: position,
        //         orientation: orientation,
        //         model: {
        //             uri: url,
        //         },
        //     });
        //     viewer.trackedEntity = entity;
        // }

        // createModel(
        //     "./assets/untitled.glb",
        //     0.0
        // );

        let loadedModel;

        // Fungsi untuk membaca file 3D yang diupload
        function handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const arrayBuffer = e.target.result;
                    const uint8Array = new Uint8Array(arrayBuffer);
                    // Cek jenis file GLB atau OBJ dan lakukan parse sesuai kebutuhan
                    if (file.name.endsWith('.glb')) {
                        // Tampilkan input koordinat
                        document.getElementById('coordinateInputs').style.display = 'block';
                        // Simpan data file untuk digunakan saat update posisi
                        window.uploadedFile = uint8Array;
                        window.uploadedFileType = 'glb';
                    } else if (file.name.endsWith('.obj')) {
                        // Tampilkan input koordinat
                        document.getElementById('coordinateInputs').style.display = 'block';
                        // Simpan data file untuk digunakan saat update posisi
                        window.uploadedFile = uint8Array;
                        window.uploadedFileType = 'obj';
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
            } else if (window.uploadedFileType === 'obj') {
                const modelMatrix = Cesium.Transforms.eastNorthUpToFixedFrame(position);
                const primitive = viewer.scene.primitives.add(Cesium.Model.fromGltf({
                    url: URL.createObjectURL(new Blob([window.uploadedFile])),
                    modelMatrix: modelMatrix,
                    scale: 1.0
                }));
                model = primitive;
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