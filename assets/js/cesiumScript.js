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
viewer.scene.globe.baseColor = Cesium.Color.ALICEBLUE;
viewer.scene.globe.undergroundColor = Cesium.Color.TRANSPARENT;
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
// add marker building object in openlayers
const markerSiola = new ol.Feature({
  geometry: new ol.geom.Point(
    ol.proj.fromLonLat([112.73775781677266, -7.256371890525727])
  ),
});
const markerBalai = new ol.Feature({
  geometry: new ol.geom.Point(
    ol.proj.fromLonLat([112.74531573749071, -7.264032458811419])
  ),
});
const markerRusunawa = new ol.Feature({
  geometry: new ol.geom.Point(
    ol.proj.fromLonLat([112.64459980831899, -8.010094631402152])
  ),
});
const vectorSource = new ol.source.Vector({
  features: [markerSiola, markerBalai, markerRusunawa],
});
const vectorLayer = new ol.layer.Vector({
  source: vectorSource,
});
miniMap.addLayer(vectorLayer);
// get center view from cesium
const getCenterView = function () {
  // Get the current camera position
  const centerCartographic = Cesium.Cartographic.fromCartesian(viewer.camera.positionWC);
  // Get latitude, longitude, and height heading
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
// Adjust OpenLayers zoom based on height
const getZoom = function (currentView) {
  let zoomLevel;
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


const layers = viewer.imageryLayers;
const openStreetMapBasemap = layers.addImageryProvider(new Cesium.OpenStreetMapImageryProvider({
  url: "https://a.tile.openstreetmap.org/",
  show: false,
}));

function changeBasemapLayer(selectedBasemap) {
  // console.log(layers);
  if ($("#ShowBasemap").prop("checked") === true) {
    const basemap = viewer.imageryLayers;
    const bingMapsAerial = basemap.get(0);
    const openstreetmap = basemap.get(1);
    switch (selectedBasemap) {
      case "OpenStreetMap":
        openstreetmap.show = true;
        bingMapsAerial.show = false;
        break;
      case "BingMapsAerial":
        bingMapsAerial.show = true;
        openstreetmap.show = false;
        break;
      default:
        bingMapsAerial.show = true;
        openstreetmap.show = false;
        break;
    }
  }
}

// Set the initial basemap layer
changeBasemapLayer($("#basemapSelector").val());

// Handle basemap selector change event
$("#basemapSelector, #ShowBasemap").change(function () {
  if ($("#ShowBasemap").prop("checked")) {
    changeBasemapLayer($("#basemapSelector").val());
    $("#underground_1").prop("checked", !$("#ShowBasemap").prop("checked"));
  } else {
    const basemap = viewer.imageryLayers;
    const bingMapsAerial = basemap.get(0);
    const openstreetmap = basemap.get(1);
    bingMapsAerial.show = false;
    openstreetmap.show = false;
    $("#underground_1").prop("checked", !$("#ShowBasemap").prop("checked"));
  }
  viewer.scene.globe.depthTestAgainstTerrain = !$("#underground_1").prop("checked");
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !$("#underground_1").prop("checked");
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


// Layering button Siola  ################################################################################
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
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM", $(this).prop("checked"));
});
$("#siolaLegal_BT").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7D40JE8AAFPK0SK06HE", $(this).prop("checked"));
});
$("#siolaLegal_BB").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7CQ6NV0TGV2RNKNM1GX", $(this).prop("checked"));
});

$("#siolaLegal_1a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7P6DEEDQH6QTE0Z68B8", $(this).prop("checked"));
});
$("#siolaLegal_1a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RRR7HCZP94ETRJK757", $(this).prop("checked"));
});
$("#siolaLegal_1a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX", $(this).prop("checked"));
});
$("#siolaLegal_1a4").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7", $(this).prop("checked"));
});
$("#siolaLegal_1a5").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RZXAKK47WMJVV9YSKB", $(this).prop("checked"));
});
$("#siolaLegal_1a6").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PHEQA5SX964M063XQK", $(this).prop("checked"));
});
$("#siolaLegal_1a7").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QNNM61J5YDVQQ23TB2", $(this).prop("checked"));
});
$("#siolaLegal_1a8").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7R5TWKKPSEM6Q95T28R", $(this).prop("checked"));
});
$("#siolaLegal_1a9").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QX80R8CH3JDZ097JX3", $(this).prop("checked"));
});
$("#siolaLegal_1a10").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK", $(this).prop("checked"));
});

$("#siolaLegal_2a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ", $(this).prop("checked"));
});
$("#siolaLegal_2a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VT5ARB2YC0C7PXKCDY", $(this).prop("checked"));
});
$("#siolaLegal_2a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7TN104KHG9ZEHJVSAX5", $(this).prop("checked"));
});
$("#siolaLegal_2a4").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE", $(this).prop("checked"));
});
$("#siolaLegal_2a5").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7S8KJJGYKK6GDD7BBTN", $(this).prop("checked"));
});
$("#siolaLegal_2a6").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W", $(this).prop("checked"));
});
$("#siolaLegal_2a7").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7V04AZ1NWE2VJ7T6T89", $(this).prop("checked"));
});

$("#siolaLegal_3a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XR27P0H1C69A7TPGZ0", $(this).prop("checked"));
});
$("#siolaLegal_3a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Y68R892D1XNRBV2RPN", $(this).prop("checked"));
});
$("#siolaLegal_3a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WZ79J0N5VRS8HQWJXX", $(this).prop("checked"));
});
$("#siolaLegal_3a4").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7W331GHVRF0QTNJXGRW", $(this).prop("checked"));
});
$("#siolaLegal_3a5").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WCQA085HKSMFMBE8Z0", $(this).prop("checked"));
});
$("#siolaLegal_3a6").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P", $(this).prop("checked"));
});
$("#siolaLegal_3a7").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7X6FYFJW3PN5TQV1DAR", $(this).prop("checked"));
});

$("#siolaLegal_4a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YFWXFTR05G47KJJMJ9", $(this).prop("checked"));
});
$("#siolaLegal_4a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YS0BMJZNXP9YB1MSA2", $(this).prop("checked"));
});
$("#siolaLegal_4a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3", $(this).prop("checked"));
});

$("#siolaLegal_5a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7ZH14YX6V6Y963TEKXQ", $(this).prop("checked"));
});

$("#zoomToSiolaLegal_1all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7P6DEEDQH6QTE0Z68B8",
    "legal_01HM6EM7RRR7HCZP94ETRJK757",
    "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX",
    "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7",
    "legal_01HM6EM7RZXAKK47WMJVV9YSKB",
    "legal_01HM6EM7PHEQA5SX964M063XQK",
    "legal_01HM6EM7QNNM61J5YDVQQ23TB2",
    "legal_01HM6EM7R5TWKKPSEM6Q95T28R",
    "legal_01HM6EM7QX80R8CH3JDZ097JX3",
    "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK"
  ]);
  zoomToLocation(siolaBuildingL1, -5, 90, 150);
});
$("#zoomToSiolaLegal_2all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ",
    "legal_01HM6EM7VT5ARB2YC0C7PXKCDY",
    "legal_01HM6EM7TN104KHG9ZEHJVSAX5",
    "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE",
    "legal_01HM6EM7S8KJJGYKK6GDD7BBTN",
    "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W",
    "legal_01HM6EM7V04AZ1NWE2VJ7T6T89"
  ]);
  zoomToLocation(siolaBuildingL2, -10, 90, 150);
});
$("#zoomToSiolaLegal_3all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7XR27P0H1C69A7TPGZ0",
    "legal_01HM6EM7Y68R892D1XNRBV2RPN",
    "legal_01HM6EM7WZ79J0N5VRS8HQWJXX",
    "legal_01HM6EM7W331GHVRF0QTNJXGRW",
    "legal_01HM6EM7WCQA085HKSMFMBE8Z0",
    "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P",
    "legal_01HM6EM7X6FYFJW3PN5TQV1DAR"
  ]);
  zoomToLocation(siolaBuildingL3, -15, 90, 150);
});
$("#zoomToSiolaLegal_4all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7YFWXFTR05G47KJJMJ9",
    "legal_01HM6EM7YS0BMJZNXP9YB1MSA2",
    "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3"
  ]);
  zoomToLocation(siolaBuildingL4, -15, 90, 150);
});
$("#zoomToSiolaLegal_5all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7ZH14YX6V6Y963TEKXQ",
  ]);
  zoomToLocation(siolaBuildingL5, -20, 90, 150);
});

