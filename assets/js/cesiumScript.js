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

// viewer.imageryLayers.removeAll();
// viewer.imageryLayers.addImageryProvider(new Cesium.OpenStreetMapImageryProvider({
//   url: 'https://tile.openstreetmap.org/'
// }));

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

function zoomToLocation(tileset, pitchDegrees = -25, headingDegrees = 0, zoomDistance = 300) {
  // Zoom to the tileset
  const heading = Cesium.Math.toRadians(headingDegrees);
  const pitch = Cesium.Math.toRadians(pitchDegrees);
  viewer.flyTo(tileset, {
    offset: new Cesium.HeadingPitchRange(heading, pitch, zoomDistance),
    orientation: {
      heading: heading,
      pitch: pitch,
    }
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
const siolaBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337813, {
    show: true,
    featureIdLabel: "SBL0",
  })
);
const siolaBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337814, {
    show: true,
    featureIdLabel: "SBL1",
  })
);
const siolaBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337815, {
    show: true,
    featureIdLabel: "SBL2",
  })
);
const siolaBuildingL3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337816, {
    show: true,
    featureIdLabel: "SBL3",
  })
);
const siolaBuildingL4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337817, {
    show: true,
    featureIdLabel: "SBL4",
  })
);
const siolaBuildingL5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337818, {
    show: true,
    featureIdLabel: "SBL5",
  }, )
);

const siolaLegalL1a1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346408, {
    show: true,
    featureIdLabel: "SL1a1",
  }, )
);
const siolaLegalL1a2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346409, {
    show: true,
    featureIdLabel: "SL1a2",
  }, )
);
const siolaLegalL1a3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346410, {
    show: true,
    featureIdLabel: "SL1a3",
  }, )
);
const siolaLegalL1a4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346413, {
    show: true,
    featureIdLabel: "SL1a4",
  }, )
);
const siolaLegalL1a5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346415, {
    show: true,
    featureIdLabel: "SL1a5",
  }, )
);
const siolaLegalL1a6 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346416, {
    show: true,
    featureIdLabel: "SL1a6",
  }, )
);
const siolaLegalL1a7 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347030, {
    show: true,
    featureIdLabel: "SL1a7",
  }, )
);
const siolaLegalL1a8 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346419, {
    show: true,
    featureIdLabel: "SL1a8",
  }, )
);
const siolaLegalL1a9 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346420, {
    show: true,
    featureIdLabel: "SL1a9",
  }, )
);
const siolaLegalL1a10 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346553, {
    show: true,
    featureIdLabel: "SL1a10",
  }, )
);

const siolaLegalL2a1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346717, {
    show: true,
    featureIdLabel: "SL2a1",
  }, )
);
const siolaLegalL2a2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346718, {
    show: true,
    featureIdLabel: "SL2a2",
  }, )
);
const siolaLegalL2a3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346720, {
    show: true,
    featureIdLabel: "SL2a3",
  }, )
);
const siolaLegalL2a4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346721, {
    show: true,
    featureIdLabel: "SL2a4",
  }, )
);
const siolaLegalL2a5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346722, {
    show: true,
    featureIdLabel: "SL2a5",
  }, )
);
const siolaLegalL2a6 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346723, {
    show: true,
    featureIdLabel: "SL2a6",
  }, )
);
const siolaLegalL2a7 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346724, {
    show: true,
    featureIdLabel: "SL2a7",
  }, )
);

const siolaLegalL3a1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347178, {
    show: true,
    featureIdLabel: "SL3a1",
  }, )
);
const siolaLegalL3a2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347184, {
    show: true,
    featureIdLabel: "SL3a2",
  }, )
);
const siolaLegalL3a3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347185, {
    show: true,
    featureIdLabel: "SL3a3",
  }, )
);
const siolaLegalL3a4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347186, {
    show: true,
    featureIdLabel: "SL3a4",
  }, )
);
const siolaLegalL3a5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347187, {
    show: true,
    featureIdLabel: "SL3a5",
  }, )
);
const siolaLegalL3a6 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347188, {
    show: true,
    featureIdLabel: "SL3a6",
  }, )
);
const siolaLegalL3a7 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347190, {
    show: true,
    featureIdLabel: "SL3a7",
  }, )
);

const siolaLegalL4a1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347193, {
    show: true,
    featureIdLabel: "SL4a1",
  }, )
);
const siolaLegalL4a2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347195, {
    show: true,
    featureIdLabel: "SL4a2",
  }, )
);
const siolaLegalL4a3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347197, {
    show: true,
    featureIdLabel: "SL4a3",
  }, )
);

