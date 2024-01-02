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

// var measureWidget = new Cesium.Measure({
//   container: 'cesiumContainer',
//   scene: viewer.scene,
//   units: new Cesium.MeasureUnits({
//     distanceUnits: Cesium.DistanceUnits.METERS,
//     areaUnits: Cesium.AreaUnits.SQUARE_METERS,
//     volumeUnits: Cesium.VolumeUnits.CUBIC_FEET,
//     angleUnits: Cesium.AngleUnits.DEGREES,
//     slopeUnits: Cesium.AngleUnits.GRADE
//   })
// });

viewer.camera.flyTo({
  destination: Cesium.Cartesian3.fromDegrees(
    112.73677426629814, -7.259593062440535, 20000
  ),
  orientation: {
    heading: Cesium.Math.toRadians(0.0),
    pitch: Cesium.Math.toRadians(-90.0),
  },
});

// Initialize OpenLayers map
const miniMap = new ol.Map({
  target: 'map2d',
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM(),
    }),
  ],
  view: new ol.View({
    center: ol.proj.fromLonLat([0, 0]),
    zoom: 15,
  }),
  controls: ol.control.defaults({
    zoom: false,
    rotate: false,
  }),
});

const getCenterView = function () {
  // Get the current camera position
  const centerCartographic = Cesium.Cartographic.fromCartesian(viewer.camera.positionWC);
  // Get latitude, longitude, and height
  const latitude = Cesium.Math.toDegrees(centerCartographic.longitude);
  const longitude = Cesium.Math.toDegrees(centerCartographic.latitude);
  const height = centerCartographic.height;
  const heading = Cesium.Math.toDegrees(viewer.camera.heading);
  return {
    latitude,
    longitude,
    height,
    heading
  }
}

const getZoom = function (currentView) {
  let zoomLevel;
  // Adjust OpenLayers zoom based on height
  if (currentView.height < 450) {
    zoomLevel = 15;
  } else if (currentView.height < 1200) {
    zoomLevel = 13;
  } else if (currentView.height < 2300) {
    zoomLevel = 12;
  } else if (currentView.height < 4300) {
    zoomLevel = 10;
  } else if (currentView.height < 8300) {
    zoomLevel = 9;
  } else if (currentView.height < 18000) {
    zoomLevel = 8;
  } else if (currentView.height < 40000) {
    zoomLevel = 7;
  } else if (currentView.height < 80000) {
    zoomLevel = 6;
  } else if (currentView.height < 200000) {
    zoomLevel = 5;
  } else {
    zoomLevel = 4;
  }
  return zoomLevel;
};

// Add an event listener for camera move end
viewer.camera.moveEnd.addEventListener(function () {
  const currentView = getCenterView();
  console.log(currentView);
  const zoomLevel = getZoom(currentView);
  // Update OpenLayers view
  miniMap.getView().setCenter(ol.proj.fromLonLat([currentView.latitude, currentView.longitude]));
  miniMap.getView().setZoom(zoomLevel);
  miniMap.getView().setRotation(Cesium.Math.toRadians((-currentView.heading)));
});


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
    },
    duration: 1,
  });
}