$("#zoomToSiolaLegal_gsb").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7CQ6NV0TGV2RNKNM1GX", $(this).prop("checked"));
  zoomToLocation(siolaLegalGSB, -20, 90, 150);
});
$("#zoomToSiolaLegal_bt").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM", $(this).prop("checked"));
  zoomToLocation(siolaLegalBT, -20, 90, 150);
});
$("#zoomToSiolaLegal_bb").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7D40JE8AAFPK0SK06HE", $(this).prop("checked"));
  zoomToLocation(siolaLegalBB, 15, 90, 150);
});

$("#zoomToSiolaLegal_1a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7P6DEEDQH6QTE0Z68B8");
  zoomToLocation(siolaLegalL1a1, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7RRR7HCZP94ETRJK757");
  zoomToLocation(siolaLegalL1a2, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX");
  zoomToLocation(siolaLegalL1a3, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a4").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7");
  zoomToLocation(siolaLegalL1a4, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a5").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7RZXAKK47WMJVV9YSKB");
  zoomToLocation(siolaLegal, -10, 160, 100);
});
$("#zoomToSiolaLegal_1a6").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7PHEQA5SX964M063XQK");
  zoomToLocation(siolaLegalL1a6, -10, 140, 100);
});
$("#zoomToSiolaLegal_1a7").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7QNNM61J5YDVQQ23TB2");
  zoomToLocation(siolaLegalL1a7, -10, 150, 100);
});
$("#zoomToSiolaLegal_1a8").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7R5TWKKPSEM6Q95T28R");
  zoomToLocation(siolaLegalL1a8, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a9").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7QX80R8CH3JDZ097JX3");
  zoomToLocation(siolaLegalL1a9, -10, 90, 100);
});
$("#zoomToSiolaLegal_1a10").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK");
  zoomToLocation(siolaLegalL1a10, -10, 0, 100);
});

$("#zoomToSiolaLegal_2a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ");
  zoomToLocation(siolaLegalL2a1, -15, 80, 100);
});
$("#zoomToSiolaLegal_2a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7VT5ARB2YC0C7PXKCDY");
  zoomToLocation(siolaLegalL2a2, -15, 100, 100);
});
$("#zoomToSiolaLegal_2a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7TN104KHG9ZEHJVSAX5");
  zoomToLocation(siolaLegalL2a3, -15, 90, 100);
});
$("#zoomToSiolaLegal_2a4").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE");
  zoomToLocation(siolaLegalL2a4, -15, 10, 100);
});
$("#zoomToSiolaLegal_2a5").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7S8KJJGYKK6GDD7BBTN");
  zoomToLocation(siolaLegalL2a5, -15, 140, 100);
});
$("#zoomToSiolaLegal_2a6").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W");
  zoomToLocation(siolaLegalL2a6, -15, 90, 100);
});
$("#zoomToSiolaLegal_2a7").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7V04AZ1NWE2VJ7T6T89");
  zoomToLocation(siolaLegalL2a7, -15, -30, 100);
});

$("#zoomToSiolaLegal_3a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7XR27P0H1C69A7TPGZ0");
  zoomToLocation(siolaLegalL3a1, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7Y68R892D1XNRBV2RPN");
  zoomToLocation(siolaLegalL3a2, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7WZ79J0N5VRS8HQWJXX");
  zoomToLocation(siolaLegalL3a3, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a4").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7W331GHVRF0QTNJXGRW");
  zoomToLocation(siolaLegalL3a4, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a5").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7WCQA085HKSMFMBE8Z0");
  zoomToLocation(siolaLegalL3a5, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a6").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P");
  zoomToLocation(siolaLegalL3a6, -20, 90, 100);
});
$("#zoomToSiolaLegal_3a7").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7X6FYFJW3PN5TQV1DAR");
  zoomToLocation(siolaLegalL3a7, -20, 90, 100);
});

$("#zoomToSiolaLegal_4a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7YFWXFTR05G47KJJMJ9");
  zoomToLocation(siolaLegalL4a1, -25, 80, 100);
});
$("#zoomToSiolaLegal_4a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7YS0BMJZNXP9YB1MSA2");
  zoomToLocation(siolaLegalL4a2, -25, -10, 100);
});
$("#zoomToSiolaLegal_4a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3");
  zoomToLocation(siolaLegalL4a3, -25, 150, 100);
});

$("#zoomToSiolaLegal_5a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7ZH14YX6V6Y963TEKXQ");
  zoomToLocation(siolaLegalL5a1, -25, 90, 100);
});


// Layering button Balai pemuda   #########################################################################
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

// Layering button Rusunawa   #############################################################################
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

$("#rusunawaLegal_GSB").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW920GYWHNG3MC1SR7VE4", $(this).prop("checked"));
});
$("#rusunawaLegal_BB").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW91SR64FJ7F0YVCJK4GS", $(this).prop("checked"));
});
$("#rusunawaLegal_BT").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW7TPS55AHCPWVXSGEPQE", $(this).prop("checked"));
});

$("#rusunawaLegal_1a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW996G1Z61WBQY1XP3QAK", $(this).prop("checked"));
});
$("#rusunawaLegal_1a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AC1QPP7KW6J343B848", $(this).prop("checked"));
});
$("#rusunawaLegal_1a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2", $(this).prop("checked"));
});
$("#rusunawaLegal_1a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CP9GS5QSGGTTV7GMC2", $(this).prop("checked"));
});
$("#rusunawaLegal_1a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CDDCR0RAMWWSX1KHMN", $(this).prop("checked"));
});
$("#rusunawaLegal_1a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CV1M82CGYX5SPVBSFA", $(this).prop("checked"));
});
$("#rusunawaLegal_1a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DBK9J1MN5WFHB9B16J", $(this).prop("checked"));
});
$("#rusunawaLegal_1a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9D52TK6QTBQC832RBNQ", $(this).prop("checked"));
});
$("#rusunawaLegal_1a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DGEFA023Q9HD9WY5EB", $(this).prop("checked"));
});
$("#rusunawaLegal_1a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BS01J71V6KXND1BV4T", $(this).prop("checked"));
});
$("#rusunawaLegal_1a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C3DV3KDRH8EHRK9FVF", $(this).prop("checked"));
});
$("#rusunawaLegal_1a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D", $(this).prop("checked"));
});
$("#rusunawaLegal_1a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BBR6W6WTB8ZP65B2WW", $(this).prop("checked"));
});
$("#rusunawaLegal_1a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B610G13NHKJT44S509", $(this).prop("checked"));
});
$("#rusunawaLegal_1a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B1JJFM7H4E8MZDSDDS", $(this).prop("checked"));
});
$("#rusunawaLegal_1a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AS7JFA6MMEHMX0MWS1", $(this).prop("checked"));
});
$("#rusunawaLegal_1a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AK2ADTV3A79B2A6ZWX", $(this).prop("checked"));
});
$("#rusunawaLegal_1a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89", $(this).prop("checked"));
});
$("#rusunawaLegal_1a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A41HNVDGF7VT7QWE8F", $(this).prop("checked"));
});
$("#rusunawaLegal_1a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C8FC97YYPFMHZSJJCG", $(this).prop("checked"));
});
$("#rusunawaLegal_1a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BXA4XSZ8029S3J260F", $(this).prop("checked"));
});

