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

firstCamera();
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

function thirdCamera() {
  viewer.camera.flyTo({
    destination: Cesium.Cartesian3.fromDegrees(
      112.64490147028183, -8.012749056273925,
      200
    ),
    orientation: {
      heading: Cesium.Math.toRadians(0.0),
      pitch: Cesium.Math.toRadians(-45.0),
    },
  });
}

$("#first-camera").click(function (e) {
  firstCamera();
});
$("#second-camera").click(function (e) {
  secondCamera();
});
$("#third-camera").click(function (e) {
  thirdCamera();
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

function makeOtherTransparentSiola(selectedLayer, alphaValue) {
  siolaLegalL1a1.style = selectedLayer === siolaLegalL1a1 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a2.style = selectedLayer === siolaLegalL1a2 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a3.style = selectedLayer === siolaLegalL1a3 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a4.style = selectedLayer === siolaLegalL1a4 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a5.style = selectedLayer === siolaLegalL1a5 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a6.style = selectedLayer === siolaLegalL1a6 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a7.style = selectedLayer === siolaLegalL1a7 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a8.style = selectedLayer === siolaLegalL1a8 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a9.style = selectedLayer === siolaLegalL1a9 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL1a10.style = selectedLayer === siolaLegalL1a10 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL2a1.style = selectedLayer === siolaLegalL2a1 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL2a2.style = selectedLayer === siolaLegalL2a2 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL2a3.style = selectedLayer === siolaLegalL2a3 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL2a4.style = selectedLayer === siolaLegalL2a4 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL2a5.style = selectedLayer === siolaLegalL2a5 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL2a6.style = selectedLayer === siolaLegalL2a6 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL2a7.style = selectedLayer === siolaLegalL2a7 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL3a1.style = selectedLayer === siolaLegalL3a1 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL3a2.style = selectedLayer === siolaLegalL3a2 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL3a3.style = selectedLayer === siolaLegalL3a3 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL3a4.style = selectedLayer === siolaLegalL3a4 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL3a5.style = selectedLayer === siolaLegalL3a5 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL3a6.style = selectedLayer === siolaLegalL3a6 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL3a7.style = selectedLayer === siolaLegalL3a7 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL4a1.style = selectedLayer === siolaLegalL4a1 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL4a2.style = selectedLayer === siolaLegalL4a2 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL4a3.style = selectedLayer === siolaLegalL4a3 ? undefined : createTransparentStyle(alphaValue);
  siolaLegalL5a1.style = selectedLayer === siolaLegalL5a1 ? undefined : createTransparentStyle(alphaValue);
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

const siolaLegalBT = await Cesium.Cesium3DTileset.fromIonAssetId(2346402);
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
const rusunawaBuildingL4 = await Cesium.Cesium3DTileset.fromIonAssetId(2346669);
viewer.scene.primitives.add(rusunawaBuildingL4);
const rusunawaBuildingL5 = await Cesium.Cesium3DTileset.fromIonAssetId(2346670);
viewer.scene.primitives.add(rusunawaBuildingL5);
const rusunawaBuildingLR = await Cesium.Cesium3DTileset.fromIonAssetId(2346671);
viewer.scene.primitives.add(rusunawaBuildingLR);

// Get default left click handler for when a feature is not picked on left click
const clickHandler = viewer.screenSpaceEventHandler.getInputAction(
  Cesium.ScreenSpaceEventType.LEFT_CLICK
);
viewer.screenSpaceEventHandler.setInputAction(function onLeftClick(movement) {
    // Pick a new feature
    const pickedFeature = viewer.scene.pick(movement.position);
    console.log(pickedFeature);
    console.log(pickedFeature.getProperty());

  },
  Cesium.ScreenSpaceEventType.LEFT_CLICK);





// Buat koleksi bidang pemotongan (clipping plane collection) SIOLA
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
  makeOtherTransparentSiola(siolaLegalL1a1, 0.3);
});
$("#siolaLegal_1a2").on('click', function () {
  siolaLegalL1a2.show = !siolaLegalL1a2.show;
  makeOtherTransparentSiola(siolaLegalL1a2, 0.3);
});
$("#siolaLegal_1a3").on('click', function () {
  siolaLegalL1a3.show = !siolaLegalL1a3.show;
  makeOtherTransparentSiola(siolaLegalL1a3, 0.3);
});
$("#siolaLegal_1a4").on('click', function () {
  siolaLegalL1a4.show = !siolaLegalL1a4.show;
  makeOtherTransparentSiola(siolaLegalL1a4, 0.3);
});
$("#siolaLegal_1a5").on('click', function () {
  siolaLegalL1a5.show = !siolaLegalL1a5.show;
  makeOtherTransparentSiola(siolaLegalL1a5, 0.3);
});
$("#siolaLegal_1a6").on('click', function () {
  siolaLegalL1a6.show = !siolaLegalL1a6.show;
  makeOtherTransparentSiola(siolaLegalL1a6, 0.3);
});
$("#siolaLegal_1a7").on('click', function () {
  siolaLegalL1a7.show = !siolaLegalL1a7.show;
  makeOtherTransparentSiola(siolaLegalL1a7, 0.3);
});
$("#siolaLegal_1a8").on('click', function () {
  siolaLegalL1a8.show = !siolaLegalL1a8.show;
  makeOtherTransparentSiola(siolaLegalL1a8, 0.3);
});
$("#siolaLegal_1a9").on('click', function () {
  siolaLegalL1a9.show = !siolaLegalL1a9.show;
  makeOtherTransparentSiola(siolaLegalL1a9, 0.3);
});
$("#siolaLegal_1a10").on('click', function () {
  siolaLegalL1a10.show = !siolaLegalL1a10.show;
  makeOtherTransparentSiola(siolaLegalL1a10, 0.3);
});

$("#siolaLegal_2a1").on('click', function () {
  siolaLegalL2a1.show = !siolaLegalL2a1.show;
  makeOtherTransparentSiola(siolaLegalL2a1, 0.3);
});
$("#siolaLegal_2a2").on('click', function () {
  siolaLegalL2a2.show = !siolaLegalL2a2.show;
  makeOtherTransparentSiola(siolaLegalL2a2, 0.3);
});
$("#siolaLegal_2a3").on('click', function () {
  siolaLegalL2a3.show = !siolaLegalL2a3.show;
  makeOtherTransparentSiola(siolaLegalL1a1, 0.3);
});
$("#siolaLegal_2a4").on('click', function () {
  siolaLegalL2a4.show = !siolaLegalL2a4.show;
  makeOtherTransparentSiola(siolaLegalL2a4, 0.3);
});
$("#siolaLegal_2a5").on('click', function () {
  siolaLegalL2a5.show = !siolaLegalL2a5.show;
  makeOtherTransparentSiola(siolaLegalL2a5, 0.3);
});
$("#siolaLegal_2a6").on('click', function () {
  siolaLegalL2a6.show = !siolaLegalL2a6.show;
  makeOtherTransparentSiola(siolaLegalL2a6, 0.3);
});
$("#siolaLegal_2a7").on('click', function () {
  siolaLegalL2a7.show = !siolaLegalL2a7.show;
  makeOtherTransparentSiola(siolaLegalL2a7, 0.3);
});

$("#siolaLegal_3a1").on('click', function () {
  siolaLegalL3a1.show = !siolaLegalL3a1.show;
  makeOtherTransparentSiola(siolaLegalL3a1, 0.3);
});
$("#siolaLegal_3a2").on('click', function () {
  siolaLegalL3a2.show = !siolaLegalL3a2.show;
  makeOtherTransparentSiola(siolaLegalL3a2, 0.3);
});
$("#siolaLegal_3a3").on('click', function () {
  siolaLegalL3a3.show = !siolaLegalL3a3.show;
  makeOtherTransparentSiola(siolaLegalL3a3, 0.3);
});
$("#siolaLegal_3a4").on('click', function () {
  siolaLegalL3a4.show = !siolaLegalL3a4.show;
  makeOtherTransparentSiola(siolaLegalL3a4, 0.3);
});
$("#siolaLegal_3a5").on('click', function () {
  siolaLegalL3a5.show = !siolaLegalL3a5.show;
  makeOtherTransparentSiola(siolaLegalL3a5, 0.3);
});
$("#siolaLegal_3a6").on('click', function () {
  siolaLegalL3a6.show = !siolaLegalL3a6.show;
  makeOtherTransparentSiola(siolaLegalL3a6, 0.3);
});
$("#siolaLegal_3a7").on('click', function () {
  siolaLegalL3a7.show = !siolaLegalL3a7.show;
  makeOtherTransparentSiola(siolaLegalL3a7, 0.3);
});

$("#siolaLegal_4a1").on('click', function () {
  siolaLegalL4a1.show = !siolaLegalL4a1.show;
  makeOtherTransparentSiola(siolaLegalL4a1, 0.3);
});
$("#siolaLegal_4a2").on('click', function () {
  siolaLegalL4a2.show = !siolaLegalL4a2.show;
  makeOtherTransparentSiola(siolaLegalL4a2, 0.3);
});
$("#siolaLegal_4a3").on('click', function () {
  siolaLegalL4a3.show = !siolaLegalL4a3.show;
  makeOtherTransparentSiola(siolaLegalL4a3, 0.3);
});

$("#siolaLegal_5a1").on('click', function () {
  siolaLegalL5a1.show = !siolaLegalL5a1.show;
  makeOtherTransparentSiola(siolaLegalL5a1, 0.3);
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


// Layering button Rusunawa
$("#rusunawaLevel_1").on('click', function () {
  rusunawaBuildingL1.show = !rusunawaBuildingL1.show;
});
$("#rusunawaLevel_2").on('click', function () {
  rusunawaBuildingL2.show = !rusunawaBuildingL2.show;
});
$("#rusunawaLevel_3").on('click', function () {
  rusunawaBuildingL3.show = !rusunawaBuildingL3.show;
});
$("#rusunawaLevel_4").on('click', function () {
  rusunawaBuildingL4.show = !rusunawaBuildingL4.show;
});
$("#rusunawaLevel_5").on('click', function () {
  rusunawaBuildingL5.show = !rusunawaBuildingL5.show;
});
$("#rusunawaLevel_r").on('click', function () {
  rusunawaBuildingLR.show = !rusunawaBuildingLR.show;
});


//// Layering check/uncheck all
// siola
$('#siolaLevelAllHide').click(function () {
  siolaBuildingL0.show = false;
  siolaBuildingL1.show = false;
  siolaBuildingL2.show = false;
  siolaBuildingL3.show = false;
  siolaBuildingL4.show = false;
  siolaBuildingL5.show = false;
  $('.siola-building-layer-panel .set_level').prop('checked', false);
});
$('#siolaLevelAllShow').click(function () {
  siolaBuildingL0.show = true;
  siolaBuildingL1.show = true;
  siolaBuildingL2.show = true;
  siolaBuildingL3.show = true;
  siolaBuildingL4.show = true;
  siolaBuildingL5.show = true;
  $('.siola-building-layer-panel .set_level').prop('checked', true);
});

$("#siolaLegal_1all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    siolaLegalL1a1.show = true;
    siolaLegalL1a2.show = true;
    siolaLegalL1a3.show = true;
    siolaLegalL1a4.show = true;
    siolaLegalL1a5.show = true;
    siolaLegalL1a6.show = true;
    siolaLegalL1a7.show = true;
    siolaLegalL1a8.show = true;
    siolaLegalL1a9.show = true;
    siolaLegalL1a10.show = true;
  } else {
    siolaLegalL1a1.show = false;
    siolaLegalL1a2.show = false;
    siolaLegalL1a3.show = false;
    siolaLegalL1a4.show = false;
    siolaLegalL1a5.show = false;
    siolaLegalL1a6.show = false;
    siolaLegalL1a7.show = false;
    siolaLegalL1a8.show = false;
    siolaLegalL1a9.show = false;
    siolaLegalL1a10.show = false;
  }
});
$("#siolaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    siolaLegalL2a1.show = true;
    siolaLegalL2a2.show = true;
    siolaLegalL2a3.show = true;
    siolaLegalL2a4.show = true;
    siolaLegalL2a5.show = true;
    siolaLegalL2a6.show = true;
    siolaLegalL2a7.show = true;
  } else {
    siolaLegalL2a1.show = false;
    siolaLegalL2a2.show = false;
    siolaLegalL2a3.show = false;
    siolaLegalL2a4.show = false;
    siolaLegalL2a5.show = false;
    siolaLegalL2a6.show = false;
    siolaLegalL2a7.show = false;
  }
});
$("#siolaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    siolaLegalL3a1.show = true;
    siolaLegalL3a2.show = true;
    siolaLegalL3a3.show = true;
    siolaLegalL3a4.show = true;
    siolaLegalL3a5.show = true;
    siolaLegalL3a6.show = true;
    siolaLegalL3a7.show = true;
  } else {
    siolaLegalL3a1.show = false;
    siolaLegalL3a2.show = false;
    siolaLegalL3a3.show = false;
    siolaLegalL3a4.show = false;
    siolaLegalL3a5.show = false;
    siolaLegalL3a6.show = false;
    siolaLegalL3a7.show = false;
  }
});
$("#siolaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    siolaLegalL4a1.show = true;
    siolaLegalL4a2.show = true;
    siolaLegalL4a3.show = true;
  } else {
    siolaLegalL4a1.show = false;
    siolaLegalL4a2.show = false;
    siolaLegalL4a3.show = false;
  }
});
$("#siolaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    siolaLegalL5a1.show = true;
  } else {
    siolaLegalL5a1.show = false;
  }
});