function createTransparentStyle(alphaValue) {
  return new Cesium.Cesium3DTileStyle({
    color: {
      conditions: [
        ["true", `rgba(255, 255, 255, ${alphaValue})`],
      ],
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


viewer.screenSpaceEventHandler.setInputAction(function onRightClick(movement) {
    // Pick a new feature
    const pickedFeature = viewer.scene.pick(movement.position);
    console.log("Properties:");
    const propertyIds = pickedFeature.getPropertyIds();
    console.log(propertyIds);
    const length = propertyIds.length;
    console.log(length);
    console.log();
    for (let i = 0; i < length; ++i) {
      const propertyId = propertyIds[i];
      console.log(propertyId);
      console.log(`  ${propertyId}: ${pickedFeature.getProperty(propertyId)}`);
    }
  },
  Cesium.ScreenSpaceEventType.RIGHT_CLICK);


// Layering button Siola  ###########################################################################
$("#siolaLevel_0").change(function () {
  siolaBuildingL0.show = $(this).prop("checked");
});
$("#siolaLevel_1").change(function () {
  siolaBuildingL1.show = $(this).prop("checked");
});
$("#siolaLevel_2").change(function () {
  siolaBuildingL2.show = $(this).prop("checked");
});
$("#siolaLevel_3").change(function () {
  siolaBuildingL3.show = $(this).prop("checked");
});
$("#siolaLevel_4").change(function () {
  siolaBuildingL4.show = $(this).prop("checked");
});
$("#siolaLevel_5").change(function () {
  siolaBuildingL5.show = $(this).prop("checked");
});

$("#siolaLegal_GSB").change(function () {

});
$("#siolaLegal_BT").change(function () {

});
$("#siolaLegal_BB").change(function () {

});

$("#siolaLegal_1a1").change(function () {

});
$("#siolaLegal_1a2").change(function () {

});
$("#siolaLegal_1a3").change(function () {

});
$("#siolaLegal_1a4").change(function () {

});
$("#siolaLegal_1a5").change(function () {

});
$("#siolaLegal_1a6").change(function () {

});
$("#siolaLegal_1a7").change(function () {

});
$("#siolaLegal_1a8").change(function () {

});
$("#siolaLegal_1a9").change(function () {

});
$("#siolaLegal_1a10").change(function () {

});

$("#siolaLegal_2a1").change(function () {

});
$("#siolaLegal_2a2").change(function () {

});
$("#siolaLegal_2a3").change(function () {

});
$("#siolaLegal_2a4").change(function () {

});
$("#siolaLegal_2a5").change(function () {

});
$("#siolaLegal_2a6").change(function () {

});
$("#siolaLegal_2a7").change(function () {

});

$("#siolaLegal_3a1").change(function () {

});
$("#siolaLegal_3a2").change(function () {

});
$("#siolaLegal_3a3").change(function () {

});
$("#siolaLegal_3a4").change(function () {

});
$("#siolaLegal_3a5").change(function () {

});
$("#siolaLegal_3a6").change(function () {

});
$("#siolaLegal_3a7").change(function () {

});

$("#siolaLegal_4a1").change(function () {

});
$("#siolaLegal_4a2").change(function () {

});
$("#siolaLegal_4a3").change(function () {

});

$("#siolaLegal_5a1").change(function () {

});

$("#zoomToSiolaLegal_1all").on('click', function () {
  zoomToLocation(siolaBuildingL1, -5, 90, 150);
});
$("#zoomToSiolaLegal_2all").on('click', function () {
  zoomToLocation(siolaBuildingL2, -10, 90, 150);
});
$("#zoomToSiolaLegal_3all").on('click', function () {
  zoomToLocation(siolaBuildingL3, -15, 90, 150);
});
$("#zoomToSiolaLegal_4all").on('click', function () {
  zoomToLocation(siolaBuildingL4, -20, 90, 150);
});
$("#zoomToSiolaLegal_5all").on('click', function () {
  zoomToLocation(siolaBuildingL5, -25, 90, 150);
});

$("#zoomToSiolaLegal_1a1").on('click', function () {
  zoomToLocation(siolaLegalL1a1, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a2").on('click', function () {
  zoomToLocation(siolaLegalL1a2, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a3").on('click', function () {
  zoomToLocation(siolaLegalL1a3, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a4").on('click', function () {
  zoomToLocation(siolaLegalL1a4, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a5").on('click', function () {
  zoomToLocation(siolaLegalL1a5, -10, 160, 100);
});
$("#zoomToSiolaLegal_1a6").on('click', function () {
  zoomToLocation(siolaLegalL1a6, -10, 140, 100);
});
$("#zoomToSiolaLegal_1a7").on('click', function () {
  zoomToLocation(siolaLegalL1a7, -10, 150, 100);
});
$("#zoomToSiolaLegal_1a8").on('click', function () {
  zoomToLocation(siolaLegalL1a8, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a9").on('click', function () {
  zoomToLocation(siolaLegalL1a9, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a10").on('click', function () {
  zoomToLocation(siolaLegalL1a10, -10, 0, 100);
});

$("#zoomToSiolaLegal_2a1").on('click', function () {
  zoomToLocation(siolaLegalL2a1, -15, 80, 100);
});
$("#zoomToSiolaLegal_2a2").on('click', function () {
  zoomToLocation(siolaLegalL2a2, -15, 100, 100);
});
$("#zoomToSiolaLegal_2a3").on('click', function () {
  zoomToLocation(siolaLegalL2a3, -15, 90, 100);
});
$("#zoomToSiolaLegal_2a4").on('click', function () {
  zoomToLocation(siolaLegalL2a4, -15, 10, 100);
});
$("#zoomToSiolaLegal_2a5").on('click', function () {
  zoomToLocation(siolaLegalL2a5, -15, 140, 100);
});
$("#zoomToSiolaLegal_2a6").on('click', function () {
  zoomToLocation(siolaLegalL2a6, -15, 90, 100);
});
$("#zoomToSiolaLegal_2a7").on('click', function () {
  zoomToLocation(siolaLegalL2a7, -15, -30, 100);
});

$("#zoomToSiolaLegal_3a1").on('click', function () {
  zoomToLocation(siolaLegalL3a1, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a2").on('click', function () {
  zoomToLocation(siolaLegalL3a2, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a3").on('click', function () {
  zoomToLocation(siolaLegalL3a3, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a4").on('click', function () {
  zoomToLocation(siolaLegalL3a4, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a5").on('click', function () {
  zoomToLocation(siolaLegalL3a5, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a6").on('click', function () {
  zoomToLocation(siolaLegalL3a6, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a7").on('click', function () {
  zoomToLocation(siolaLegalL3a7, -20, 90, 100);
});

$("#zoomToSiolaLegal_4a1").on('click', function () {
  zoomToLocation(siolaLegalL4a1, -25, 80, 100);
});
$("#zoomToSiolaLegal_4a2").on('click', function () {
  zoomToLocation(siolaLegalL4a2, -25, -10, 100);
});
$("#zoomToSiolaLegal_4a3").on('click', function () {
  zoomToLocation(siolaLegalL4a3, -25, 150, 100);
});

$("#zoomToSiolaLegal_5a1").on('click', function () {
  zoomToLocation(siolaLegalL5a1, -25, 90, 100);
});

$("#zoomToSiolaLegal_gsb").on('click', function () {
  zoomToLocation(siolaLegalGSB, -20, 90, 150);
});
$("#zoomToSiolaLegal_bt").on('click', function () {
  zoomToLocation(siolaLegalBT, -20, 90, 150);
});
$("#zoomToSiolaLegal_bb").on('click', function () {
  zoomToLocation(siolaLegalBB, 15, 90, 150);
});


// Layering button Balai pemuda   #######################################################################
$("#balaiLevel_00").on('click', function () {
  balaiBuildingL0.show = $(this).prop("checked");
});
$("#balaiLevel_0").on('click', function () {
  balaiBuildingBasement.show = $(this).prop("checked");
});
$("#balaiLevel_1").on('click', function () {
  balaiBuildingL1.show = $(this).prop("checked");
});
$("#balaiLevel_2").on('click', function () {
  balaiBuildingL2.show = $(this).prop("checked");
});

$("#balaiLegal_1a1").change(function () {

});
$("#balaiLegal_1a2").change(function () {

});
$("#balaiLegal_1a3").change(function () {

});
$("#balaiLegal_1a4").change(function () {

});
$("#balaiLegal_1a5").change(function () {

});
$("#balaiLegal_1a6").change(function () {

});
$("#balaiLegal_1a7").change(function () {

});
$("#balaiLegal_1a8").change(function () {

});
$("#balaiLegal_1a9").change(function () {

});
$("#balaiLegal_1a10").change(function () {

});
$("#balaiLegal_1a11").change(function () {

});
$("#balaiLegal_1a12").change(function () {

});
$("#balaiLegal_1a13").change(function () {

});

$("#balaiLegal_0a1").change(function () {

});
$("#balaiLegal_0a2").change(function () {

});
$("#balaiLegal_0a3").change(function () {

});
$("#balaiLegal_0a4").change(function () {

});
$("#balaiLegal_0a5").change(function () {

});
$("#balaiLegal_0a6").change(function () {

});
$("#balaiLegal_0a7").change(function () {

});
$("#balaiLegal_0a8").change(function () {

});
$("#balaiLegal_0a9").change(function () {

});

$("#balaiLegal_GSB").change(function () {

});
$("#balaiLegal_BB").change(function () {

});
$("#balaiLegal_BT").change(function () {

});

$("#zoomToBalaiLegal_0all").on('click', function () {
  zoomToLocation(balaiBuildingL1, -25, 180, 100);
});
$("#zoomToBalaiLegal_1all").on('click', function () {
  zoomToLocation(balaiBuildingL1, -25, 0, 100);
});

$("#zoomToBalaiLegal_gsb").on('click', function () {
  zoomToLocation(balaiLegalGSB, -20, 25, 300);
});
$("#zoomToBalaiLegal_bt").on('click', function () {
  zoomToLocation(balaiLegalBT, -20, 25, 300);
});
$("#zoomToBalaiLegal_bb").on('click', function () {
  zoomToLocation(balaiLegalBB, 15, 25, 300);
});

$("#zoomToBalaiLegal_1a1").on('click', function () {
  zoomToLocation(balaiLegalL1a1, -45, 20, 100);
});
$("#zoomToBalaiLegal_1a2").on('click', function () {
  zoomToLocation(balaiLegalL1a2, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a3").on('click', function () {
  zoomToLocation(balaiLegalL1a3, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a4").on('click', function () {
  zoomToLocation(balaiLegalL1a4, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a5").on('click', function () {
  zoomToLocation(balaiLegalL1a5, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a6").on('click', function () {
  zoomToLocation(balaiLegalL1a6, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a7").on('click', function () {
  zoomToLocation(balaiLegalL1a7, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a8").on('click', function () {
  zoomToLocation(balaiLegalL1a8, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a9").on('click', function () {
  zoomToLocation(balaiLegalL1a9, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a10").on('click', function () {
  zoomToLocation(balaiLegalL1a10, -25, 0, 100);
});
$("#zoomToBalaiLegal_1a11").on('click', function () {
  zoomToLocation(balaiLegalL1a10, -25, 210, 100);
});
$("#zoomToBalaiLegal_1a12").on('click', function () {
  zoomToLocation(balaiLegalL1a10, -25, 210, 100);
});
$("#zoomToBalaiLegal_1a13").on('click', function () {
  zoomToLocation(balaiLegalL1a10, -25, 210, 100);
});

$("#zoomToBalaiLegal_0a1").on('click', function () {
  zoomToLocation(balaiLegalL0a1, -45, 25, 100);
});
$("#zoomToBalaiLegal_0a2").on('click', function () {
  zoomToLocation(balaiLegalL0a2, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a3").on('click', function () {
  zoomToLocation(balaiLegalL0a3, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a4").on('click', function () {
  zoomToLocation(balaiLegalL0a4, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a5").on('click', function () {
  zoomToLocation(balaiLegalL0a5, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a6").on('click', function () {
  zoomToLocation(balaiLegalL0a6, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a7").on('click', function () {
  zoomToLocation(balaiLegalL0a7, -25, 20, 100);
});
$("#zoomToBalaiLegal_0a8").on('click', function () {
  zoomToLocation(balaiLegalL0a8, -25, 20, 100);
});
$("#zoomToBalaiLegal_0a9").on('click', function () {
  zoomToLocation(balaiLegalL0a9, -25, 20, 100);
});

// Layering button Rusunawa   ##########################################################################
$("#rusunawaLevel_0").change(function () {
  rusunawaBuildingL0.show = $(this).prop("checked");
});
$("#rusunawaLevel_1").change(function () {
  rusunawaBuildingL1.show = $(this).prop("checked");
});
$("#rusunawaLevel_2").change(function () {
  rusunawaBuildingL2.show = $(this).prop("checked");
});
$("#rusunawaLevel_3").change(function () {
  rusunawaBuildingL3.show = $(this).prop("checked");
});
$("#rusunawaLevel_4").change(function () {
  rusunawaBuildingL4.show = $(this).prop("checked");
});
$("#rusunawaLevel_5").change(function () {
  rusunawaBuildingL5.show = $(this).prop("checked");
});
$("#rusunawaLevel_r").change(function () {
  rusunawaBuildingL6.show = $(this).prop("checked");
});

$("#rusunawaLegal_1a1").change(function () {

});
$("#rusunawaLegal_1a2").change(function () {

});
$("#rusunawaLegal_1a3").change(function () {

});
$("#rusunawaLegal_1a4").change(function () {

});
$("#rusunawaLegal_1a5").change(function () {

});
$("#rusunawaLegal_1a6").change(function () {

});
$("#rusunawaLegal_1a7").change(function () {

});
$("#rusunawaLegal_1a8").change(function () {

});
$("#rusunawaLegal_1a9").change(function () {

});
$("#rusunawaLegal_1a10").change(function () {

});
$("#rusunawaLegal_1a11").change(function () {

});
$("#rusunawaLegal_1a12").change(function () {

});
$("#rusunawaLegal_1a13").change(function () {

});
$("#rusunawaLegal_1a14").change(function () {

});
$("#rusunawaLegal_1a15").change(function () {

});

$("#rusunawaLegal_2a1").change(function () {

});
$("#rusunawaLegal_2a2").change(function () {

});
$("#rusunawaLegal_2a3").change(function () {

});
$("#rusunawaLegal_2a4").change(function () {

});

$("#rusunawaLegal_3a1").change(function () {

});
$("#rusunawaLegal_3a2").change(function () {

});
$("#rusunawaLegal_3a3").change(function () {

});
$("#rusunawaLegal_3a4").change(function () {

});

$("#rusunawaLegal_4a1").change(function () {

});
$("#rusunawaLegal_4a2").change(function () {

});
$("#rusunawaLegal_4a3").change(function () {

});
$("#rusunawaLegal_4a4").change(function () {

});

$("#rusunawaLegal_5a1").change(function () {

});
$("#rusunawaLegal_5a2").change(function () {

});
$("#rusunawaLegal_5a3").change(function () {

});
$("#rusunawaLegal_5a4").change(function () {

});

$("#rusunawaLegal_GSB").change(function () {

});
$("#rusunawaLegal_BB").change(function () {

});
$("#rusunawaLegal_BT").change(function () {

});


$("#zoomToRusunawaLegal_1all").on('click', function () {
  zoomToLocation(rusunawaBuildingL1, -25, 180, 100);
});
$("#zoomToRusunawaLegal_2all").on('click', function () {
  zoomToLocation(rusunawaBuildingL1, -25, 180, 100);
});
$("#zoomToRusunawaLegal_3all").on('click', function () {
  zoomToLocation(rusunawaBuildingL1, -25, 180, 100);
});
$("#zoomToRusunawaLegal_4all").on('click', function () {
  zoomToLocation(rusunawaBuildingL1, -25, 180, 100);
});
$("#zoomToRusunawaLegal_5all").on('click', function () {
  zoomToLocation(rusunawaBuildingL1, -25, 180, 100);
});

$("#zoomToRusunawaLegal_gsb").on('click', function () {
  zoomToLocation(rusunawaLegalGSB, -20, 0, 250);
});
$("#zoomToRusunawaLegal_bt").on('click', function () {
  zoomToLocation(balaiLegalBT, -20, 0, 250);
});
$("#zoomToRusunawaLegal_bb").on('click', function () {
  zoomToLocation(balaiLegalBB, 15, 0, 250);
});

$("#zoomToRusunawaLegal_1a1").on('click', function () {
  zoomToLocation(rusunawaLegalL1a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_1a2").on('click', function () {
  zoomToLocation(rusunawaLegalL1a2, -25, 180, 100);
});
$("#zoomToRusunawaLegal_1a3").on('click', function () {
  zoomToLocation(rusunawaLegalL1a3, -25, 180, 100);
});
$("#zoomToRusunawaLegal_1a4").on('click', function () {
  zoomToLocation(rusunawaLegalL1a4, -25, 180, 100);
});
$("#zoomToRusunawaLegal_1a5").on('click', function () {
  zoomToLocation(rusunawaLegalL1a5, -25, 180, 100);
});
$("#zoomToRusunawaLegal_1a6").on('click', function () {
  zoomToLocation(rusunawaLegalL1a6, -25, 180, 100);
});
$("#zoomToRusunawaLegal_1a7").on('click', function () {
  zoomToLocation(rusunawaLegalL1a7, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a8").on('click', function () {
  zoomToLocation(rusunawaLegalL1a8, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a9").on('click', function () {
  zoomToLocation(rusunawaLegalL1a9, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a10").on('click', function () {
  zoomToLocation(rusunawaLegalL1a10, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a11").on('click', function () {
  zoomToLocation(rusunawaLegalL1a10, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a12").on('click', function () {
  zoomToLocation(rusunawaLegalL1a10, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a13").on('click', function () {
  zoomToLocation(rusunawaLegalL1a10, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a14").on('click', function () {
  zoomToLocation(rusunawaLegalL1a10, -25, 0, 100);
});
$("#zoomToRusunawaLegal_1a15").on('click', function () {
  zoomToLocation(rusunawaLegalL1a10, -25, 0, 100);
});

$("#zoomToRusunawaLegal_2a1").on('click', function () {
  zoomToLocation(rusunawaLegalL2a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_2a2").on('click', function () {
  zoomToLocation(rusunawaLegalL2a2, -25, 180, 100);
});
$("#zoomToRusunawaLegal_2a3").on('click', function () {
  zoomToLocation(rusunawaLegalL2a3, -25, 0, 100);
});
$("#zoomToRusunawaLegal_2a4").on('click', function () {
  zoomToLocation(rusunawaLegalL2a4, -25, 0, 100);
});

$("#zoomToRusunawaLegal_3a1").on('click', function () {
  zoomToLocation(rusunawaLegalL3a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_3a2").on('click', function () {
  zoomToLocation(rusunawaLegalL3a2, -25, 180, 100);
});
$("#zoomToRusunawaLegal_3a3").on('click', function () {
  zoomToLocation(rusunawaLegalL3a3, -25, 0, 100);
});
$("#zoomToRusunawaLegal_3a4").on('click', function () {
  zoomToLocation(rusunawaLegalL3a4, -25, 180, 100);
});

$("#zoomToRusunawaLegal_4a1").on('click', function () {
  zoomToLocation(rusunawaLegalL4a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_4a2").on('click', function () {
  zoomToLocation(rusunawaLegalL4a2, -25, 0, 100);
});
$("#zoomToRusunawaLegal_4a3").on('click', function () {
  zoomToLocation(rusunawaLegalL4a3, -25, 0, 100);
});
$("#zoomToRusunawaLegal_4a4").on('click', function () {
  zoomToLocation(rusunawaLegalL4a4, -25, 180, 100);
});

$("#zoomToRusunawaLegal_5a1").on('click', function () {
  zoomToLocation(rusunawaLegalL5a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_5a2").on('click', function () {
  zoomToLocation(rusunawaLegalL5a2, -25, 0, 100);
});
$("#zoomToRusunawaLegal_5a3").on('click', function () {
  zoomToLocation(rusunawaLegalL5a3, -25, 0, 100);
});
$("#zoomToRusunawaLegal_5a4").on('click', function () {
  zoomToLocation(rusunawaLegalL5a4, -25, 180, 100);
});


//// Layering check/uncheck all #######################################################################
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

  } else {

  }
});
$("#siolaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#siolaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#siolaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#siolaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

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

$("#balaiLegal_0all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#balaiLegal_1all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});

// rusunawa
$('#rusunawaLevelAllHide').click(function () {
  rusunawaBuildingL0.show = false;
  rusunawaBuildingL1.show = false;
  rusunawaBuildingL2.show = false;
  rusunawaBuildingL3.show = false;
  rusunawaBuildingL4.show = false;
  rusunawaBuildingL5.show = false;
  rusunawaBuildingL6.show = false;
  $('.rusunawa-building-layer-panel .set_level').prop('checked', false);
});
$('#rusunawaLevelAllShow').click(function () {
  rusunawaBuildingL0.show = true;
  rusunawaBuildingL1.show = true;
  rusunawaBuildingL2.show = true;
  rusunawaBuildingL3.show = true;
  rusunawaBuildingL4.show = true;
  rusunawaBuildingL5.show = true;
  rusunawaBuildingL6.show = true;
  $('.rusunawa-building-layer-panel .set_level').prop('checked', true);
});

$("#rusunawaLegal_1all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#rusunawaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#rusunawaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#rusunawaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#rusunawaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    rusunawaLegalL5a1.show = true;
    rusunawaLegalL5a2.show = true;
    rusunawaLegalL5a3.show = true;
    rusunawaLegalL5a4.show = true;
  } else {
    rusunawaLegalL5a1.show = false;
    rusunawaLegalL5a2.show = false;
    rusunawaLegalL5a3.show = false;
    rusunawaLegalL5a4.show = false;
  }
});

// underground view   ###############################################################################
$("#underground_1").on('click', function () {
  viewer.scene.globe.depthTestAgainstTerrain = !viewer.scene.globe.depthTestAgainstTerrain;
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !viewer.scene.screenSpaceCameraController.enableCollisionDetection;
  viewer.scene.globe.translucency.frontFaceAlphaByDistance.nearValue = 0.4;
});


// Get Siola   #################################################################################
const siolaBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337191, {
    show: true,
    featureIdLabel: "siolaBuildingL0",
  })
);
const siolaBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337170, {
    show: true,
    featureIdLabel: "siolaBuildingL1",
  })
);
const siolaBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337183, {
    show: true,
    featureIdLabel: "siolaBuildingL2",
  })
);
const siolaBuildingL3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337185, {
    show: true,
    featureIdLabel: "siolaBuildingL3",
  })
);
const siolaBuildingL4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337177, {
    show: true,
    featureIdLabel: "siolaBuildingL4",
  })
);
const siolaBuildingL5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337254, {
    show: true,
    featureIdLabel: "siolaBuildingL5",
  }, )
);

const siolaLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2410900)
);










// hide preloader after finish load data
$(function () {
  $(".preload").addClass("d-none");
  $(".loader-container").removeClass("d-none");
});
firstCamera();

// Get Balai Pemuda   ################################################################################
const balaiBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376896, {
    show: true,
    featureIdLabel: "balaiBuildingL0",
  })
);
const balaiBuildingBasement = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376894, {
    show: true,
    featureIdLabel: "balaiBuildingBasement",
  })
);
const balaiBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376898, {
    show: true,
    featureIdLabel: "balaiBuildingL1",
  })
);
const balaiBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376900, {
    show: true,
    featureIdLabel: "balaiBuildingL2",
  })
);

const balaiLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2410831)
);


// Get Rusunawa   ####################################################################################
const rusunawaBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376598, {
    show: true,
    featureIdLabel: "rusunawaBuildingL0",
  })
);
const rusunawaBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376599, {
    show: true,
    featureIdLabel: "rusunawaBuildingL1",
  })
);
const rusunawaBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376600, {
    show: true,
    featureIdLabel: "rusunawaBuildingL2",
  })
);
const rusunawaBuildingL3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376601, {
    show: true,
    featureIdLabel: "rusunawaBuildingL3",
  })
);
const rusunawaBuildingL4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376602, {
    show: true,
    featureIdLabel: "rusunawaBuildingL4",
  })
);
const rusunawaBuildingL5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376603, {
    show: true,
    featureIdLabel: "rusunawaBuildingL5",
  }, )
);
const rusunawaBuildingL6 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376604, {
    show: true,
    featureIdLabel: "rusunawaBuildingL6",
  }, )
);

const rusunawaLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2410988)
);




// hide preloader after finish load data
$(function () {
  $(".loader-container").removeClass("d-none");
});


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
        break;
      case "l1.2":
        zoomToLocation(siolaLegalL1a2, -10, 90, 100);
        break;
      case "l1.3":
        zoomToLocation(siolaLegalL1a3, -10, 90, 100);
        break;
      case "l1.4":
        zoomToLocation(siolaLegalL1a4, -10, 90, 100);
        break;
      case "l1.5":
        zoomToLocation(siolaLegalL1a5, -10, 160, 100);
        break;
      case "l1.6":
        zoomToLocation(siolaLegalL1a6, -10, 140, 100);
        break;
      case "l1.7":
        zoomToLocation(siolaLegalL1a7, -10, 150, 100);
        break;
      case "l1.8":
        zoomToLocation(siolaLegalL1a8, -10, 90, 100);
        break;
      case "l1.9":
        zoomToLocation(siolaLegalL1a9, -10, 90, 100);
        break;
      case "l1.10":
        zoomToLocation(siolaLegalL1a10, -10, 0, 100);
        break;
      case "l2.1":
        zoomToLocation(siolaLegalL2a1, -15, 80, 100);
        break;
      case "l2.2":
        zoomToLocation(siolaLegalL2a2, -15, 100, 100);
        break;
      case "l2.3":
        zoomToLocation(siolaLegalL2a3, -15, 90, 100);
        break;
      case "l2.4":
        zoomToLocation(siolaLegalL2a4, -15, 10, 100);
        break;
      case "l2.5":
        zoomToLocation(siolaLegalL2a5, -15, 140, 100);
        break;
      case "l2.6":
        zoomToLocation(siolaLegalL2a6, -15, 90, 100);
        break;
      case "l2.7":
        zoomToLocation(siolaLegalL2a7, -15, -30, 100);
        break;
      case "l3.1":
        zoomToLocation(siolaLegalL3a1, -20, 90, 100);
        break;
      case "l3.2":
        zoomToLocation(siolaLegalL3a2, -20, 90, 100);
        break;
      case "l3.3":
        zoomToLocation(siolaLegalL3a3, -20, 90, 100);
        break;
      case "l3.4":
        zoomToLocation(siolaLegalL3a4, -20, 90, 100);
        break;
      case "l3.5":
        zoomToLocation(siolaLegalL3a5, -20, 90, 100);
        break;
      case "l3.6":
        zoomToLocation(siolaLegalL3a6, -20, 90, 100);
        break;
      case "l3.7":
        zoomToLocation(siolaLegalL3a7, -20, 90, 100);
        break;
      case "l4.1":
        zoomToLocation(siolaLegalL4a1, -25, 80, 100);
        break;
      case "l4.2":
        zoomToLocation(siolaLegalL4a2, -25, -10, 100);
        break;
      case "l4.3":
        zoomToLocation(siolaLegalL4a3, -25, 150, 100);
        break;
      case "l5.1":
        zoomToLocation(siolaLegalL5a1, -25, 90, 100);
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

$(document).ready(function () {
  $(".loader-container").addClass("d-none");
});