$("#rusunawaLegal_2a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DTF7VED1JMZYE5GSYE", $(this).prop("checked"));
});
$("#rusunawaLegal_2a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y", $(this).prop("checked"));
});
$("#rusunawaLegal_2a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GRAHX1RCKBGNEM3B2T", $(this).prop("checked"));
});
$("#rusunawaLegal_2a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J91BB3TS79QJ3FYNH6", $(this).prop("checked"));
});
$("#rusunawaLegal_2a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J20S66D2T0VVCKKAX5", $(this).prop("checked"));
});
$("#rusunawaLegal_2a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HVS15HHSSCTJE5QP3S", $(this).prop("checked"));
});
$("#rusunawaLegal_2a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HPCF5JN81YKW88P57J", $(this).prop("checked"));
});
$("#rusunawaLegal_2a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HJAXG353YRWQK707TW", $(this).prop("checked"));
});
$("#rusunawaLegal_2a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HEGVC91YVDTMN82QFB", $(this).prop("checked"));
});
$("#rusunawaLegal_2a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H9S0NZ0S40Y38NWWN2", $(this).prop("checked"));
});
$("#rusunawaLegal_2a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H293QC7RP34NHPNX1A", $(this).prop("checked"));
});
$("#rusunawaLegal_2a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GK7RQPJPPD6ZTG34HP", $(this).prop("checked"));
});
$("#rusunawaLegal_2a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GX4SPW03PXM9F35HTE", $(this).prop("checked"));
});
$("#rusunawaLegal_2a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E61D378B64K62B28EK", $(this).prop("checked"));
});
$("#rusunawaLegal_2a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EE5WASSX5XJV38AZ6H", $(this).prop("checked"));
});
$("#rusunawaLegal_2a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K", $(this).prop("checked"));
});
$("#rusunawaLegal_2a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G76Z0JMNVH6KTTAPK7", $(this).prop("checked"));
});
$("#rusunawaLegal_2a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG", $(this).prop("checked"));
});
$("#rusunawaLegal_2a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FSYXR41VAA2452CAR4", $(this).prop("checked"));
});
$("#rusunawaLegal_2a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FK4DYRSKVNV6BB7B2A", $(this).prop("checked"));
});
$("#rusunawaLegal_2a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FFCKQA7V1Z45X8JTCS", $(this).prop("checked"));
});
$("#rusunawaLegal_2a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FA312J5704SNJ6PYJ3", $(this).prop("checked"));
});
$("#rusunawaLegal_2a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS", $(this).prop("checked"));
});
$("#rusunawaLegal_2a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EZ18RKZYJKHS2Z53R7", $(this).prop("checked"));
});
$("#rusunawaLegal_2a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ET2QPK43G2QTXRE4HC", $(this).prop("checked"));
});
$("#rusunawaLegal_2a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EN8FQ0XDK68F1VXMN1", $(this).prop("checked"));
});
$("#rusunawaLegal_2a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E0KJESXY4H2BNBE7VM", $(this).prop("checked"));
});

$("#rusunawaLegal_3a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MVW5ZGH9QXR49J570K", $(this).prop("checked"));
});
$("#rusunawaLegal_3a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q07D1QQW0A81T6A3W9", $(this).prop("checked"));
});
$("#rusunawaLegal_3a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0", $(this).prop("checked"));
});
$("#rusunawaLegal_3a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ", $(this).prop("checked"));
});
$("#rusunawaLegal_3a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PN986VDPJXJC6EK9JV", $(this).prop("checked"));
});
$("#rusunawaLegal_3a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PGYR5T30KRSHCPZWAK", $(this).prop("checked"));
});
$("#rusunawaLegal_3a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P93F9RHT1J5NZXSYFN", $(this).prop("checked"));
});
$("#rusunawaLegal_3a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P3N98X9TX7VNRBJ15X", $(this).prop("checked"));
});
$("#rusunawaLegal_3a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NZDR7PV98W970T5PRX", $(this).prop("checked"));
});
$("#rusunawaLegal_3a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NSC24K5FPDZEP7XG25", $(this).prop("checked"));
});
$("#rusunawaLegal_3a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NKCN16ZY3MV0T9GWF4", $(this).prop("checked"));
});
$("#rusunawaLegal_3a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N4PHV678XHXKETX2EH", $(this).prop("checked"));
});
$("#rusunawaLegal_3a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NFBP8DPD8X5P03E3TW", $(this).prop("checked"));
});
$("#rusunawaLegal_3a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QBPGW27WGDG51XKR3X", $(this).prop("checked"));
});
$("#rusunawaLegal_3a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM", $(this).prop("checked"));
});
$("#rusunawaLegal_3a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MJRB0A8TY333RE1QFZ", $(this).prop("checked"));
});
$("#rusunawaLegal_3a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ME30WEZRRXDPQA190J", $(this).prop("checked"));
});
$("#rusunawaLegal_3a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M70652KB4774BW89EC", $(this).prop("checked"));
});
$("#rusunawaLegal_3a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M100TA6VY3FM35D5R6", $(this).prop("checked"));
});
$("#rusunawaLegal_3a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KXFWG38WNR24HWCPJK", $(this).prop("checked"));
});
$("#rusunawaLegal_3a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KQ954KPSACVC6D6CE0", $(this).prop("checked"));
});
$("#rusunawaLegal_3a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KKDNMQZ8FRB96RCHCC", $(this).prop("checked"));
});
$("#rusunawaLegal_3a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y", $(this).prop("checked"));
});
$("#rusunawaLegal_3a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K91WCB1AD66JYY3FFS", $(this).prop("checked"));
});
$("#rusunawaLegal_3a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K28V03M20MSEPV7QCD", $(this).prop("checked"));
});
$("#rusunawaLegal_3a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JXP8418XRP007M283B", $(this).prop("checked"));
});
$("#rusunawaLegal_3a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q6K2F6KR3AENXDFWWF", $(this).prop("checked"));
});

$("#rusunawaLegal_4a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9T0W8VBTZ25HCXBGQPS", $(this).prop("checked"));
});
$("#rusunawaLegal_4a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WAGXHBWAAK6QNDA2MH", $(this).prop("checked"));
});
$("#rusunawaLegal_4a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TH737NRNVP2WJJP0S0", $(this).prop("checked"));
});
$("#rusunawaLegal_4a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W5J48VXG0AXKHV30D6", $(this).prop("checked"));
});
$("#rusunawaLegal_4a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W0HX6WBFYMVC7JQ802", $(this).prop("checked"));
});
$("#rusunawaLegal_4a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VVFNDWX99Q10DNPRC5", $(this).prop("checked"));
});
$("#rusunawaLegal_4a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VNV42MDP0DJXTDQQ31", $(this).prop("checked"));
});
$("#rusunawaLegal_4a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VDYT36E93WPXKN0V21", $(this).prop("checked"));
});
$("#rusunawaLegal_4a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN", $(this).prop("checked"));
});
$("#rusunawaLegal_4a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V2DJBF05DRHF42171K", $(this).prop("checked"));
});
$("#rusunawaLegal_4a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TYY1DHDJ12T9WGP98K", $(this).prop("checked"));
});
$("#rusunawaLegal_4a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TBRKRKG84NZMK8XSDY", $(this).prop("checked"));
});
$("#rusunawaLegal_4a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TSRMXJBXXC8FPW0MP0", $(this).prop("checked"));
});
$("#rusunawaLegal_4a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QPWE75DMGH3ZRP2ED4", $(this).prop("checked"));
});
$("#rusunawaLegal_4a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QYSC6XF9HPFBW17TCJ", $(this).prop("checked"));
});
$("#rusunawaLegal_4a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ", $(this).prop("checked"));
});
$("#rusunawaLegal_4a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SJ874QGQMERHQX4R8D", $(this).prop("checked"));
});
$("#rusunawaLegal_4a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ", $(this).prop("checked"));
});
$("#rusunawaLegal_4a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S743XNK211CH82N31G", $(this).prop("checked"));
});
$("#rusunawaLegal_4a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S3D2FG186H849WPBD0", $(this).prop("checked"));
});
$("#rusunawaLegal_4a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RY7Z9V7C40F0XBR2M4", $(this).prop("checked"));
});
$("#rusunawaLegal_4a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM", $(this).prop("checked"));
});
$("#rusunawaLegal_4a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RK19R68AXV9YP9HTY8", $(this).prop("checked"));
});
$("#rusunawaLegal_4a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RBT4M3NX3YH6EMW2E1", $(this).prop("checked"));
});
$("#rusunawaLegal_4a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R7M4KK7A45YWR1FAG8", $(this).prop("checked"));
});
$("#rusunawaLegal_4a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R3NP14ARFTQNV13BEW", $(this).prop("checked"));
});
$("#rusunawaLegal_4a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV", $(this).prop("checked"));
});

