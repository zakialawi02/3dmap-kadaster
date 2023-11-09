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
firstCamera();
$("#first-camera").click(function (e) {
  firstCamera();
});
$("#second-camera").click(function (e) {
  secondCamera();
});

function createTransparentStyle(alphaValue) {
  return new Cesium.Cesium3DTileStyle({
    color: {
      conditions: [
        ["true", `rgba(255, 255, 255, ${alphaValue})`],
      ],
    },
  });
}

// Get Siola
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
const siolaLegalBT = await Cesium.Cesium3DTileset.fromIonAssetId(2346402);

const siolaLegalL1a1 = await Cesium.Cesium3DTileset.fromIonAssetId(2346408);
viewer.scene.primitives.add(siolaLegalL1a1);
const siolaLegalL1a2 = await Cesium.Cesium3DTileset.fromIonAssetId(2346409);
viewer.scene.primitives.add(siolaLegalL1a2);
const siolaLegalL1a3 = await Cesium.Cesium3DTileset.fromIonAssetId(2346410);
viewer.scene.primitives.add(siolaLegalL1a3);
const siolaLegalL1a4 = await Cesium.Cesium3DTileset.fromIonAssetId(2346413);
viewer.scene.primitives.add(siolaLegalL1a4);
const siolaLegalL1a5 = await Cesium.Cesium3DTileset.fromIonAssetId(2346415);
viewer.scene.primitives.add(siolaLegalL1a5);
const siolaLegalL1a6 = await Cesium.Cesium3DTileset.fromIonAssetId(2346416);
viewer.scene.primitives.add(siolaLegalL1a6);
const siolaLegalL1a7 = await Cesium.Cesium3DTileset.fromIonAssetId(2347030);
viewer.scene.primitives.add(siolaLegalL1a7);
const siolaLegalL1a8 = await Cesium.Cesium3DTileset.fromIonAssetId(2346419);
viewer.scene.primitives.add(siolaLegalL1a8);
const siolaLegalL1a9 = await Cesium.Cesium3DTileset.fromIonAssetId(2346420);
viewer.scene.primitives.add(siolaLegalL1a9);
const siolaLegalL1a10 = await Cesium.Cesium3DTileset.fromIonAssetId(2346553);
viewer.scene.primitives.add(siolaLegalL1a10);

const siolaLegalL2a1 = await Cesium.Cesium3DTileset.fromIonAssetId(2346717);
viewer.scene.primitives.add(siolaLegalL2a1);
const siolaLegalL2a2 = await Cesium.Cesium3DTileset.fromIonAssetId(2346718);
viewer.scene.primitives.add(siolaLegalL2a2);
const siolaLegalL2a3 = await Cesium.Cesium3DTileset.fromIonAssetId(2346720);
viewer.scene.primitives.add(siolaLegalL2a3);
const siolaLegalL2a4 = await Cesium.Cesium3DTileset.fromIonAssetId(2346721);
viewer.scene.primitives.add(siolaLegalL2a4);
const siolaLegalL2a5 = await Cesium.Cesium3DTileset.fromIonAssetId(2346722);
viewer.scene.primitives.add(siolaLegalL2a5);
const siolaLegalL2a6 = await Cesium.Cesium3DTileset.fromIonAssetId(2346723);
viewer.scene.primitives.add(siolaLegalL2a6);
const siolaLegalL2a7 = await Cesium.Cesium3DTileset.fromIonAssetId(2346724);
viewer.scene.primitives.add(siolaLegalL2a7);

