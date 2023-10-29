Cesium.Ion.defaultAccessToken =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJjYzM3MWVhMC05NTVmLTQwZDQtYjVlYS04MGY2NjFhZWJjZTIiLCJpZCI6MTc0NTY5LCJpYXQiOjE2OTg1MDA4NDd9.CJSLBba2oVAnchzPeMZpazEs2EdocRFKSdoRYXy7gBg";

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
viewer.scene.highDynamicRange = true;
viewer.scene.globe.depthTestAgainstTerrain = true;

// Set first camera the given longitude, latitude, and height.
viewer.camera.flyTo({
  destination: Cesium.Cartesian3.fromDegrees(
    112.7380013928,
    -7.2634412982,
    800
  ),
  orientation: {
    heading: Cesium.Math.toRadians(0.0),
    pitch: Cesium.Math.toRadians(-45.0),
  },
});

const Objek000A = await Cesium.Cesium3DTileset.fromIonAssetId(2332254);
viewer.scene.primitives.add(Objek000A);

const Objek000B = await Cesium.Cesium3DTileset.fromIonAssetId(2332267);
viewer.scene.primitives.add(Objek000B);
Objek000B.style = new Cesium.Cesium3DTileStyle({
  color: {
    conditions: [
      ["true", "rgba(255, 255, 255, 0.3)"], // Ubah alpha (transparansi) ke 0.3
    ],
  },
});