$("#rusunawaLegal_5a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Z2GR1BZENX99V8SD6F", $(this).prop("checked"));
});
$("#rusunawaLegal_5a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK", $(this).prop("checked"));
});
$("#rusunawaLegal_5a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZK0V03298BB5X130WY", $(this).prop("checked"));
});
$("#rusunawaLegal_5a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA16RNAX53BA0R1PTXJ6", $(this).prop("checked"));
});
$("#rusunawaLegal_5a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA12ZB7TYZJNHAHPY7WW", $(this).prop("checked"));
});
$("#rusunawaLegal_5a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0XYNJRXAY0B63N5BBV", $(this).prop("checked"));
});
$("#rusunawaLegal_5a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0NGNZCR80RNDCXMH5M", $(this).prop("checked"));
});
$("#rusunawaLegal_5a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0G6XMNZHKP9KN1BBT4", $(this).prop("checked"));
});
$("#rusunawaLegal_5a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0B8MQSKPHR04CJKNP4", $(this).prop("checked"));
});
$("#rusunawaLegal_5a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA05B4C592FR7Z3CRX8B", $(this).prop("checked"));
});
$("#rusunawaLegal_5a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D", $(this).prop("checked"));
});
$("#rusunawaLegal_5a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZDPFQYCG9Y6K9F771W", $(this).prop("checked"));
});
$("#rusunawaLegal_5a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZSR8817RCJG52R8WDP", $(this).prop("checked"));
});
$("#rusunawaLegal_5a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WPJPS0THQYCNXRXP6D", $(this).prop("checked"));
});
$("#rusunawaLegal_5a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WZRP309VTB8P8YQKBQ", $(this).prop("checked"));
});
$("#rusunawaLegal_5a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YT7MKD01KC38EX2WQP", $(this).prop("checked"));
});
$("#rusunawaLegal_5a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y", $(this).prop("checked"));
});
$("#rusunawaLegal_5a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YD78PQ60W3B1P7C3J7", $(this).prop("checked"));
});
$("#rusunawaLegal_5a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y9G9K73HXMFXZS05BK", $(this).prop("checked"));
});
$("#rusunawaLegal_5a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH", $(this).prop("checked"));
});
$("#rusunawaLegal_5a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XZFE0FB81H22C1BJC5", $(this).prop("checked"));
});
$("#rusunawaLegal_5a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XVME2NBE8PHXHX9Q2J", $(this).prop("checked"));
});
$("#rusunawaLegal_5a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XMAR7XJ0CG8P17GTAS", $(this).prop("checked"));
});
$("#rusunawaLegal_5a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW", $(this).prop("checked"));
});
$("#rusunawaLegal_5a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M", $(this).prop("checked"));
});
$("#rusunawaLegal_5a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9X4WWVMEB76J2P1XP7D", $(this).prop("checked"));
});
$("#rusunawaLegal_5a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2", $(this).prop("checked"));
});