const siolaLegalL3a1 = await Cesium.Cesium3DTileset.fromIonAssetId(2347178);
viewer.scene.primitives.add(siolaLegalL3a1);
const siolaLegalL3a2 = await Cesium.Cesium3DTileset.fromIonAssetId(2347184);
viewer.scene.primitives.add(siolaLegalL3a2);
const siolaLegalL3a3 = await Cesium.Cesium3DTileset.fromIonAssetId(2347185);
viewer.scene.primitives.add(siolaLegalL3a3);
const siolaLegalL3a4 = await Cesium.Cesium3DTileset.fromIonAssetId(2347186);
viewer.scene.primitives.add(siolaLegalL3a4);
const siolaLegalL3a5 = await Cesium.Cesium3DTileset.fromIonAssetId(2347187);
viewer.scene.primitives.add(siolaLegalL3a5);
const siolaLegalL3a6 = await Cesium.Cesium3DTileset.fromIonAssetId(2347188);
viewer.scene.primitives.add(siolaLegalL3a6);
const siolaLegalL3a7 = await Cesium.Cesium3DTileset.fromIonAssetId(2347190);
viewer.scene.primitives.add(siolaLegalL3a7);

const siolaLegalL4a1 = await Cesium.Cesium3DTileset.fromIonAssetId(2347193);
viewer.scene.primitives.add(siolaLegalL4a1);
const siolaLegalL4a2 = await Cesium.Cesium3DTileset.fromIonAssetId(2347195);
viewer.scene.primitives.add(siolaLegalL4a2);
const siolaLegalL4a3 = await Cesium.Cesium3DTileset.fromIonAssetId(2347197);
viewer.scene.primitives.add(siolaLegalL4a3);

const siolaLegalL5a1 = await Cesium.Cesium3DTileset.fromIonAssetId(2347200);
viewer.scene.primitives.add(siolaLegalL5a1);

viewer.scene.primitives.add(siolaLegalBT);
siolaLegalBT.style = createTransparentStyle(0.2);
const siolaLegalBB = await Cesium.Cesium3DTileset.fromIonAssetId(2346745);
viewer.scene.primitives.add(siolaLegalBB);
siolaLegalBB.style = createTransparentStyle(0.2);

// Get Balai Pemuda
const balaiBuildingL0 = await Cesium.Cesium3DTileset.fromIonAssetId(2337798);
viewer.scene.primitives.add(balaiBuildingL0);
const balaiBuildingL1 = await Cesium.Cesium3DTileset.fromIonAssetId(2337797);
viewer.scene.primitives.add(balaiBuildingL1);
const balaiBuildingL2 = await Cesium.Cesium3DTileset.fromIonAssetId(2337799);
viewer.scene.primitives.add(balaiBuildingL2);

// Get Rusunawa
const rusunawaBuildingL1 = await Cesium.Cesium3DTileset.fromIonAssetId(2346646);
viewer.scene.primitives.add(rusunawaBuildingL1);
const rusunawaBuildingL2 = await Cesium.Cesium3DTileset.fromIonAssetId(2346667);
viewer.scene.primitives.add(rusunawaBuildingL2);
const rusunawaBuildingL3 = await Cesium.Cesium3DTileset.fromIonAssetId(2346668);
viewer.scene.primitives.add(rusunawaBuildingL3);

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

// let siola = [
//   siolaBuildingL0,
//   siolaBuildingL1,
//   siolaBuildingL2,
//   siolaBuildingL3,
//   siolaBuildingL4,
//   siolaBuildingL5,
//   siolaLegalBT,
//   siolaLegalBB,
//   siolaLegalL1a1,
//   siolaLegalL1a2,
//   siolaLegalL1a3,
//   siolaLegalL1a4,
//   siolaLegalL1a5,
//   siolaLegalL1a6,
//   siolaLegalL1a7,
//   siolaLegalL1a8,
//   siolaLegalL1a9,
//   siolaLegalL1a10,
//   siolaLegalL1a1,
//   siolaLegalL2a2,
//   siolaLegalL2a3,
//   siolaLegalL2a4,
//   siolaLegalL2a5,
//   siolaLegalL2a6,
//   siolaLegalL2a7,
// ];

// Layering button Siola
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
  siolaLegalBT.show = !siolaLegalBT.show;
});
$("#siolaVirtual_2").on('click', function () {
  siolaLegalBB.show = !siolaLegalBB.show;
});