const siolaLegalL5a1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2347200, {
    show: true,
    featureIdLabel: "SL5a1",
  }, )
);

const siolaLegalBT = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346402, {
    show: true,
    featureIdLabel: "SBT",
  }, )
);
const siolaLegalBB = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2346745, {
    show: true,
    featureIdLabel: "SBB",
  }, )
);
siolaLegalBT.style = createTransparentStyle(0.2);
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

viewer.screenSpaceEventHandler.setInputAction(function onLeftClick(movement) {
    // Pick a new feature
    const pickedFeature = viewer.scene.pick(movement.position);
    console.log(pickedFeature);
    console.log(pickedFeature.primitive.featureIdLabel);
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
  siolaBuildingL0.show = $(this).prop("checked");
});
$("#siolaLevel_1").on('click', function () {
  siolaBuildingL1.show = $(this).prop("checked");
});
$("#siolaLevel_2").on('click', function () {
  siolaBuildingL2.show = $(this).prop("checked");
});
$("#siolaLevel_3").on('click', function () {
  siolaBuildingL3.show = $(this).prop("checked");
});
$("#siolaLevel_4").on('click', function () {
  siolaBuildingL4.show = $(this).prop("checked");
});
$("#siolaLevel_5").on('click', function () {
  siolaBuildingL5.show = $(this).prop("checked");
});

$("#siolaVirtual_1").on('click', function () {
  siolaLegalBT.show = $(this).prop("checked");
});
$("#siolaVirtual_2").on('click', function () {
  siolaLegalBB.show = $(this).prop("checked");
});

$("#siolaLegal_1a1").on('click', function () {
  siolaLegalL1a1.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a1, 0.3);
});
$("#siolaLegal_1a2").on('click', function () {
  siolaLegalL1a2.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a2, 0.3);
});
$("#siolaLegal_1a3").on('click', function () {
  siolaLegalL1a3.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a3, 0.3);
});
$("#siolaLegal_1a4").on('click', function () {
  siolaLegalL1a4.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a4, 0.3);
});
$("#siolaLegal_1a5").on('click', function () {
  siolaLegalL1a5.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a5, 0.3);
});
$("#siolaLegal_1a6").on('click', function () {
  siolaLegalL1a6.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a6, 0.3);
});
$("#siolaLegal_1a7").on('click', function () {
  siolaLegalL1a7.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a7, 0.3);
});
$("#siolaLegal_1a8").on('click', function () {
  siolaLegalL1a8.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a8, 0.3);
});
$("#siolaLegal_1a9").on('click', function () {
  siolaLegalL1a9.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a9, 0.3);
});
$("#siolaLegal_1a10").on('click', function () {
  siolaLegalL1a10.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL1a10, 0.3);
});

$("#siolaLegal_2a1").on('click', function () {
  siolaLegalL2a1.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL2a1, 0.3);
});
$("#siolaLegal_2a2").on('click', function () {
  siolaLegalL2a2.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL2a2, 0.3);
});
$("#siolaLegal_2a3").on('click', function () {
  siolaLegalL2a3.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL2a3, 0.3);
});
$("#siolaLegal_2a4").on('click', function () {
  siolaLegalL2a4.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL2a4, 0.3);
});
$("#siolaLegal_2a5").on('click', function () {
  siolaLegalL2a5.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL2a5, 0.3);
});
$("#siolaLegal_2a6").on('click', function () {
  siolaLegalL2a6.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL2a6, 0.3);
});
$("#siolaLegal_2a7").on('click', function () {
  siolaLegalL2a7.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL2a7, 0.3);
});

$("#siolaLegal_3a1").on('click', function () {
  siolaLegalL3a1.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL3a1, 0.3);
});
$("#siolaLegal_3a2").on('click', function () {
  siolaLegalL3a2.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL3a2, 0.3);
});
$("#siolaLegal_3a3").on('click', function () {
  siolaLegalL3a3.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL3a3, 0.3);
});
$("#siolaLegal_3a4").on('click', function () {
  siolaLegalL3a4.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL3a4, 0.3);
});
$("#siolaLegal_3a5").on('click', function () {
  siolaLegalL3a5.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL3a5, 0.3);
});
$("#siolaLegal_3a6").on('click', function () {
  siolaLegalL3a6.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL3a6, 0.3);
});
$("#siolaLegal_3a7").on('click', function () {
  siolaLegalL3a7.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL3a7, 0.3);
});