$("#zoomToRusunawaLegal_1all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW996G1Z61WBQY1XP3QAK",
    "legal_01HM6EW9AC1QPP7KW6J343B848",
    "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2",
    "legal_01HM6EW9CP9GS5QSGGTTV7GMC2",
    "legal_01HM6EW9CDDCR0RAMWWSX1KHMN",
    "legal_01HM6EW9CV1M82CGYX5SPVBSFA",
    "legal_01HM6EW9DBK9J1MN5WFHB9B16J",
    "legal_01HM6EW9D52TK6QTBQC832RBNQ",
    "legal_01HM6EW9DGEFA023Q9HD9WY5EB",
    "legal_01HM6EW9BS01J71V6KXND1BV4T",
    "legal_01HM6EW9C3DV3KDRH8EHRK9FVF",
    "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D",
    "legal_01HM6EW9BBR6W6WTB8ZP65B2WW",
    "legal_01HM6EW9B610G13NHKJT44S509",
    "legal_01HM6EW9B1JJFM7H4E8MZDSDDS",
    "legal_01HM6EW9AS7JFA6MMEHMX0MWS1",
    "legal_01HM6EW9AK2ADTV3A79B2A6ZWX",
    "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89",
    "legal_01HM6EW9A41HNVDGF7VT7QWE8F",
    "legal_01HM6EW9C8FC97YYPFMHZSJJCG",
    "legal_01HM6EW9BXA4XSZ8029S3J260F",
  ]);
  zoomToLocation(rusunawaBuildingL1, -25, 180, 100);
});
$("#zoomToRusunawaLegal_2all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9DTF7VED1JMZYE5GSYE",
    "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y",
    "legal_01HM6EW9GRAHX1RCKBGNEM3B2T",
    "legal_01HM6EW9J91BB3TS79QJ3FYNH6",
    "legal_01HM6EW9J20S66D2T0VVCKKAX5",
    "legal_01HM6EW9HVS15HHSSCTJE5QP3S",
    "legal_01HM6EW9HPCF5JN81YKW88P57J",
    "legal_01HM6EW9HJAXG353YRWQK707TW",
    "legal_01HM6EW9HEGVC91YVDTMN82QFB",
    "legal_01HM6EW9H9S0NZ0S40Y38NWWN2",
    "legal_01HM6EW9H293QC7RP34NHPNX1A",
    "legal_01HM6EW9GK7RQPJPPD6ZTG34HP",
    "legal_01HM6EW9GX4SPW03PXM9F35HTE",
    "legal_01HM6EW9E61D378B64K62B28EK",
    "legal_01HM6EW9EE5WASSX5XJV38AZ6H",
    "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K",
    "legal_01HM6EW9G76Z0JMNVH6KTTAPK7",
    "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG",
    "legal_01HM6EW9FSYXR41VAA2452CAR4",
    "legal_01HM6EW9FK4DYRSKVNV6BB7B2A",
    "legal_01HM6EW9FFCKQA7V1Z45X8JTCS",
    "legal_01HM6EW9FA312J5704SNJ6PYJ3",
    "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS",
    "legal_01HM6EW9EZ18RKZYJKHS2Z53R7",
    "legal_01HM6EW9ET2QPK43G2QTXRE4HC",
    "legal_01HM6EW9EN8FQ0XDK68F1VXMN1",
    "legal_01HM6EW9E0KJESXY4H2BNBE7VM",
  ]);
  zoomToLocation(rusunawaBuildingL2, -25, 180, 100);
});
$("#zoomToRusunawaLegal_3all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9MVW5ZGH9QXR49J570K",
    "legal_01HM6EW9Q07D1QQW0A81T6A3W9",
    "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0",
    "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ",
    "legal_01HM6EW9PN986VDPJXJC6EK9JV",
    "legal_01HM6EW9PGYR5T30KRSHCPZWAK",
    "legal_01HM6EW9P93F9RHT1J5NZXSYFN",
    "legal_01HM6EW9P3N98X9TX7VNRBJ15X",
    "legal_01HM6EW9NZDR7PV98W970T5PRX",
    "legal_01HM6EW9NSC24K5FPDZEP7XG25",
    "legal_01HM6EW9NKCN16ZY3MV0T9GWF4",
    "legal_01HM6EW9N4PHV678XHXKETX2EH",
    "legal_01HM6EW9NFBP8DPD8X5P03E3TW",
    "legal_01HM6EW9QBPGW27WGDG51XKR3X",
    "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM",
    "legal_01HM6EW9MJRB0A8TY333RE1QFZ",
    "legal_01HM6EW9ME30WEZRRXDPQA190J",
    "legal_01HM6EW9M70652KB4774BW89EC",
    "legal_01HM6EW9M100TA6VY3FM35D5R6",
    "legal_01HM6EW9KXFWG38WNR24HWCPJK",
    "legal_01HM6EW9KQ954KPSACVC6D6CE0",
    "legal_01HM6EW9KKDNMQZ8FRB96RCHCC",
    "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y",
    "legal_01HM6EW9K91WCB1AD66JYY3FFS",
    "legal_01HM6EW9K28V03M20MSEPV7QCD",
    "legal_01HM6EW9JXP8418XRP007M283B",
    "legal_01HM6EW9Q6K2F6KR3AENXDFWWF",
  ]);
  zoomToLocation(rusunawaBuildingL3, -25, 180, 100);
});
$("#zoomToRusunawaLegal_4all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9T0W8VBTZ25HCXBGQPS",
    "legal_01HM6EW9WAGXHBWAAK6QNDA2MH",
    "legal_01HM6EW9TH737NRNVP2WJJP0S0",
    "legal_01HM6EW9W5J48VXG0AXKHV30D6",
    "legal_01HM6EW9W0HX6WBFYMVC7JQ802",
    "legal_01HM6EW9VVFNDWX99Q10DNPRC5",
    "legal_01HM6EW9VNV42MDP0DJXTDQQ31",
    "legal_01HM6EW9VDYT36E93WPXKN0V21",
    "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN",
    "legal_01HM6EW9V2DJBF05DRHF42171K",
    "legal_01HM6EW9TYY1DHDJ12T9WGP98K",
    "legal_01HM6EW9TBRKRKG84NZMK8XSDY",
    "legal_01HM6EW9TSRMXJBXXC8FPW0MP0",
    "legal_01HM6EW9QPWE75DMGH3ZRP2ED4",
    "legal_01HM6EW9QYSC6XF9HPFBW17TCJ",
    "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ",
    "legal_01HM6EW9SJ874QGQMERHQX4R8D",
    "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ",
    "legal_01HM6EW9S743XNK211CH82N31G",
    "legal_01HM6EW9S3D2FG186H849WPBD0",
    "legal_01HM6EW9RY7Z9V7C40F0XBR2M4",
    "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM",
    "legal_01HM6EW9RK19R68AXV9YP9HTY8",
    "legal_01HM6EW9RBT4M3NX3YH6EMW2E1",
    "legal_01HM6EW9R7M4KK7A45YWR1FAG8",
    "legal_01HM6EW9R3NP14ARFTQNV13BEW",
    "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV",
  ]);
  zoomToLocation(rusunawaBuildingL4, -25, 180, 100);
});
$("#zoomToRusunawaLegal_5all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9Z2GR1BZENX99V8SD6F",
    "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK",
    "legal_01HM6EW9ZK0V03298BB5X130WY",
    "legal_01HM6EWA16RNAX53BA0R1PTXJ6",
    "legal_01HM6EWA12ZB7TYZJNHAHPY7WW",
    "legal_01HM6EWA0XYNJRXAY0B63N5BBV",
    "legal_01HM6EWA0NGNZCR80RNDCXMH5M",
    "legal_01HM6EWA0G6XMNZHKP9KN1BBT4",
    "legal_01HM6EWA0B8MQSKPHR04CJKNP4",
    "legal_01HM6EWA05B4C592FR7Z3CRX8B",
    "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D",
    "legal_01HM6EW9ZDPFQYCG9Y6K9F771W",
    "legal_01HM6EW9ZSR8817RCJG52R8WDP",
    "legal_01HM6EW9WPJPS0THQYCNXRXP6D",
    "legal_01HM6EW9WZRP309VTB8P8YQKBQ",
    "legal_01HM6EW9YT7MKD01KC38EX2WQP",
    "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y",
    "legal_01HM6EW9YD78PQ60W3B1P7C3J7",
    "legal_01HM6EW9Y9G9K73HXMFXZS05BK",
    "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH",
    "legal_01HM6EW9XZFE0FB81H22C1BJC5",
    "legal_01HM6EW9XVME2NBE8PHXHX9Q2J",
    "legal_01HM6EW9XMAR7XJ0CG8P17GTAS",
    "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW",
    "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M",
    "legal_01HM6EW9X4WWVMEB76J2P1XP7D",
    "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2",
  ]);
  zoomToLocation(rusunawaBuildingL5, -25, 180, 100);
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
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW996G1Z61WBQY1XP3QAK");
  zoomToLocation(rusunawaLegalL1a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_1a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9AC1QPP7KW6J343B848");
});
$("#zoomToRusunawaLegal_1a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2");
});
$("#zoomToRusunawaLegal_1a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CP9GS5QSGGTTV7GMC2");
});
$("#zoomToRusunawaLegal_1a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CDDCR0RAMWWSX1KHMN");
});
$("#zoomToRusunawaLegal_1a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CV1M82CGYX5SPVBSFA");
});
$("#zoomToRusunawaLegal_1a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9DBK9J1MN5WFHB9B16J");
});
$("#zoomToRusunawaLegal_1a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9D52TK6QTBQC832RBNQ");
});
$("#zoomToRusunawaLegal_1a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9DGEFA023Q9HD9WY5EB");
});
$("#zoomToRusunawaLegal_1a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BS01J71V6KXND1BV4T");
});
$("#zoomToRusunawaLegal_1a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9C3DV3KDRH8EHRK9FVF");
});
$("#zoomToRusunawaLegal_1a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D");
});
$("#zoomToRusunawaLegal_1a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BBR6W6WTB8ZP65B2WW");
});
$("#zoomToRusunawaLegal_1a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9B610G13NHKJT44S509");
});
$("#zoomToRusunawaLegal_1a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9B1JJFM7H4E8MZDSDDS");
});
$("#zoomToRusunawaLegal_1a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9AS7JFA6MMEHMX0MWS1");
});
$("#zoomToRusunawaLegal_1a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9AK2ADTV3A79B2A6ZWX");
});
$("#zoomToRusunawaLegal_1a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89");
});
$("#zoomToRusunawaLegal_1a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9A41HNVDGF7VT7QWE8F");
});
$("#zoomToRusunawaLegal_1a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9C8FC97YYPFMHZSJJCG");
});
$("#zoomToRusunawaLegal_1a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BXA4XSZ8029S3J260F");
});

