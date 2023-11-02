// inisiasi cesium token
Cesium.Ion.defaultAccessToken =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxODQyMzk1MS1iNWUxLTRhNGQtYTI1OS02OTUzNzI1ZDcwN2MiLCJpZCI6MTcxMjA2LCJpYXQiOjE2OTcwMTI5Mjh9.qk3jXULVR5DGxNlgFOR0aHWgT-1xmz50zY4gE63tXMY";
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
      112.73761619035064, -7.26164124554183,
      600
    ),
    orientation: {
      heading: Cesium.Math.toRadians(0.0),
      pitch: Cesium.Math.toRadians(-45.0),
    },
  });
}

function secondCamera() {
  viewer.camera.flyTo({
    destination: Cesium.Cartesian3.fromDegrees(
      112.7455751403341, -7.265563821748533,
      200
    ),
    orientation: {
      heading: Cesium.Math.toRadians(0.0),
      pitch: Cesium.Math.toRadians(-45.0),
    },
  });
}
secondCamera();
$("#first-camera").click(function (e) {
  firstCamera();
});
$("#second-camera").click(function (e) {
  secondCamera();
});

const siolaBuildingL0 = await Cesium.Cesium3DTileset.fromIonAssetId(2337813);
viewer.scene.primitives.add(siolaBuildingL0);
const siolaBuildingL1 = await Cesium.Cesium3DTileset.fromIonAssetId(2337814);
viewer.scene.primitives.add(siolaBuildingL1);
const siolaBuildingL2 = await Cesium.Cesium3DTileset.fromIonAssetId(2337815);
viewer.scene.primitives.add(siolaBuildingL2);
const siolaBuildingL3 = await Cesium.Cesium3DTileset.fromIonAssetId(2337816);
viewer.scene.primitives.add(siolaBuildingL3);
const siolaBuildingL4 = await Cesium.Cesium3DTileset.fromIonAssetId(2337817);
viewer.scene.primitives.add(siolaBuildingL4);
const siolaBuildingL5 = await Cesium.Cesium3DTileset.fromIonAssetId(2337818);
viewer.scene.primitives.add(siolaBuildingL5);
const siolaBuildingB = await Cesium.Cesium3DTileset.fromIonAssetId(2333821);
viewer.scene.primitives.add(siolaBuildingB);
siolaBuildingB.style = new Cesium.Cesium3DTileStyle({
  color: {
    conditions: [
      ["true", "rgba(255, 255, 255, 0.3)"], // Ubah alpha (transparansi) ke 0.3
    ],
  },
});


const balaiBuildingL0 = await Cesium.Cesium3DTileset.fromIonAssetId(2337798);
viewer.scene.primitives.add(balaiBuildingL0);
const balaiBuildingL1 = await Cesium.Cesium3DTileset.fromIonAssetId(2337797);
viewer.scene.primitives.add(balaiBuildingL1);
const balaiBuildingL2 = await Cesium.Cesium3DTileset.fromIonAssetId(2337799);
viewer.scene.primitives.add(balaiBuildingL2);

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
  siolaBuildingL0.clippingPlanes = clippingPlanes;
  siolaBuildingL1.clippingPlanes = clippingPlanes;
  siolaBuildingL2.clippingPlanes = clippingPlanes;
  siolaBuildingL3.clippingPlanes = clippingPlanes;
  siolaBuildingL4.clippingPlanes = clippingPlanes;
  siolaBuildingL5.clippingPlanes = clippingPlanes;
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

$("#siolaLevel_0").on('click', function () {
  siolaBuildingL0.show = !siolaBuildingL0.show;
});
$("#siolaLevel_1").on('click', function () {
  siolaBuildingL1.show = !siolaBuildingL1.show;
});
$("#siolaLevel_2").on('click', function () {
  siolaBuildingL2.show = !siolaBuildingL2.show;
});
$("#siolaLevel_3").on('click', function () {
  siolaBuildingL3.show = !siolaBuildingL3.show;
});
$("#siolaLevel_4").on('click', function () {
  siolaBuildingL4.show = !siolaBuildingL4.show;
});
$("#siolaLevel_5").on('click', function () {
  siolaBuildingL5.show = !siolaBuildingL5.show;
});
$("#siolaVirtual_1").on('click', function () {
  siolaBuildingB.show = !siolaBuildingB.show;
});

$("#balaiLevel_0").on('click', function () {
  balaiBuildingL0.show = !balaiBuildingL0.show;
});
$("#balaiLevel_1").on('click', function () {
  balaiBuildingL1.show = !balaiBuildingL1.show;
});
$("#balaiLevel_2").on('click', function () {
  balaiBuildingL2.show = !balaiBuildingL2.show;
});

$("#underground_1").on('click', function () {
  viewer.scene.globe.depthTestAgainstTerrain = !viewer.scene.globe.depthTestAgainstTerrain;
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !viewer.scene.screenSpaceCameraController.enableCollisionDetection;
  viewer.scene.globe.translucency.frontFaceAlphaByDistance.nearValue = 0.4;
});