$("#siolaLegal_4a1").on('click', function () {
  siolaLegalL4a1.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL4a1, 0.3);
});
$("#siolaLegal_4a2").on('click', function () {
  siolaLegalL4a2.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL4a2, 0.3);
});
$("#siolaLegal_4a3").on('click', function () {
  siolaLegalL4a3.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL4a3, 0.3);
});

$("#siolaLegal_5a1").on('click', function () {
  siolaLegalL5a1.show = $(this).prop("checked");
  makeOtherTransparentSiola(siolaLegalL5a1, 0.3);
});


// Layering button Balai pemuda
$("#balaiLevel_0").on('click', function () {
  balaiBuildingL0.show = $(this).prop("checked");
});
$("#balaiLevel_1").on('click', function () {
  balaiBuildingL1.show = $(this).prop("checked");
});
$("#balaiLevel_2").on('click', function () {
  balaiBuildingL2.show = $(this).prop("checked");
});


// Layering button Rusunawa
$("#rusunawaLevel_1").on('click', function () {
  rusunawaBuildingL1.show = $(this).prop("checked");
});
$("#rusunawaLevel_2").on('click', function () {
  rusunawaBuildingL2.show = $(this).prop("checked");
});
$("#rusunawaLevel_3").on('click', function () {
  rusunawaBuildingL3.show = $(this).prop("checked");
});
$("#rusunawaLevel_4").on('click', function () {
  rusunawaBuildingL4.show = $(this).prop("checked");
});
$("#rusunawaLevel_5").on('click', function () {
  rusunawaBuildingL5.show = $(this).prop("checked");
});
$("#rusunawaLevel_r").on('click', function () {
  rusunawaBuildingLR.show = $(this).prop("checked");
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
$(function () {
  $(".preload").addClass("d-none");
});

// handle autocomplete seacrh
$(document).ready(function () {
  const suggestions = ["L0", "L1", "L2", "L3", "L4", "L5", "L1.1", "L1.2", "L1.3", "L1.4", "L1.5", "L1.6", "L1.7", "L1.8", "L1.9", "L1.10", "L2.1", "L2.2", "L2.3", "L2.4", "L2.5", "L2.6", "L2.7", "L3.1", "L3.2", "L3.3", "L3.4", "L3.5", "L3.6", "L3.7", "L4.1", "L4.2", "L4.3", "L5.1", "Siola"];
  $("#searchInput").keyup(function (e) {
    const inputValue = $("#searchInput").val().toLowerCase();
    // Hide autocomplete results if input empty
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
    getSearchResult(value);
  }

  $("#searchButton").click(function (e) {
    selectSuggestion($("#searchInput").val())
  });

  function getSearchResult(value) {
    // Call specific function based on selected suggestion
    switch (value.toLowerCase()) {
      case "l0":
        zoomToLocation(siolaBuildingL0, 15, 90, 150); //tileset, pitchDegrees = -25, headingDegrees = 0, zoomDistance = 300
        break;
      case "l1":
        zoomToLocation(siolaBuildingL1, -5, 90, 150);
        break;
      case "l2":
        zoomToLocation(siolaBuildingL2, -10, 90, 150);
        break;
      case "l3":
        zoomToLocation(siolaBuildingL3, -15, 90, 150);
        break;
      case "l4":
        zoomToLocation(siolaBuildingL4, -20, 90, 150);
        break;
      case "l5":
        zoomToLocation(siolaBuildingL5, -25, 90, 150);
        break;
      case "l1.1":
        zoomToLocation(siolaLegalL1a1, -10, 90, 100);
        makeOtherTransparentSiola(siolaLegalL1a1, 0.3);
        break;
      case "l1.2":
        zoomToLocation(siolaLegalL1a2, -10, 90, 100);
        makeOtherTransparentSiola(siolaLegalL1a2, 0.3);
        break;
      case "l1.3":
        zoomToLocation(siolaLegalL1a3, -10, 90, 100);
        makeOtherTransparentSiola(siolaLegalL1a3, 0.3);
        break;
      case "l1.4":
        zoomToLocation(siolaLegalL1a4, -10, 90, 100);
        makeOtherTransparentSiola(siolaLegalL1a4, 0.3);
        break;
      case "l1.5":
        zoomToLocation(siolaLegalL1a5, -10, 160, 100);
        makeOtherTransparentSiola(siolaLegalL1a5, 0.3);
        break;
      case "l1.6":
        zoomToLocation(siolaLegalL1a6, -10, 140, 100);
        makeOtherTransparentSiola(siolaLegalL1a6, 0.3);
        break;
      case "l1.7":
        zoomToLocation(siolaLegalL1a7, -10, 150, 100);
        makeOtherTransparentSiola(siolaLegalL1a7, 0.3);
        break;
      case "l1.8":
        zoomToLocation(siolaLegalL1a8, -10, 90, 100);
        makeOtherTransparentSiola(siolaLegalL1a8, 0.3);
        break;
      case "l1.9":
        zoomToLocation(siolaLegalL1a9, -10, 90, 100);
        makeOtherTransparentSiola(siolaLegalL1a9, 0.3);
        break;
      case "l1.10":
        zoomToLocation(siolaLegalL1a10, -10, 0, 100);
        makeOtherTransparentSiola(siolaLegalL1a10, 0.3);
        break;
      case "l2.1":
        zoomToLocation(siolaLegalL2a1, -15, 80, 100);
        makeOtherTransparentSiola(siolaLegalL2a1, 0.3);
        break;
      case "l2.2":
        zoomToLocation(siolaLegalL2a2, -15, 100, 100);
        makeOtherTransparentSiola(siolaLegalL2a2, 0.3);
        break;
      case "l2.3":
        zoomToLocation(siolaLegalL2a3, -15, 90, 100);
        makeOtherTransparentSiola(siolaLegalL2a3, 0.3);
        break;
      case "l2.4":
        zoomToLocation(siolaLegalL2a4, -15, 10, 100);
        makeOtherTransparentSiola(siolaLegalL2a4, 0.3);
        break;
      case "l2.5":
        zoomToLocation(siolaLegalL2a5, -15, 140, 100);
        makeOtherTransparentSiola(siolaLegalL2a5, 0.3);
        break;
      case "l2.6":
        zoomToLocation(siolaLegalL2a6, -15, 90, 100);
        makeOtherTransparentSiola(siolaLegalL2a6, 0.3);
        break;
      case "l2.7":
        zoomToLocation(siolaLegalL2a7, -15, -30, 100);
        makeOtherTransparentSiola(siolaLegalL2a7, 0.3);
        break;
      case "l3.1":
        zoomToLocation(siolaLegalL3a1, -20, 90, 100);
        makeOtherTransparentSiola(siolaLegalL3a1, 0.3);
        break;
      case "l3.2":
        zoomToLocation(siolaLegalL3a2, -20, 90, 100);
        makeOtherTransparentSiola(siolaLegalL3a1, 0.3);
        break;
      case "l3.3":
        zoomToLocation(siolaLegalL3a3, -20, 90, 100);
        makeOtherTransparentSiola(siolaLegalL3a3, 0.3);
        break;
      case "l3.4":
        zoomToLocation(siolaLegalL3a4, -20, 90, 100);
        makeOtherTransparentSiola(siolaLegalL3a4, 0.3);
        break;
      case "l3.5":
        zoomToLocation(siolaLegalL3a5, -20, 90, 100);
        makeOtherTransparentSiola(siolaLegalL3a5, 0.3);
        break;
      case "l3.6":
        zoomToLocation(siolaLegalL3a6, -20, 90, 100);
        makeOtherTransparentSiola(siolaLegalL3a6, 0.3);
        break;
      case "l3.7":
        zoomToLocation(siolaLegalL3a7, -20, 90, 100);
        makeOtherTransparentSiola(siolaLegalL3a7, 0.3);
        break;
      case "l4.1":
        zoomToLocation(siolaLegalL4a1, -25, 80, 100);
        makeOtherTransparentSiola(siolaLegalL4a1, 0.3);
        break;
      case "l4.2":
        zoomToLocation(siolaLegalL4a2, -25, -10, 100);
        makeOtherTransparentSiola(siolaLegalL4a2, 0.3);
        break;
      case "l4.3":
        zoomToLocation(siolaLegalL4a3, -25, 150, 100);
        makeOtherTransparentSiola(siolaLegalL4a3, 0.3);
        break;
      case "l5.1":
        zoomToLocation(siolaLegalL5a1, -25, 90, 100);
        makeOtherTransparentSiola(siolaLegalL5a1, 0.3);
        break;
      case "siola":
        firstCamera()
        break;
      default:
        // Default case if no specific function is defined for the suggestion
        break;
    }

  }

});