$("#zoomToRusunawaLegal_2a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9DTF7VED1JMZYE5GSYE");
  zoomToLocation(rusunawaLegalL2a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_2a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y");
});
$("#zoomToRusunawaLegal_2a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GRAHX1RCKBGNEM3B2T");
});
$("#zoomToRusunawaLegal_2a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9J91BB3TS79QJ3FYNH6");
});
$("#zoomToRusunawaLegal_2a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9J20S66D2T0VVCKKAX5");
});
$("#zoomToRusunawaLegal_2a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HVS15HHSSCTJE5QP3S");
});
$("#zoomToRusunawaLegal_2a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HPCF5JN81YKW88P57J");
});
$("#zoomToRusunawaLegal_2a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HJAXG353YRWQK707TW");
});
$("#zoomToRusunawaLegal_2a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HEGVC91YVDTMN82QFB");
});
$("#zoomToRusunawaLegal_2a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9H9S0NZ0S40Y38NWWN2");
});
$("#zoomToRusunawaLegal_2a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9H293QC7RP34NHPNX1A");
});
$("#zoomToRusunawaLegal_2a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GK7RQPJPPD6ZTG34HP");
});
$("#zoomToRusunawaLegal_2a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GX4SPW03PXM9F35HTE");
});
$("#zoomToRusunawaLegal_2a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9E61D378B64K62B28EK");
});
$("#zoomToRusunawaLegal_2a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9EE5WASSX5XJV38AZ6H");
});
$("#zoomToRusunawaLegal_2a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K");
});
$("#zoomToRusunawaLegal_2a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9G76Z0JMNVH6KTTAPK7");
});
$("#zoomToRusunawaLegal_2a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG");
});
$("#zoomToRusunawaLegal_2a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FSYXR41VAA2452CAR4");
});
$("#zoomToRusunawaLegal_2a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FK4DYRSKVNV6BB7B2A");
});
$("#zoomToRusunawaLegal_2a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FFCKQA7V1Z45X8JTCS");
});
$("#zoomToRusunawaLegal_2a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FA312J5704SNJ6PYJ3");
});
$("#zoomToRusunawaLegal_2a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS");
});
$("#zoomToRusunawaLegal_2a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9EZ18RKZYJKHS2Z53R7");
});
$("#zoomToRusunawaLegal_2a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ET2QPK43G2QTXRE4HC");
});
$("#zoomToRusunawaLegal_2a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9EN8FQ0XDK68F1VXMN1");
});
$("#zoomToRusunawaLegal_2a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9E0KJESXY4H2BNBE7VM");
});

$("#zoomToRusunawaLegal_3a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9MVW5ZGH9QXR49J570K");
  zoomToLocation(rusunawaLegalL3a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_3a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Q07D1QQW0A81T6A3W9");
});
$("#zoomToRusunawaLegal_3a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0");
});
$("#zoomToRusunawaLegal_3a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ");
});
$("#zoomToRusunawaLegal_3a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9PN986VDPJXJC6EK9JV");
});
$("#zoomToRusunawaLegal_3a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9PGYR5T30KRSHCPZWAK");
});
$("#zoomToRusunawaLegal_3a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9P93F9RHT1J5NZXSYFN");
});
$("#zoomToRusunawaLegal_3a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9P3N98X9TX7VNRBJ15X");
});
$("#zoomToRusunawaLegal_3a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NZDR7PV98W970T5PRX");
});
$("#zoomToRusunawaLegal_3a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NSC24K5FPDZEP7XG25");
});
$("#zoomToRusunawaLegal_3a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NKCN16ZY3MV0T9GWF4");
});
$("#zoomToRusunawaLegal_3a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9N4PHV678XHXKETX2EH");
});
$("#zoomToRusunawaLegal_3a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NFBP8DPD8X5P03E3TW");
});
$("#zoomToRusunawaLegal_3a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QBPGW27WGDG51XKR3X");
});
$("#zoomToRusunawaLegal_3a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM");
});
$("#zoomToRusunawaLegal_3a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9MJRB0A8TY333RE1QFZ");
});
$("#zoomToRusunawaLegal_3a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ME30WEZRRXDPQA190J");
});
$("#zoomToRusunawaLegal_3a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9M70652KB4774BW89EC");
});
$("#zoomToRusunawaLegal_3a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9M100TA6VY3FM35D5R6");
});
$("#zoomToRusunawaLegal_3a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KXFWG38WNR24HWCPJK");
});
$("#zoomToRusunawaLegal_3a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KQ954KPSACVC6D6CE0");
});
$("#zoomToRusunawaLegal_3a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KKDNMQZ8FRB96RCHCC");
});
$("#zoomToRusunawaLegal_3a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y");
});
$("#zoomToRusunawaLegal_3a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9K91WCB1AD66JYY3FFS");
});
$("#zoomToRusunawaLegal_3a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9K28V03M20MSEPV7QCD");
});
$("#zoomToRusunawaLegal_3a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9JXP8418XRP007M283B");
});
$("#zoomToRusunawaLegal_3a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Q6K2F6KR3AENXDFWWF");
});

$("#zoomToRusunawaLegal_4a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9T0W8VBTZ25HCXBGQPS");
  zoomToLocation(rusunawaLegalL4a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_4a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WAGXHBWAAK6QNDA2MH");
});
$("#zoomToRusunawaLegal_4a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TH737NRNVP2WJJP0S0");
});
$("#zoomToRusunawaLegal_4a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9W5J48VXG0AXKHV30D6");
});
$("#zoomToRusunawaLegal_4a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9W0HX6WBFYMVC7JQ802");
});
$("#zoomToRusunawaLegal_4a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9VVFNDWX99Q10DNPRC5");
});
$("#zoomToRusunawaLegal_4a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9VNV42MDP0DJXTDQQ31");
});
$("#zoomToRusunawaLegal_4a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9VDYT36E93WPXKN0V21");
});
$("#zoomToRusunawaLegal_4a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN");
});
$("#zoomToRusunawaLegal_4a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9V2DJBF05DRHF42171K");
});
$("#zoomToRusunawaLegal_4a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TYY1DHDJ12T9WGP98K");
});
$("#zoomToRusunawaLegal_4a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TBRKRKG84NZMK8XSDY");
});
$("#zoomToRusunawaLegal_4a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TSRMXJBXXC8FPW0MP0");
});
$("#zoomToRusunawaLegal_4a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QPWE75DMGH3ZRP2ED4");
});
$("#zoomToRusunawaLegal_4a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QYSC6XF9HPFBW17TCJ");
});
$("#zoomToRusunawaLegal_4a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ");
});
$("#zoomToRusunawaLegal_4a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9SJ874QGQMERHQX4R8D");
});
$("#zoomToRusunawaLegal_4a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ");
});
$("#zoomToRusunawaLegal_4a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9S743XNK211CH82N31G");
});
$("#zoomToRusunawaLegal_4a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9S3D2FG186H849WPBD0");
});
$("#zoomToRusunawaLegal_4a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RY7Z9V7C40F0XBR2M4");
});
$("#zoomToRusunawaLegal_4a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM");
});
$("#zoomToRusunawaLegal_4a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RK19R68AXV9YP9HTY8");
});
$("#zoomToRusunawaLegal_4a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RBT4M3NX3YH6EMW2E1");
});
$("#zoomToRusunawaLegal_4a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9R7M4KK7A45YWR1FAG8");
});
$("#zoomToRusunawaLegal_4a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9R3NP14ARFTQNV13BEW");
});
$("#zoomToRusunawaLegal_4a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV");
});

