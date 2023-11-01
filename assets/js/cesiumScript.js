// inisiasi cesium token
// Cesium.Ion.defaultAccessToken =
//   "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxODQyMzk1MS1iNWUxLTRhNGQtYTI1OS02OTUzNzI1ZDcwN2MiLCJpZCI6MTcxMjA2LCJpYXQiOjE2OTcwMTI5Mjh9.qk3jXULVR5DGxNlgFOR0aHWgT-1xmz50zY4gE63tXMY";
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

viewer.clock.currentTime = new Cesium.JulianDate(9107651.04167);
viewer.scene.globe.enableLighting = true;
viewer.scene.highDynamicRange = true;
// viewer.scene.globe.atmosphereLightIntensity = 5.0;
viewer.scene.postProcessStages.fxaa.enabled = true;
viewer.scene.globe.depthTestAgainstTerrain = true;
viewer.scene.screenSpaceCameraController.enableCollisionDetection = true;
viewer.scene.globe.translucency.frontFaceAlphaByDistance = new Cesium.NearFarScalar(
  400.0,
  0.0,
  800.0,
  1.0
);

// Set first camera the given longitude, latitude, and height.
function firstCamera() {
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
}
firstCamera();
$("#reset-toggle").click(function (e) {
  firstCamera();
});

const objek000L0 = await Cesium.Cesium3DTileset.fromIonAssetId(2337191);
viewer.scene.primitives.add(objek000L0);
const objek000L1 = await Cesium.Cesium3DTileset.fromIonAssetId(2337170);
viewer.scene.primitives.add(objek000L1);
const objek000L2 = await Cesium.Cesium3DTileset.fromIonAssetId(2337183);
viewer.scene.primitives.add(objek000L2);
const objek000L3 = await Cesium.Cesium3DTileset.fromIonAssetId(2337185);
viewer.scene.primitives.add(objek000L3);
const objek000L4 = await Cesium.Cesium3DTileset.fromIonAssetId(2337177);
viewer.scene.primitives.add(objek000L4);
const objek000L5 = await Cesium.Cesium3DTileset.fromIonAssetId(2337152);
viewer.scene.primitives.add(objek000L5);
const objek000B = await Cesium.Cesium3DTileset.fromIonAssetId(2332267);
viewer.scene.primitives.add(objek000B);
objek000B.style = new Cesium.Cesium3DTileStyle({
  color: {
    conditions: [
      ["true", "rgba(255, 255, 255, 0.3)"], // Ubah alpha (transparansi) ke 0.3
    ],
  },
});

// Buat koleksi bidang pemotongan (clipping plane collection)
var clippingPlanes = new Cesium.ClippingPlaneCollection({
  planes: [
    new Cesium.ClippingPlane(new Cesium.Cartesian3(1.0, 0.0, 0.0), 50.0), // Plane X
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 1.0, 0.0), 50.0), // Plane Y
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 0.0, -1.0), 50.0) // Plane Z
  ],
  edgeWidth: 0.0, // Lebar garis untuk menandai pemotongan (bisa disesuaikan)
  edgeColor: Cesium.Color.RED
});
// Terapkan koleksi bidang pemotongan pada objek 3D Tileset
updateClip2Model();

function updateClip2Model() {
  objek000L0.clippingPlanes = clippingPlanes;
  objek000L1.clippingPlanes = clippingPlanes;
  objek000L2.clippingPlanes = clippingPlanes;
  objek000L3.clippingPlanes = clippingPlanes;
  objek000L4.clippingPlanes = clippingPlanes;
  objek000L5.clippingPlanes = clippingPlanes;
}
// Event listener for slider X using jQuery
$('#sliderX').on('input', function () {
  var xValue = parseFloat($(this).val());
  clippingPlanes.get(0).distance = xValue;
  // Reset the other planes to a distance that allows visibility
  clippingPlanes.get(1).distance = -50; // Y-plane
  clippingPlanes.get(2).distance = -50; // Z-plane
  $('#sliderY').val(90);
  $('#sliderZ').val(90);
  updateClip2Model();
});

// Event listener for slider Y using jQuery
$('#sliderY').on('input', function () {
  var yValue = parseFloat($(this).val());
  clippingPlanes.get(1).distance = yValue;
  // Reset the other planes to a distance that allows visibility
  clippingPlanes.get(0).distance = -50; // X-plane
  clippingPlanes.get(2).distance = -50; // Z-plane
  $('#sliderX').val(90);
  $('#sliderZ').val(90);
  updateClip2Model();
});

// Event listener for slider Z using jQuery
$('#sliderZ').on('input', function () {
  var zValue = parseFloat($(this).val());
  clippingPlanes.get(2).distance = zValue;
  // Reset the other planes to a distance that allows visibility
  clippingPlanes.get(0).distance = -50; // X-plane
  clippingPlanes.get(1).distance = -50; // Y-plane
  $('#sliderX').val(90);
  $('#sliderY').val(90);
  updateClip2Model();
});

$("#reset-clip").click(function (e) {
  clippingPlanes.get(0).distance = 50; // X-plane
  clippingPlanes.get(1).distance = 50; // Y-plane
  clippingPlanes.get(2).distance = 50; // Z-plane
  updateClip2Model();
  $("#sliderX").val(90);
  $("#sliderY").val(90);
  $("#sliderZ").val(90);
});

$("#level_1").on('click', function () {
  objek000L1.show = !objek000L1.show;
});
$("#level_2").on('click', function () {
  objek000L2.show = !objek000L2.show;
});
$("#level_3").on('click', function () {
  objek000L3.show = !objek000L3.show;
});
$("#level_4").on('click', function () {
  objek000L4.show = !objek000L4.show;
});
$("#level_5").on('click', function () {
  objek000L5.show = !objek000L5.show;
});

$("#virtual_1").on('click', function () {
  objek000B.show = !objek000B.show;
});

$("#underground_1").on('click', function () {
  viewer.scene.globe.depthTestAgainstTerrain = !viewer.scene.globe.depthTestAgainstTerrain;
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !viewer.scene.screenSpaceCameraController.enableCollisionDetection;
  viewer.scene.globe.translucency.frontFaceAlphaByDistance.nearValue = 0.4;
});