// balai pemuda
$('#balaiLevelAllHide').click(function () {
  balaiBuildingL0.show = false;
  balaiBuildingL1.show = false;
  balaiBuildingL2.show = false;
  $('.balai-building-layer-panel .set_level').prop('checked', false);
});
$('#balaiLevelAllShow').click(function () {
  balaiBuildingL0.show = true;
  balaiBuildingL1.show = true;
  balaiBuildingL2.show = true;
  $('.balai-building-layer-panel .set_level').prop('checked', true);
});
// rusunawa
$('#rusunawaLevelAllHide').click(function () {
  rusunawaBuildingL1.show = false;
  rusunawaBuildingL2.show = false;
  rusunawaBuildingL3.show = false;
  rusunawaBuildingL4.show = false;
  rusunawaBuildingL5.show = false;
  $('.rusunawa-building-layer-panel .set_level').prop('checked', false);
});
$('#rusunawaLevelAllShow').click(function () {
  rusunawaBuildingL1.show = true;
  rusunawaBuildingL2.show = true;
  rusunawaBuildingL3.show = true;
  rusunawaBuildingL4.show = true;
  rusunawaBuildingL5.show = true;
  $('.rusunawa-building-layer-panel .set_level').prop('checked', true);
});

// underground view
$("#underground_1").on('click', function () {
  viewer.scene.globe.depthTestAgainstTerrain = !viewer.scene.globe.depthTestAgainstTerrain;
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !viewer.scene.screenSpaceCameraController.enableCollisionDetection;
  viewer.scene.globe.translucency.frontFaceAlphaByDistance.nearValue = 0.4;
});