$("#zoomToRusunawaLegal_5a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Z2GR1BZENX99V8SD6F");
  zoomToLocation(rusunawaLegalL5a1, -45, 180, 100);
});
$("#zoomToRusunawaLegal_5a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK");
});
$("#zoomToRusunawaLegal_5a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZK0V03298BB5X130WY");
});
$("#zoomToRusunawaLegal_5a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA16RNAX53BA0R1PTXJ6");
});
$("#zoomToRusunawaLegal_5a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA12ZB7TYZJNHAHPY7WW");
});
$("#zoomToRusunawaLegal_5a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0XYNJRXAY0B63N5BBV");
});
$("#zoomToRusunawaLegal_5a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0NGNZCR80RNDCXMH5M");
});
$("#zoomToRusunawaLegal_5a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0G6XMNZHKP9KN1BBT4");
});
$("#zoomToRusunawaLegal_5a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0B8MQSKPHR04CJKNP4");
});
$("#zoomToRusunawaLegal_5a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA05B4C592FR7Z3CRX8B");
});
$("#zoomToRusunawaLegal_5a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D");
});
$("#zoomToRusunawaLegal_5a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZDPFQYCG9Y6K9F771W");
});
$("#zoomToRusunawaLegal_5a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZSR8817RCJG52R8WDP");
});
$("#zoomToRusunawaLegal_5a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WPJPS0THQYCNXRXP6D");
});
$("#zoomToRusunawaLegal_5a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WZRP309VTB8P8YQKBQ");
});
$("#zoomToRusunawaLegal_5a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9YT7MKD01KC38EX2WQP");
});
$("#zoomToRusunawaLegal_5a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y");
});
$("#zoomToRusunawaLegal_5a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9YD78PQ60W3B1P7C3J7");
});
$("#zoomToRusunawaLegal_5a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Y9G9K73HXMFXZS05BK");
});
$("#zoomToRusunawaLegal_5a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH");
});
$("#zoomToRusunawaLegal_5a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XZFE0FB81H22C1BJC5");
});
$("#zoomToRusunawaLegal_5a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XVME2NBE8PHXHX9Q2J");
});
$("#zoomToRusunawaLegal_5a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XMAR7XJ0CG8P17GTAS");
});
$("#zoomToRusunawaLegal_5a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW");
});
$("#zoomToRusunawaLegal_5a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M");
});
$("#zoomToRusunawaLegal_5a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9X4WWVMEB76J2P1XP7D");
});
$("#zoomToRusunawaLegal_5a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2");
});


//// Layering check/uncheck all ##########################################################################
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
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7P6DEEDQH6QTE0Z68B8", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RRR7HCZP94ETRJK757", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RZXAKK47WMJVV9YSKB", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PHEQA5SX964M063XQK", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QNNM61J5YDVQQ23TB2", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7R5TWKKPSEM6Q95T28R", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QX80R8CH3JDZ097JX3", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK", isChecked);
});
$("#siolaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VT5ARB2YC0C7PXKCDY", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7TN104KHG9ZEHJVSAX5", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7S8KJJGYKK6GDD7BBTN", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7V04AZ1NWE2VJ7T6T89", isChecked);
});
$("#siolaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XR27P0H1C69A7TPGZ0", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Y68R892D1XNRBV2RPN", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WZ79J0N5VRS8HQWJXX", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7W331GHVRF0QTNJXGRW", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WCQA085HKSMFMBE8Z0", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7X6FYFJW3PN5TQV1DAR", isChecked);
});
$("#siolaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YFWXFTR05G47KJJMJ9", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YS0BMJZNXP9YB1MSA2", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3", isChecked);
});
$("#siolaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7ZH14YX6V6Y963TEKXQ", isChecked);
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
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW996G1Z61WBQY1XP3QAK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AC1QPP7KW6J343B848", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CP9GS5QSGGTTV7GMC2", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CDDCR0RAMWWSX1KHMN", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CV1M82CGYX5SPVBSFA", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DBK9J1MN5WFHB9B16J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9D52TK6QTBQC832RBNQ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DGEFA023Q9HD9WY5EB", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BS01J71V6KXND1BV4T", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C3DV3KDRH8EHRK9FVF", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BBR6W6WTB8ZP65B2WW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B610G13NHKJT44S509", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B1JJFM7H4E8MZDSDDS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AS7JFA6MMEHMX0MWS1", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AK2ADTV3A79B2A6ZWX", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A41HNVDGF7VT7QWE8F", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C8FC97YYPFMHZSJJCG", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BXA4XSZ8029S3J260F", isChecked);
});
$("#rusunawaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DTF7VED1JMZYE5GSYE", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GRAHX1RCKBGNEM3B2T", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J91BB3TS79QJ3FYNH6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J20S66D2T0VVCKKAX5", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HVS15HHSSCTJE5QP3S", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HPCF5JN81YKW88P57J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HJAXG353YRWQK707TW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HEGVC91YVDTMN82QFB", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H9S0NZ0S40Y38NWWN2", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H293QC7RP34NHPNX1A", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GK7RQPJPPD6ZTG34HP", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GX4SPW03PXM9F35HTE", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E61D378B64K62B28EK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EE5WASSX5XJV38AZ6H", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G76Z0JMNVH6KTTAPK7", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FSYXR41VAA2452CAR4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FK4DYRSKVNV6BB7B2A", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FFCKQA7V1Z45X8JTCS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FA312J5704SNJ6PYJ3", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EZ18RKZYJKHS2Z53R7", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ET2QPK43G2QTXRE4HC", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EN8FQ0XDK68F1VXMN1", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E0KJESXY4H2BNBE7VM", isChecked);
});
$("#rusunawaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MVW5ZGH9QXR49J570K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q07D1QQW0A81T6A3W9", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PN986VDPJXJC6EK9JV", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PGYR5T30KRSHCPZWAK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P93F9RHT1J5NZXSYFN", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P3N98X9TX7VNRBJ15X", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NZDR7PV98W970T5PRX", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NSC24K5FPDZEP7XG25", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NKCN16ZY3MV0T9GWF4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N4PHV678XHXKETX2EH", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NFBP8DPD8X5P03E3TW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QBPGW27WGDG51XKR3X", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MJRB0A8TY333RE1QFZ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ME30WEZRRXDPQA190J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M70652KB4774BW89EC", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M100TA6VY3FM35D5R6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KXFWG38WNR24HWCPJK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KQ954KPSACVC6D6CE0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KKDNMQZ8FRB96RCHCC", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K91WCB1AD66JYY3FFS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K28V03M20MSEPV7QCD", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JXP8418XRP007M283B", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q6K2F6KR3AENXDFWWF", isChecked);
});
$("#rusunawaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9T0W8VBTZ25HCXBGQPS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WAGXHBWAAK6QNDA2MH", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TH737NRNVP2WJJP0S0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W5J48VXG0AXKHV30D6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W0HX6WBFYMVC7JQ802", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VVFNDWX99Q10DNPRC5", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VNV42MDP0DJXTDQQ31", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VDYT36E93WPXKN0V21", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V2DJBF05DRHF42171K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TYY1DHDJ12T9WGP98K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TBRKRKG84NZMK8XSDY", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TSRMXJBXXC8FPW0MP0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QPWE75DMGH3ZRP2ED4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QYSC6XF9HPFBW17TCJ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SJ874QGQMERHQX4R8D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S743XNK211CH82N31G", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S3D2FG186H849WPBD0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RY7Z9V7C40F0XBR2M4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RK19R68AXV9YP9HTY8", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RBT4M3NX3YH6EMW2E1", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R7M4KK7A45YWR1FAG8", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R3NP14ARFTQNV13BEW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV", isChecked);
});
$("#rusunawaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Z2GR1BZENX99V8SD6F", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZK0V03298BB5X130WY", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA16RNAX53BA0R1PTXJ6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA12ZB7TYZJNHAHPY7WW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0XYNJRXAY0B63N5BBV", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0NGNZCR80RNDCXMH5M", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0G6XMNZHKP9KN1BBT4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0B8MQSKPHR04CJKNP4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA05B4C592FR7Z3CRX8B", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZDPFQYCG9Y6K9F771W", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZSR8817RCJG52R8WDP", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WPJPS0THQYCNXRXP6D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WZRP309VTB8P8YQKBQ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YT7MKD01KC38EX2WQP", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YD78PQ60W3B1P7C3J7", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y9G9K73HXMFXZS05BK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XZFE0FB81H22C1BJC5", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XVME2NBE8PHXHX9Q2J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XMAR7XJ0CG8P17GTAS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9X4WWVMEB76J2P1XP7D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2", isChecked);
});