$("#siolaLegal_1a1").on('click', function () {
  siolaLegalL1a1.show = !siolaLegalL1a1.show;
});
$("#siolaLegal_1a2").on('click', function () {
  siolaLegalL1a2.show = !siolaLegalL1a2.show;
});
$("#siolaLegal_1a3").on('click', function () {
  siolaLegalL1a3.show = !siolaLegalL1a3.show;
});
$("#siolaLegal_1a4").on('click', function () {
  siolaLegalL1a4.show = !siolaLegalL1a4.show;
});
$("#siolaLegal_1a5").on('click', function () {
  siolaLegalL1a5.show = !siolaLegalL1a5.show;
});
$("#siolaLegal_1a6").on('click', function () {
  siolaLegalL1a6.show = !siolaLegalL1a6.show;
});
$("#siolaLegal_1a7").on('click', function () {
  siolaLegalL1a7.show = !siolaLegalL1a7.show;
});
$("#siolaLegal_1a8").on('click', function () {
  siolaLegalL1a8.show = !siolaLegalL1a8.show;
});
$("#siolaLegal_1a9").on('click', function () {
  siolaLegalL1a9.show = !siolaLegalL1a9.show;
});
$("#siolaLegal_1a10").on('click', function () {
  siolaLegalL1a10.show = !siolaLegalL1a10.show;
});

$("#siolaLegal_2a1").on('click', function () {
  siolaLegalL2a1.show = !siolaLegalL2a1.show;
});
$("#siolaLegal_2a2").on('click', function () {
  siolaLegalL2a2.show = !siolaLegalL2a2.show;
});
$("#siolaLegal_2a3").on('click', function () {
  siolaLegalL2a3.show = !siolaLegalL2a3.show;
});
$("#siolaLegal_2a4").on('click', function () {
  siolaLegalL2a4.show = !siolaLegalL2a4.show;
});
$("#siolaLegal_2a5").on('click', function () {
  siolaLegalL2a5.show = !siolaLegalL2a5.show;
});
$("#siolaLegal_2a6").on('click', function () {
  siolaLegalL2a6.show = !siolaLegalL2a6.show;
});
$("#siolaLegal_2a7").on('click', function () {
  siolaLegalL2a7.show = !siolaLegalL2a7.show;
});

$("#siolaLegal_3a1").on('click', function () {
  siolaLegalL3a1.show = !siolaLegalL3a1.show;
});
$("#siolaLegal_3a2").on('click', function () {
  siolaLegalL3a2.show = !siolaLegalL3a2.show;
});
$("#siolaLegal_3a3").on('click', function () {
  siolaLegalL3a3.show = !siolaLegalL3a3.show;
});
$("#siolaLegal_3a4").on('click', function () {
  siolaLegalL3a4.show = !siolaLegalL3a4.show;
});
$("#siolaLegal_3a5").on('click', function () {
  siolaLegalL3a5.show = !siolaLegalL3a5.show;
});
$("#siolaLegal_3a6").on('click', function () {
  siolaLegalL3a6.show = !siolaLegalL3a6.show;
});
$("#siolaLegal_3a7").on('click', function () {
  siolaLegalL3a7.show = !siolaLegalL3a7.show;
});

$("#siolaLegal_4a1").on('click', function () {
  siolaLegalL4a1.show = !siolaLegalL4a1.show;
});
$("#siolaLegal_4a2").on('click', function () {
  siolaLegalL4a2.show = !siolaLegalL4a2.show;
});
$("#siolaLegal_4a3").on('click', function () {
  siolaLegalL4a3.show = !siolaLegalL4a3.show;
});

$("#siolaLegal_5a1").on('click', function () {
  siolaLegalL5a1.show = !siolaLegalL5a1.show;
});


// Layering button Balai pemuda
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

$(document).ready(function () {
  $(".preload").addClass("d-none");
});