// hide preloader after finish load data
$(document).ready(function () {
  $(".preload").addClass("d-none");
});

// handle autocomplete seacrh
$(document).ready(function () {
  const suggestions = ["JavaScript", "HTML", "CSS", "Python", "Java", "React", "Node.js", "Angular", "Vue.js"];
  $("#searchInput").keyup(function (e) {
    const inputValue = $("#searchInput").val().toLowerCase();
    // Hide autocomplete results if the input is empty
    if (!inputValue.trim()) {
      $("#autocompleteResults").html("");
      return;
    }
    const filteredSuggestions = suggestions.filter(suggestion =>
      suggestion.toLowerCase().includes(inputValue)
    );
    // Generate HTML for autocomplete results
    const resultsHTML = filteredSuggestions.map(suggestion =>
      `<div class="autocomplete-item">${suggestion}</div>`
    ).join("");
    $("#autocompleteResults").html(resultsHTML);
    // Attach click event to each autocomplete item
    $(".autocomplete-item").on("click", function () {
      selectSuggestion($(this).text());
    });
  });

  function selectSuggestion(value) {
    $("#searchInput").val(value);
    $("#autocompleteResults").html("");

    // Call specific function based on selected suggestion
    switch (value.toLowerCase()) {
      case "python":
        python();
        break;
      case "java":
        java();
        break;
      default:
        // Default case if no specific function is defined for the suggestion
        break;
    }
  }

  function python() {
    // Your Python function implementation here
    console.log("Running Python function");
  }

  function java() {
    // Your Python function implementation here
    console.log("Running Java function");
  }
});