// set style tileset [gml]
const colorMap = {
  "Anotha Blue": new Cesium.Color(0 / 255, 0 / 255, 255 / 255, 1.0), // Anotha Blue
  "Baby Blue": new Cesium.Color(173 / 255, 216 / 255, 230 / 255, 1.0), // Baby Blue
  "Blue": new Cesium.Color(0.0, 0.0, 1.0, 1.0), // Blue
  "Brown": new Cesium.Color(165 / 255, 42 / 255, 42 / 255, 1.0), // Brown
  "Coral": new Cesium.Color(255 / 255, 127 / 255, 80 / 255, 1.0), // Coral
  "Green": new Cesium.Color(0.0, 1.0, 0.0, 1.0), // Green
  "Grey": new Cesium.Color(128 / 255, 128 / 255, 128 / 255, 1.0), // Grey
  "Lumut": new Cesium.Color(25, 133, 54, 1.0),
  "Light Blue": new Cesium.Color(173 / 255, 216 / 255, 230 / 255, 1.0), // Light Blue
  "Maroon": new Cesium.Color(128 / 255, 0 / 255, 0 / 255, 1.0), // Maroon
  "Merah": new Cesium.Color(1.0, 0.0, 0.0, 1.0), // Merah
  "Navy": new Cesium.Color(0 / 255, 0 / 255, 128 / 255, 1.0), // Navy
  "Neon Green": new Cesium.Color(57 / 255, 255 / 255, 20 / 255, 1.0), // Neon Green
  "Orange": new Cesium.Color(255 / 255, 165 / 255, 0 / 255, 1.0), // Orange
  "Pink": new Cesium.Color(255 / 255, 192 / 255, 203 / 255, 1.0), // Pink
  "Purple": new Cesium.Color(128 / 255, 0 / 255, 128 / 255, 1.0), // Purple
  "Red": new Cesium.Color(1.0, 0.0, 0.0, 1.0), // Red
  "Red Pastel": new Cesium.Color(255 / 255, 105 / 255, 97 / 255, 1.0), // Red Pastel
  "Sienna": new Cesium.Color(160 / 255, 82 / 255, 45 / 255, 1.0), // Sienna
  "Violet": new Cesium.Color(238 / 255, 130 / 255, 238 / 255, 1.0), // Violet
  "Yellow": new Cesium.Color(1.0, 1.0, 0.0, 1.0), // Yellow
};

function getColorFromProperty(inputProperties) {
  const splitString = inputProperties.split('-').map(function (item) {
    return item.trim();
  });
  return splitString[1];
}

// Define a color style
let setColorStyle = new Cesium.Cesium3DTileStyle({
  color: {
    evaluateColor: function (feature, result) {
      // Ambil nilai "_paint" dari properti fitur
      const styleName = getColorFromProperty(feature.getProperty("fme_appearance_style_name"));
      // Jika "legal_type" adalah "legal_space", atur transparansi menjadi 0.4
      if (feature.getProperty("legal_type") === "legal_space") {
        return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.4);
      }
      // Temukan warna yang sesuai dari colormap atau gunakan warna default jika tidak ditemukan
      const color = colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0); // Default: Grey
      // Kembalikan warna hasil evaluasi
      return Cesium.Color.clone(color, result);
    },
  },
});

let MappingHideTileset = [];
let MappingTransparentTileset = [];

function mappingHide(legal_id, isChecked) {
  if (isChecked) {
    MappingHideTileset = MappingHideTileset.filter(data => data !== legal_id);
  } else {
    if (!undefined) {
      MappingHideTileset.push(legal_id);
    }
    return
  }
  console.log("hide");
  console.log(MappingHideTileset);
}

function setVisibilityBylegal_id(tileset, legal_id, isChecked) {
  mappingHide(legal_id, isChecked);
  tileset.style = new Cesium.Cesium3DTileStyle({
    show: {
      evaluate: function (feature) {
        return !MappingHideTileset.includes(feature.getProperty("legal_id"));
      },
    },
    color: {
      evaluateColor: function (feature, result) {
        // Ambil nilai "_paint" dari properti fitur
        const styleName = getColorFromProperty(feature.getProperty("fme_appearance_style_name"));
        // Jika "legal_type" adalah "legal_space", atur transparansi menjadi 0.4
        if (feature.getProperty("legal_type") === "legal_space") {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.4);
        }
        // MappingTransparentTileset
        if (MappingTransparentTileset.includes(feature.getProperty("legal_id"))) {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 1.0);
        } else {
          if (MappingTransparentTileset.length > 0) {
            return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.2);
          }
        }
        // Temukan warna yang sesuai dari colormap atau gunakan warna default jika tidak ditemukan
        const color = colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0); // Default: Grey
        // Kembalikan warna hasil evaluasi
        return Cesium.Color.clone(color, result);
      },
    },
  });
}
// setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM");

function mappingTransparent(legal_id) {
  if (Array.isArray(legal_id)) {
    MappingTransparentTileset = legal_id
  } else {
    MappingTransparentTileset.push(legal_id);
  }
  console.log("transparent");
  console.log(MappingTransparentTileset);
}

function setTransparentBylegal_id(tileset, legal_id) {
  MappingTransparentTileset = [];
  mappingTransparent(legal_id);
  tileset.style = new Cesium.Cesium3DTileStyle({
    color: {
      evaluateColor: function (feature, result) {
        // Ambil nilai "_paint" dari properti fitur
        const styleName = getColorFromProperty(feature.getProperty("fme_appearance_style_name"));
        // Jika "legal_type" adalah "legal_space", atur transparansi menjadi 0.4
        if (feature.getProperty("legal_type") === "legal_space") {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.4);
        }
        // MappingTransparentTileset
        if (MappingTransparentTileset.includes(feature.getProperty("legal_id"))) {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 1.0);
        } else {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.2);
        }
      },
    },
    show: {
      evaluate: function (feature) {
        return !MappingHideTileset.includes(feature.getProperty("legal_id"));
      },
    },
  });
}
// setTransparentBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM");
// setTransparentBylegal_id(siolaLegal, ["legal_01HM6EM7YFWXFTR05G47KJJMJ9", "legal_01HM6EM7YS0BMJZNXP9YB1MSA2", "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3"]);

// reset Transparency
function resetTransparent(tileset) {
  MappingTransparentTileset = [];
  setVisibilityBylegal_id(tileset)
}

// underground view   ###################################################################################
$("#underground_1").change(function () {
  viewer.scene.globe.depthTestAgainstTerrain = !$("#underground_1").prop("checked");
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !$("#underground_1").prop("checked");
  viewer.scene.globe.translucency.frontFaceAlphaByDistance.nearValue = 0.4;
});

$("#resetTransparent").click(function () {
  resetTransparent(siolaLegal);
  resetTransparent(balaiLegal);
  resetTransparent(rusunawaLegal);
});

// Get Siola   ############################################################################################
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
  })
);

const siolaLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2422061)
);

siolaLegal.style = setColorStyle;


// hide preloader after finish load data
$(function () {
  $(".preload").addClass("d-none");
  $(".loader-container").removeClass("d-none");
});
firstCamera();

// Get Balai Pemuda   ####################################################################################
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
  await Cesium.Cesium3DTileset.fromIonAssetId(2422351)
);

balaiLegal.style = setColorStyle;

// Get Rusunawa   #########################################################################################
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
  await Cesium.Cesium3DTileset.fromIonAssetId(2422063)
);

rusunawaLegal.style = setColorStyle;



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